<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
/**
 * @package App\Http\Controllers\Admin
 * @author
 * Các phương thức cơ bản cho các controller CRUD
 */
class BaseCrudController extends Controller
{
    /**
     * Khai báo các service, resource, request class
     * @param $resourceList
     * @param $serviceCreate
     * @param $createRequestClass
     * @param $serviceShow
     * @param $resourceShow
     */
    public function __construct(
        protected $serviceList,
        protected $resourceList,
        protected $serviceCreate,
        protected string $createRequestClass,
        protected $serviceShow,
        protected $resourceShow,
        protected $serviceUpdate,
        protected $updateRequestClass,
        protected $serviceSoftDelete,
        protected $serviceForceDelete,
        protected $serviceRestore,
        protected $serviceDetailOnlyTrashed,
        protected $serviceListOnlyTrashed,
    ) {}
    /**
     * Phương thức lấy danh sách có phân trang
     * @return \Illuminate\Http\JsonResponse
     * Trả về danh sách các đối tượng đã được phân trang
     * Tham số truyền vào:
     * ServiceList: service lấy danh sách
     * ResourceList: resource lấy danh sách
     * Thực hiện:
     * - Gọi service lấy danh sách
     * - Trả về kết quả
     * - Nếu lỗi, trả về lỗi
     */
    public function index(Request $request)
    {
        $request = $request->all();
        $data = $this->serviceList->handle($request);
        return ApiResponse::success($this->resourceList::collection($data));
    }

    /**
     * Phương thức tạo mới
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     * Tham số truyền vào:
     * CreateRequestClass: class request tạo mới
     * ServiceCreate: service tạo mới
     * Thực hiện:
     * - Lấy dữ liệu từ request
     * - Gọi service tạo mới
     * - Trả về kết quả
     * - Nếu lỗi, trả về lỗi
     */
    public function create()
    {

        $request = app($this->createRequestClass);
        $data = $request->validated();
        $result = $this->serviceCreate->handle($data);
        return ApiResponse::created($result);
    }

    /**
     * Phương thức lấy chi tiết
     * @return \Illuminate\Http\JsonResponse
     * Tham số truyền vào:
     * ServiceShow: service lấy chi tiết
     * ResourceShow: resource lấy chi tiết
     * Thực hiện:
     * - Gọi service lấy chi tiết
     * - Trả về kết quả
     * - Nếu lỗi, trả về lỗi
     */
    public function show(int $id)
    {
        $data = $this->serviceShow->handle($id);
        return ApiResponse::success($this->resourceShow::make($data));
    }

    /**
     * Phương thức cập nhật
     * @return \Illuminate\Http\JsonResponse
     * Tham số truyền vào:
     * UpdateRequestClass: class request cập nhật
     * ServiceUpdate: service cập nhật
     * Thực hiện:
     * - Lấy dữ liệu từ request
     * - Gọi service cập nhật
     * - Trả về kết quả
     * - Nếu lỗi, trả về lỗi
     */
    public function update(int $id)
    {
        $request = app($this->updateRequestClass);
        $data = $request->validated();
        $result = $this->serviceUpdate->handle($id, $data);
        return ApiResponse::updated($result);
    }

    /**
     * Phương thức xóa mềm
     * @return \Illuminate\Http\JsonResponse
     * Tham số truyền vào:
     * ServiceSoftDelete: service xóa mềm
     * Thực hiện:
     * - Gọi service xóa mềm
     * - Trả về kết quả
     * - Nếu lỗi, trả về lỗi
     */
    public function softDelete(int $id)
    {
        $result = $this->serviceSoftDelete->handle($id);
        return ApiResponse::success(message: 'Xóa thành công');
    }

    /**
     * Phương thức xóa vĩnh viễn
     * @return \Illuminate\Http\JsonResponse
     * Tham số truyền vào:
     * ServiceForceDelete: service xóa vĩnh viễn
     * Thực hiện:
     * - Gọi service xóa vĩnh viễn
     * - Trả về kết quả
     * - Nếu lỗi, trả về lỗi
     */
    public function forceDelete(int $id)
    {
        $result = $this->serviceForceDelete->handle($id);
        return ApiResponse::success(message: 'Xóa vĩnh viễn thành công');
    }

    /**
     * Phương thức khôi phục
     * @return \Illuminate\Http\JsonResponse
     * Tham số truyền vào:
     * ServiceRestore: service khôi phục
     * Thực hiện:
     * - Gọi service khôi phục
     * - Trả về kết quả
     * - Nếu lỗi, trả về lỗi
     */
    public function restore(int $id)
    {
        $result = $this->serviceRestore->handle($id);
        return ApiResponse::success(message: 'Khôi phục thành công');
    }
    /**
     * Phương thức lấy chi tiết có phân trang
     * @return \Illuminate\Http\JsonResponse
     * Tham số truyền vào:
     * ServiceDetailOnlyTrashed: service lấy chi tiết có phân trang
     * ResourceDetailOnlyTrashed: resource lấy chi tiết có phân trang
     * Thực hiện:
     * - Gọi service lấy chi tiết có phân trang
     * - Trả về kết quả
     * - Nếu lỗi, trả về lỗi
     */
    public function detailOnlyTrashed(int $id)
    {
        $result = $this->serviceDetailOnlyTrashed->handle($id);
        return ApiResponse::success($this->resourceShow::make($result));
    }
    /**
     * Phương thức lấy danh sách có phân trang
     * @return \Illuminate\Http\JsonResponse
     * Tham số truyền vào:
     * ServiceListOnlyTrashed: service lấy danh sách có phân trang
     * ResourceListOnlyTrashed: resource lấy danh sách có phân trang
     * Thực hiện:
     * - Gọi service lấy danh sách có phân trang
     * - Trả về kết quả
     * - Nếu lỗi, trả về lỗi
     */
    public function listOnlyTrashed()
    {
        $result = $this->serviceListOnlyTrashed->handle();
        return ApiResponse::success($this->resourceList::collection($result));
    }
}
