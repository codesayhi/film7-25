<?php

namespace App\Services\Countries\Admin;

use App\Repositories\Interfaces\CountryRepositoryInterface;

class ListCountryService
{
    public function __construct(protected CountryRepositoryInterface $countryRepository)
    {
    }

    public function handle(array $request) {
        $countries = $this->countryRepository->allPaginateWithFilter($request);
        return $countries;
    }
}
