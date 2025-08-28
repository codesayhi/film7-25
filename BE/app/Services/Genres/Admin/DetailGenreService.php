<?php

namespace App\Services\Genres\Admin;

use App\Exceptions\NotFoundException;
use App\Repositories\Interfaces\GenreRepositoryInterface;

class DetailGenreService
{
    public function __construct(
        protected GenreRepositoryInterface $genreRepository
    ) {}

    public function handle($id)
    {
        $result = $this->genreRepository->findById($id);
        if (!$result) {
            throw new NotFoundException('Không tìm thấy dữ liệu');
        }
        return $result;
    }
}
