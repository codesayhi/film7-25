<?php

namespace App\Exceptions;

use App\Enums\HttpCodeEnum;

class BadRequestException extends ApiException
{
    /**
     * Sử dụng khi trả lỗi BadRequest (400)
     */

     public function __construct(string $message = 'Yêu cầu không hợp lệ', mixed $errors = null)
     {
        parent::__construct(message: $message,statusCode: HttpCodeEnum::BadRequest->value,errors: $errors);
     }
}
