<?php

namespace App\Repositories\Eloquent;

use App\Enums\PaginateEnum;
use App\Exceptions\NotFoundException;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Traits\Filterable;
use DragonCode\Contracts\Cashier\Config\Payments\Map;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository implements BaseRepositoryInterface
{
    use Filterable;

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all() : Collection
    {
        return $this->model->all();
    }


    public function findById(int $id) : ?Model
    {
        $result = $this->model->find($id);
        return $result;
    }

    public function allPaginate(int $perPage = PaginateEnum::Default->value) : LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    public function allPaginateWithFilter(array $request) : LengthAwarePaginator
    {
        $perPage = $request['per_page'] ?? PaginateEnum::Default->value;

        // Sử dụng trait Filterable thông qua model
        return $this->model->filter($request)->paginate($perPage);
    }

    public function create(array $data) : Model
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array $data) : bool
    {
        return $model->update($data);
    }

    public function softDelete(Model $model) : bool
    {
        return $model->delete();
    }

    public function restore(Model $model) : bool
    {
        return $model->restore();
    }

    public function forceDelete(Model $model) : bool
    {
        return $model->forceDelete();
    }

    public function findByIdTrashed(int $id) : ?Model
    {
        return $this->model->onlyTrashed()->find($id);
    }

    public function allTrashedPaginate(int $perPage = PaginateEnum::Default->value, array $request) : LengthAwarePaginator
    {
        return $this->model->filter($request)->onlyTrashed()->paginate($perPage);
    }
}
