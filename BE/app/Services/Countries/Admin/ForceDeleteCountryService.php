<?php

    namespace App\Services\Countries\Admin;

use App\Exceptions\NotFoundException;
use App\Repositories\Interfaces\CountryRepositoryInterface;

    class ForceDeleteCountryService{
        public function __construct(protected CountryRepositoryInterface $countryRepository)
        {
        }

        public function handle($id)
        {
            $country = $this->countryRepository->findByIdTrashed($id);
            if (!$country) {
                throw new NotFoundException('Không tìm thấy dữ liệu');
            }
            $this->countryRepository->forceDelete($country);
            return $country;
        }
    }
