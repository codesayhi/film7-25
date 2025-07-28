<?php

namespace App\Repositories\Eloquent;

use App\Enums\PaginateEnum;
use App\Models\Country;
use App\Repositories\Interfaces\CountryRepositoryInterface;

/**
 * CountryRepository
 *
 * @package App\Repositories\Eloquent
 * @author
 */

class CountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    /**
     * CountryRepository constructor
     *
     * @param Country $model
     */
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }
    public function getListFilter(array $filter, int $perPage = PaginateEnum::Default->value)
    {
        $query = $this->model->query();
        if (isset($filter['name'])) {
            $query->where('name', 'like', '%' . $filter['name'] . '%');
        }
        return $query->paginate($perPage);
    }
}
