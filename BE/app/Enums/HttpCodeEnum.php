<?php

namespace App\Enums;

/**
 * HttpCodeEnum
 *
 * @package App\Enums
 * @author
 */
enum HttpCodeEnum: string
{
    case OK                    = '200';
    case Created               = '201';
    case Accepted              = '202';
    case NoContent             = '204';
    case BadRequest            = '400';
    case Unauthorized          = '401';
    case Forbidden             = '403';
    case NotFound              = '404';
    case MethodNotAllowed      = '405';
    case NotAcceptable         = '406';
    case Conflict              = '409';
    case Gone                  = '410';
    case UnsupportedMediaType  = '415';
    case ValidationError       = '422';
    case TooManyRequests       = '429';
    case ServerError           = '500';
    case NotImplemented        = '501';
    case BadGateway            = '502';
    case ServiceUnavailable    = '503';
    case GatewayTimeout        = '504';

    public function label(): string
    {
        return match ($this) {
            // 2xx
            self::OK                   => 'Thành công (200)',
            self::Created              => 'Tạo mới thành công (201)',
            self::Accepted             => 'Đã chấp nhận (202)',
            self::NoContent            => 'Không có nội dung (204)',
            self::BadRequest           => 'Lỗi yêu cầu (400)',
            self::Unauthorized         => 'Chưa xác thực (401)',
            self::Forbidden            => 'Không có quyền (403)',
            self::NotFound             => 'Không tìm thấy (404)',
            self::MethodNotAllowed     => 'Phương thức không được phép (405)',
            self::NotAcceptable        => 'Định dạng không được hỗ trợ (406)',
            self::Conflict             => 'Xung đột dữ liệu (409)',
            self::Gone                 => 'Tài nguyên đã bị gỡ vĩnh viễn (410)',
            self::UnsupportedMediaType => 'Loại nội dung không được hỗ trợ (415)',
            self::ValidationError      => 'Dữ liệu không hợp lệ (422)',
            self::TooManyRequests      => 'Quá nhiều yêu cầu (429)',
            self::ServerError          => 'Lỗi máy chủ (500)',
            self::NotImplemented       => 'Chưa được triển khai (501)',
            self::BadGateway           => 'Lỗi trung gian (502)',
            self::ServiceUnavailable   => 'Hệ thống tạm ngừng (503)',
            self::GatewayTimeout       => 'Hết thời gian chờ (504)',
        };
    }
}
