<?php

namespace App\Services\Countries\Admin;

use App\Exceptions\NotFoundException;
use App\Repositories\Interfaces\CountryRepositoryInterface;

class DetailCountryService
{
    public function __construct(
        protected CountryRepositoryInterface $countryRepository
    ) {}

    public function handle($id)
    {
        $result = $this->countryRepository->findById($id);
        if (!$result) {
            throw new NotFoundException('Không tìm thấy dữ liệu');
        }
        return $result;
    }
}
