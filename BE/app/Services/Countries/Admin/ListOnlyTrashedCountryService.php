<?php

namespace App\Services\Countries\Admin;

use App\Repositories\Interfaces\CountryRepositoryInterface;

class ListOnlyTrashedCountryService
{
    public function __construct(protected CountryRepositoryInterface $countryRepository)
    {
    }

    public function handle(array $request)
    {
        $countries = $this->countryRepository->allTrashedPaginate(request:$request);
        return $countries;
    }
}
