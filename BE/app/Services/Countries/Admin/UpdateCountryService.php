<?php

namespace App\Services\Countries\Admin;

use App\Helpers\ApiResponse;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateCountryService
{
    public function __construct(
        protected CountryRepositoryInterface $countryRepository
    ) {}

    public function handle($id, $data)
    {
        try {
            DB::beginTransaction();
            $country = $this->countryRepository->findById($id);
            $this->countryRepository->update($country, $data);
            DB::commit();
            return $country;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return ApiResponse::error(errors: $th->getMessage());
        }
    }
}
