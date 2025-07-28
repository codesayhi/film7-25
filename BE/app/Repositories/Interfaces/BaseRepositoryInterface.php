<?php

namespace App\Repositories\Interfaces;

use App\Enums\PaginateEnum;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function all();
    public function findById(int $id);
    public function allPaginate(int $perPage = PaginateEnum::Default->value);
    public function create(array $data);
    public function update(Model $model, array $data);
    public function softDelete(Model $model);
    public function restore(Model $model);
    public function forceDelete(Model $model);
    public function findByIdTrashed(int $id);
    public function allTrashedPaginate(int $perPage = PaginateEnum::Default->value);

}
