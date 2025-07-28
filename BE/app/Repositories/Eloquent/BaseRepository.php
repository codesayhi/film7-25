<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\NotFoundException;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use DragonCode\Contracts\Cashier\Config\Payments\Map;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }


    public function findById(int $id)
    {
        $result = $this->model->find($id);
        return $result;
    }

    public function allPaginate(int $perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array $data)
    {
        return $model->update($data);
    }

    public function softDelete(Model $model)
    {
        return $model->delete();
    }

    public function restore(Model $model)
    {
        return $model->restore();
    }

    public function forceDelete(Model $model)
    {
        return $model->forceDelete();
    }

    public function findByIdTrashed(int $id)
    {
        return $this->model->onlyTrashed()->find($id);
    }

    public function allTrashedPaginate(int $perPage = 10)
    {
        return $this->model->onlyTrashed()->paginate($perPage);
    }
}
