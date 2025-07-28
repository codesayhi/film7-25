<?php

namespace App\Repositories\Interfaces;

use App\Enums\PaginateEnum;

interface CountryRepositoryInterface extends BaseRepositoryInterface {
    public function getListFilter(array $filter, int $perPage = PaginateEnum::Default->value);
}
