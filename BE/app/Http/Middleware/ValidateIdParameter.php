<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateIdParameter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');

        // Kiểm tra nếu ID tồn tại và không phải là số nguyên hợp lệ
        if ($id !== null && (!is_numeric($id) || (int)$id <= 0 || $id != (int)$id)) {
            return response()->json([
                'success' => false,
                'message' => 'ID không hợp lệ. ID phải là một số nguyên dương.',
                'data' => null
            ], 400);
        }

        return $next($request);
    }
}
