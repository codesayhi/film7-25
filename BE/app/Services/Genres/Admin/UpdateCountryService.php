<?php

namespace App\Services\Countries\Admin;

use App\Helpers\ApiResponse;
use App\Repositories\Interfaces\GenreRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateCountryService
{
    public function __construct(
        protected GenreRepositoryInterface $genreRepository
    ) {}

    public function handle($id, $data)
    {
        try {
            DB::beginTransaction();
            $genre = $this->genreRepository->findById($id);
            $this->genreRepository->update($genre, $data);
            DB::commit();
            return $genre;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return ApiResponse::error(errors: $th->getMessage());
        }
    }
}
