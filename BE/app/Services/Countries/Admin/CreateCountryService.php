<?php

namespace App\Services\Countries\Admin;

use App\Helpers\ApiResponse;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use Illuminate\Support\Facades\Log;

class CreateCountryService
{
    public function __construct(protected CountryRepositoryInterface $countryRepository)
    {
    }

    public function handle(array $data)
    {
        try {
            $country = $this->countryRepository->create($data);
            return $country;
        } catch (\Throwable $th) {
            Log::error($th);
            return ApiResponse::error(errors: $th->getMessage());
        }
    }
}
