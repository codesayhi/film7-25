<?php

namespace App\Exceptions;

use App\Enums\HttpCodeEnum;

/**
 * Sử dụng UnauthorizedException
 */

class UnauthorizedException  extends ApiException
{
    public function __construct(string $message = 'Bạn không có quyền', mixed $errors = null)
    {
      parent::__construct(message : $message, statusCode: HttpCodeEnum::Unauthorized->value,errors: $errors);
    }
}
