<?php

namespace App\Services\Countries\Admin;

use App\Repositories\Interfaces\CountryRepositoryInterface;

class ListOnlyTrashedCountryService
{
    public function __construct(protected CountryRepositoryInterface $countryRepository)
    {
    }

    public function handle()
    {
        $countries = $this->countryRepository->allTrashedPaginate();
        return $countries;
    }
}
