<?php

declare(strict_types=1);

namespace App\Infrastructure\External\B3\Helpers;

use App\Base\Helpers\DateHelper;
use App\Base\Helpers\FileHelper;
use Exception;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class CertificateHelper
{
    private const CERTIFICATE_PATH = 'public/certificates/files/';

    public function __construct()
    {
    }

    /**
     * @return array
     */
    public function getCertificates(): array
    {
        $certificates = [];

        if (!Storage::disk('local')->exists(self::CERTIFICATE_PATH)) {
            $zipUrl = FileHelper::getFileUrl('assets', env('B3_ZIP_PATH'));
            $zipPath = $this->downloadFile($zipUrl);
            $this->extractZip($zipPath);
        }

        $basePath = self::CERTIFICATE_PATH . env('LION_DOCUMENT');

        $password = env('B3_PASSWORD');
        $certificatePath = Storage::path($basePath . '.cer');
        $keyPath = Storage::path($basePath . '.key');

        $cert = "--cert {$certificatePath}:{$password} \\";
        $key = "--key {$keyPath} \\";

        data_set($certificates, 'cert', $cert);
        data_set($certificates, 'key', $key);
        data_set($certificates, 'certPath', $certificatePath);
        data_set($certificates, 'keyPath', $keyPath);
        data_set($certificates, 'password', $password);

        return $certificates;
    }

    /**
     * @param string $url
     * @return string
     */
    private function downloadFile(string $url): string
    {
        $extension = FileHelper::getFileExtension($url);
        $fileName = env('LION_DOCUMENT') . '.' . $extension;
        $fileContent = file_get_contents($url);
        $basePath = 'public/certificates/';

        $filePath = Storage::path($basePath . $fileName);
        Storage::disk('local')->put($basePath . $fileName, $fileContent);

        return $filePath;
    }

    /**
     * @param string $path
     */
    private function extractZip(string $path): void
    {
        $zip = new ZipArchive();

        if ($zip->open($path)) {
            $zip->extractTo(Storage::path(self::CERTIFICATE_PATH));
            $zip->close();
        }
    }
}
