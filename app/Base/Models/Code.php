<?php

declare(strict_types=1);

namespace App\Base\Models;

use Symfony\Component\HttpFoundation\Response;

class Code
{
    public const HTTP_CODE = [
        'success' => Response::HTTP_OK,
        'created' => Response::HTTP_CREATED,
        'updated' => Response::HTTP_OK,
        'deleted' => Response::HTTP_OK,
        'error' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'bad-request' => Response::HTTP_BAD_REQUEST,
    ];
}
