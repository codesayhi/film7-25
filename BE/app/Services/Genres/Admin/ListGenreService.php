<?php

namespace App\Services\Genres\Admin;

use App\Repositories\Interfaces\GenreRepositoryInterface;

class ListGenreService
{
    public function __construct(protected GenreRepositoryInterface $genreRepository) {}

    public function handle(array $request)
    {
        $genres = $this->genreRepository->allPaginateWithFilter($request);
        return $genres;
    }
}
