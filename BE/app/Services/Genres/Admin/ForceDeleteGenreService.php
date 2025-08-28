<?php

namespace App\Services\Countries\Admin;

use App\Exceptions\NotFoundException;
use App\Helpers\ApiResponse;
use App\Repositories\Interfaces\GenreRepositoryInterface;

class ForceDeleteGenreService
{
    public function __construct(protected GenreRepositoryInterface $genreRepository) {}

    public function handle($id)
    {
        $result = $this->genreRepository->findByIdTrashed($id);
        if (!$result) {
            throw new NotFoundException('Không tìm thấy dữ liệu');
        }
        try {
            $this->genreRepository->forceDelete($result);
        } catch (\Throwable $th) {
            return ApiResponse::error(errors: $th->getMessage());
        }

        return $result;
    }
}
