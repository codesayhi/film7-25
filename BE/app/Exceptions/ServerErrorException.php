<?php

namespace App\Exceptions;

use App\Enums\HttpCodeEnum;

/**
 * Class ServerErrorException
 *
 * Sử dụng khi có lỗi nội bộ server → HTTP 500.
 */
class ServerErrorException extends ApiException
{
    public function __construct(
        string $message = 'Lỗi máy chủ',
        mixed $errors = null
    ) {
        parent::__construct(
            message: $message,
            statusCode: HttpCodeEnum::ServerError->value,
            errors: $errors
        );
    }
}
