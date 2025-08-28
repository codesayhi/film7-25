<?php

namespace App\Services\Genres\Admin;

use App\Helpers\ApiResponse;
use App\Repositories\Interfaces\GenreRepositoryInterface;
use Illuminate\Support\Facades\Log;

class CreateGenreService
{

    public function __construct(protected GenreRepositoryInterface $genreRepository) {}

    public function handle(array $data)
    {
        try {
            $country = $this->genreRepository->create($data);
            return $country;
        } catch (\Throwable $th) {
            Log::error($th);
            return ApiResponse::error(errors: $th->getMessage());
        }
    }
}
