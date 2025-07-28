<?php

namespace App\Services\Countries\Admin;

use App\Exceptions\NotFoundException;
use App\Repositories\Interfaces\CountryRepositoryInterface;

class SoftDeleteCountryService
{
    public function __construct(protected CountryRepositoryInterface $countryRepository)
    {
    }

    public function handle($id)
    {
        $country = $this->countryRepository->findById($id);
        if (!$country) {
            throw new NotFoundException('Không tìm thấy dữ liệu');
        }
        $this->countryRepository->softDelete($country);
        return $country;
    }
}
