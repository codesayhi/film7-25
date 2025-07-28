<?php

namespace App\Exceptions;

use App\Helpers\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

use function PHPUnit\Framework\returnSelf;

abstract class ApiException  extends Exception
{
    /**
     * @var int
     * statusCode đại diện cho các lỗi 401, 404, ...
     */
    protected int $statusCode;

    /**
     * erros Trả về mảng lỗi
     * @var mixed
     */
    protected mixed $errors;

    /**
     * Construct
     * @param string $message: Truyền mô tả ngắn về lỗi
     * @param int $statusCode: Truyền mã lỗi http (400, 403, 404, 500,...)
     * @param mixed|null $errors: Truyền mảng lỗi chi tiết (Nếu có)
     *  @param Throwable|null: $previous     Throwable gốc (nếu cần)
     */

    public function __construct(string $message, int $statusCode, mixed $errors = null, Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->statusCode = $statusCode;
        $this->errors = $errors;
    }

    /**
     * Lấy statusCode
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Lấy mảng lỗi
     */
    public function getErrors(): mixed
    {
        return $this->errors;
    }

    /**
     * Đổi nội dung lỗi thành JsonResponse qua ApiResponse
     */
    public function toResponse(): JsonResponse
    {
        return ApiResponse::error(
            $this->getMessage(),
            $this->getStatusCode(),
            $this->getErrors()
        );
    }
}
