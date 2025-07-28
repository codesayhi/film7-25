<?php

namespace App\Exceptions;

use App\Enums\HttpCode;
use App\Enums\HttpCodeEnum;

/**
 * Class NotFoundException
 *
 * Sử dụng khi một tài nguyên không tìm thấy → HTTP 404.
 */
class NotFoundException extends ApiException
{
    public function __construct(
        string $message = 'Không tìm thấy dữ liệu',
        mixed $errors = null
    ) {
        parent::__construct(
            message: $message,
            statusCode: HttpCodeEnum::NotFound->value,
            errors: $errors
        );
    }
}
