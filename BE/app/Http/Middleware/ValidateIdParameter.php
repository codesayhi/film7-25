<?php

namespace App\Http\Middleware;

use App\Enums\HttpCodeEnum;
use App\Helpers\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ValidateIdParameter
{
    /**
     * Thực hiện validate id parameter
     * Nếu id không tồn tại hoặc không phải là số nguyên hợp lệ thì trả về lỗi 400
     * Nếu id tồn tại và là số nguyên hợp lệ thì tiếp tục xử lý request
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');
        // Kiểm tra nếu ID là null hoặc không phải là số nguyên hợp lệ
        if ($id === null || !is_numeric($id) || (int)$id <= 0 || $id != (int)$id) {
            Log::info('Invalid ID detected', ['id' => $id]);
            return ApiResponse::error(
                message: 'Không tồn tại dữ liệu',
                status: HttpCodeEnum::BadRequest->value,
            );
        }

        return $next($request);
    }
}
