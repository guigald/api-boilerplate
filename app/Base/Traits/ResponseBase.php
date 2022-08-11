<?php

declare(strict_types=1);

namespace App\Base\Traits;

use App\Base\Models\Code;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

trait ResponseBase
{
    /**
     * @param string $type
     * @param array $data
     * @param Exception|null $exception
     * @return JsonResponse
     */
    private function response(
        string $type,
        array $data = [],
        ?Exception $exception = null
    ): JsonResponse {
        $body = $this->getBodyResponse($type, $data, $exception);

        return new JsonResponse($body, $this->getCode($type, $exception));
    }

    /**
     * @param string $type
     * @param array $data
     * @param Exception|null $exception
     * @return array
     */
    private function getBodyResponse(
        string $type,
        array $data,
        ?Exception $exception
    ): array {
        $data = !empty($data) || $data === []
            ? $data
            : null;

        switch ($type) {
            case 'success':
                $message = data_get($data, 'message', __('messages.success'));
                return $data ?? ['message' => $message];
            case 'created':
                $message = data_get($data, 'message', __('messages.created'));
                return $data ?? ['message' => $message];
            case 'updated':
                $message = data_get($data, 'message', __('messages.updated'));
                return ['message' => $message];
            case 'deleted':
                $message = data_get($data, 'message', __('messages.deleted'));
                return ['message' => $message];
            case 'error':
                $message = $exception->getMessage() ?? __('errors.generic');
                Log::error($message);

                return ['message' => $message];
        };

        return [];
    }

    /**
     * @param string $type
     * @param Exception|null $exception
     * @return int
     */
    private function getCode(string $type, ?Exception $exception): int
    {
        $exceptionCode = $this->getExceptionCode($exception);

        if (!empty($exceptionCode)) {
            return $exceptionCode;
        }

        return data_get(Code::HTTP_CODE, $type, 200);
    }

    /**
     * @param Exception|null $exception
     * @return int|null
     */
    private function getExceptionCode(?Exception $exception): ?int
    {
        if (empty($exception)) {
            return null;
        }

        if (empty($exception->getCode())) {
            return null;
        }

        $code = $exception->getCode();

        if ($code < 100) {
            return Code::HTTP_CODE['error'];
        }

        return (int)$exception->getCode();
    }
}
