<?php

namespace App\Services\Countries\Admin;

use App\Repositories\Interfaces\GenreRepositoryInterface;

class ListOnlyTrashedGenreService
{
    public function __construct(protected GenreRepositoryInterface $genreRepository)
    {
    }

    public function handle(array $request)
    {
        $genres = $this->genreRepository->allTrashedPaginate(request:$request);
        return $genres;
    }
}
