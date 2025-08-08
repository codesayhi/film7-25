<?php

namespace App\Repositories\Interfaces;

use App\Enums\PaginateEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{
    /**
     * Lấy tất cả dữ liệu
     *
     * @return Collection Trả về collection chứa tất cả records
     */
    public function all() : Collection;

    /**
     * Tìm record theo ID
     *
     * @param int $id ID của record cần tìm
     * @return Model|null Trả về model instance hoặc null nếu không tìm thấy
     */
    public function findById(int $id) : ?Model;

    /**
     * Lấy dữ liệu có phân trang
     *
     * @param int $perPage Số lượng records trên mỗi trang
     * @return LengthAwarePaginator Trả về paginator object chứa dữ liệu phân trang
     */
    public function allPaginate(int $perPage = PaginateEnum::Default->value) : LengthAwarePaginator;

    /**
     * Lấy dữ liệu có phân trang với filter
     *
     * @param array $request Mảng chứa các điều kiện filter
     * @return LengthAwarePaginator Trả về paginator object chứa dữ liệu đã filter và phân trang
     */
    public function allPaginateWithFilter(array $request) : LengthAwarePaginator;

    /**
     * Tạo record mới
     *
     * @param array $data Dữ liệu để tạo record
     * @return Model Trả về model instance đã được tạo
     */
    public function create(array $data) : Model;

    /**
     * Cập nhật record
     *
     * @param Model $model Model instance cần cập nhật
     * @param array $data Dữ liệu để cập nhật
     * @return bool Trả về true nếu cập nhật thành công, false nếu thất bại
     */
    public function update(Model $model, array $data) : bool;

    /**
     * Xóa mềm record (soft delete)
     *
     * @param Model $model Model instance cần xóa
     * @return bool Trả về true nếu xóa thành công, false nếu thất bại
     */
    public function softDelete(Model $model) : bool;

    /**
     * Khôi phục record đã bị soft delete
     *
     * @param Model $model Model instance cần khôi phục
     * @return bool Trả về true nếu khôi phục thành công, false nếu thất bại
     */
    public function restore(Model $model) : bool;

    /**
     * Xóa vĩnh viễn record (force delete)
     *
     * @param Model $model Model instance cần xóa
     * @return bool Trả về true nếu xóa thành công, false nếu thất bại
     */
    public function forceDelete(Model $model) : bool;

    /**
     * Tìm record đã bị soft delete theo ID
     *
     * @param int $id ID của record cần tìm
     * @return Model|null Trả về model instance đã bị soft delete hoặc null nếu không tìm thấy
     */
    public function findByIdTrashed(int $id) : ?Model;

    /**
     * Lấy tất cả records đã bị soft delete có phân trang
     *
     * @param int $perPage Số lượng records trên mỗi trang
     * @return LengthAwarePaginator Trả về paginator object chứa dữ liệu đã bị soft delete và phân trang
     */
    public function allTrashedPaginate(int $perPage = PaginateEnum::Default->value) : LengthAwarePaginator;

}
