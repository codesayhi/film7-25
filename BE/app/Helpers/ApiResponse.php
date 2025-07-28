<?php

namespace App\Helpers;

use App\Enums\HttpCodeEnum;
use Illuminate\Http\JsonResponse;

class ApiResponse
{
    //
    public static function success(mixed $data = null, string $message = 'Thành công', int $status = HttpCodeEnum::OK->value): JsonResponse
    {
        return response()->json([
            'status'  => true,
            'code'    => $status,
            'message' => $message,
            'data'    => $data,
        ], $status);
    }

    public static function error(string $message = 'Có lỗi xảy ra', int $status = HttpCodeEnum::BadRequest->value, mixed $errors = null): JsonResponse
    {
        return response()->json([
            'status'  => false,
            'code'    => $status,
            'message' => $message,
            'errors'  => $errors,
        ], $status);
    }

    public static function created(mixed $data, string $message = 'Tạo mới thành công'): JsonResponse
    {
        return self::success($data, $message, HttpCodeEnum::Created->value);
    }

    public static function accepted(mixed $data = null, string $message = 'Yêu cầu đã được nhận, đang xử lý'): JsonResponse
    {
        return self::success($data, $message, HttpCodeEnum::Accepted->value);
    }

    public static function noContent(): JsonResponse
    {
        return response()->json(null, HttpCodeEnum::NoContent->value);
    }

    public static function updated(mixed $data, string $message = 'Cập nhật thành công'): JsonResponse
    {
        return self::success($data, $message, HttpCodeEnum::OK->value);
    }

    public static function deleted(string $message = 'Đã xóa thành công'): JsonResponse
    {
        return response()->json([
            'status'  => true,
            'code'    => HttpCodeEnum::NoContent->value,
            'message' => $message,
            'data'    => null,
        ], HttpCodeEnum::NoContent->value);
    }

    public static function badRequest(string $message = 'Yêu cầu không hợp lệ', mixed $errors = null): JsonResponse
    {
        return self::error($message, HttpCodeEnum::BadRequest->value, $errors);
    }

    public static function unauthorized(string $message = 'Chưa xác thực hoặc token không hợp lệ'): JsonResponse
    {
        return self::error($message, HttpCodeEnum::Unauthorized->value);
    }

    public static function forbidden(string $message = 'Truy cập bị từ chối'): JsonResponse
    {
        return self::error($message, HttpCodeEnum::Forbidden->value);
    }

    public static function notFound(string $message = 'Không tìm thấy dữ liệu'): JsonResponse
    {
        return self::error($message, HttpCodeEnum::NotFound->value);
    }

    public static function validationError(array $errors, string $message = 'Dữ liệu không hợp lệ'): JsonResponse
    {
        return self::error($message, HttpCodeEnum::ValidationError->value, $errors);
    }

    public static function serverError(string $message = 'Lỗi máy chủ'): JsonResponse
    {
        return self::error($message, HttpCodeEnum::ServerError->value);
    }

    public static function serviceUnavailable(string $message = 'Hệ thống tạm ngừng'): JsonResponse
    {
        return self::error($message, HttpCodeEnum::ServiceUnavailable->value);
    }
}
