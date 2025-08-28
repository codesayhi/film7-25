<?php

namespace App\Services\Countries\Admin;

use App\Exceptions\NotFoundException;
use App\Repositories\Interfaces\GenreRepositoryInterface;

class RestoreGenreService
{
    public function __construct(protected GenreRepositoryInterface $genreRepository)
    {
    }

    public function handle($id)
    {
        $country = $this->genreRepository->findByIdTrashed($id);
        if (!$country) {
            throw new NotFoundException('Không tìm thấy dữ liệu');
        }
        $this->genreRepository->restore($country);
        return $country;
    }
}
