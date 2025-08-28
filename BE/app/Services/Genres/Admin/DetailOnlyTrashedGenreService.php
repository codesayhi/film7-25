<?php

namespace App\Services\Countries\Admin;

use App\Exceptions\NotFoundException;
use App\Repositories\Interfaces\GenreRepositoryInterface;

class DetailOnlyTrashedGenreService
{
    public function __construct(protected GenreRepositoryInterface $genreRepository)
    {
    }

    public function handle($id)
    {
        $result = $this->genreRepository->findByIdTrashed($id);
        if (!$result) {
            throw new NotFoundException('Không tìm thấy dữ liệu');
        }
        return $result;
    }
}
