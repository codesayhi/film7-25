<?php

namespace App\Repositories\Eloquent;

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
}
