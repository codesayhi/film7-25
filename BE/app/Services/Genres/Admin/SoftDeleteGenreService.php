<?php

namespace App\Services\Countries\Admin;

use App\Exceptions\NotFoundException;
use App\Helpers\ApiResponse;
use App\Repositories\Interfaces\GenreRepositoryInterface;

class SoftDeleteGenreService
{
    public function __construct(protected GenreRepositoryInterface $genreRepository) {}

    public function handle($id)
    {
        $result = $this->genreRepository->findById($id);
        if (!$result) {
            throw new NotFoundException('Không tìm thấy dữ liệu');
        }
        try {
            $this->genreRepository->softDelete($result);
        } catch (\Throwable $th) {
            return ApiResponse::error(errors: $th->getMessage());
        }

        return $result;
    }
}
