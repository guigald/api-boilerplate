<?php

declare(strict_types=1);

namespace App\Infrastructure\External\B3\Request;

use App\Base\Helpers\DateHelper;
use App\Infrastructure\External\B3\Helpers\CertificateHelper;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Session;

class B3Request
{
    private const CERTIFICATE_PATH = 'public/certificates/files/';

    public function __construct(
        private Guzzle $client,
        private CertificateHelper $certificateHelper
    ) {
    }

    /**
     * @throws GuzzleException
     */
    private function login(): void
    {
        $expiresIn = Session::get('expires_in');
        $generatedAt = Session::get('generated_at');

        if ($expiresIn !== null) {
            $diff = DateHelper::getDiffTimeIn(
                $generatedAt,
                DateHelper::now(),
                'seconds'
            );

            if ($diff < $expiresIn) {
                return;
            }
        }

        $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];

        $request = $this->client->request(
            'POST',
            env('B3_LOGIN_URI'),
            [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => env('B3_CLIENT_ID'),
                    'client_secret' => env('B3_CLIENT_SECRET'),
                    'scope' => env('B3_SCOPE'),
                ],
                $headers,
            ]
        );

        $result = json_decode((string) $request->getBody(), true);

        Session::put('token', data_get($result, 'access_token'));
        Session::put('expires_in', data_get($result, 'expires_in'));
        Session::put('generated_at', DateHelper::now());
    }

    /**
     * @param array $filter
     * @return string
     */
    public function getQueryString(array $filter): string
    {
        if (empty($filter)) {
            return '';
        }

        $result = '';

        foreach ($filter as $key => $value) {
            $urlEncodedValue = urlencode($value);

            $result .= empty($result)
                ? "?{$key}={$urlEncodedValue}"
                : "&{$key}={$urlEncodedValue}";
        }

        return $result;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array|null $data
     * @param array|null $form
     * @param array|null $customHeaders
     * @param string|null $customOptions
     * @return array|null
     * @throws GuzzleException
     */
    public function make(
        string $method,
        string $uri,
        array $data = null,
        array $form = null,
        array $customHeaders = null,
        string $customOptions = null
    ): ?array {
        $this->login();
        $headers = $this->mountHeaders($customHeaders);
        $token = Session::get('token');
        $certificates = $this->certificateHelper->getCertificates();
        $data = $this->mountData($data);
        $form = $this->mountForm($form);

        $curl = "curl \\";
        $curl .= !empty($customOptions) ? $customOptions : '';
        $curl .= data_get($certificates, 'cert');
        $curl .= data_get($certificates, 'key');
        $curl .= "-k --request {$method} '" . env('B3_URI') . "{$uri}' \\";
        $curl .= "--header 'Authorization: Bearer {$token}' \\";
        $curl .= !empty($headers) ? $headers : '';
        $curl .= !empty($data) ? $data : '';
        $curl .= !empty($form) ? $form : '';

        exec($curl, $output, $response);

        return json_decode(implode(' ', $output), true);
    }

    /**
     * @param array|null $customHeaders
     * @return string
     */
    private function mountHeaders(?array $customHeaders): string
    {
        if ($customHeaders === null) {
            return '';
        }

        $headers = '';

        foreach ($customHeaders as $key => $value) {
            $headers .= " {$key}: {$value} \\";
        }

        return $headers;
    }

    /**
     * @param array|null $data
     * @return string
     */
    private function mountData(?array $data): string
    {
        if ($data === null) {
            return '';
        }

        $result = json_encode($data);

        return " --data-raw '{$result}' \\";
    }

    /**
     * @param array|null $form
     * @return string
     */
    private function mountForm(?array $form): string
    {
        if ($form === null) {
            return '';
        }

        $result = '';

        foreach ($form as $key => $value) {
            $result .= " --form '{$key}=\"{$value}\"' \\";
        }

        return $result;
    }
}
