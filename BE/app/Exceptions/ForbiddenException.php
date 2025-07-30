<?php

namespace App\Exceptions;

use App\Enums\HttpCodeEnum;

/**
 * Class ForbiddenException
 *
 * Sử dụng khi user đã xác thực nhưng không có quyền → HTTP 403.
 */
class ForbiddenException extends ApiException
{
    public function __construct(
        string $message = 'Truy cập bị từ chối',
        mixed $errors = null
    ) {
        parent::__construct(
            message: $message,
            statusCode: HttpCodeEnum::Forbidden->value,
            errors: $errors
        );
    }
}
