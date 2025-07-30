<?php

namespace App\Exceptions;

use App\Enums\HttpCodeEnum;

/**
 * Class ValidationException
 *
 * Sử dụng khi dữ liệu đầu vào không hợp lệ → HTTP 422.
 */
class ValidationException extends ApiException
{
    /**
     * @param string     $message   Thông điệp chính (mặc định “Dữ liệu không hợp lệ”)
     * @param array|null $errors    Mảng chi tiết lỗi form (field => [“error1”, “error2”])
     */
    public function __construct(
        string $message = 'Dữ liệu không hợp lệ',
        ?array $errors = null
    ) {
        parent::__construct(
            message: $message,
            statusCode: HttpCodeEnum::ValidationError->value,
            errors: $errors
        );
    }
}
