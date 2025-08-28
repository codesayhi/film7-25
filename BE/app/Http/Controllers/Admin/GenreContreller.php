<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Genre\CreateGenreRequest;
use App\Http\Requests\Admin\Genre\UpdateGenreRequest;
use App\Http\Resources\Admin\Genre\DetailGenreResource;
use App\Http\Resources\Admin\Genre\ListGenreResource;
use App\Services\Countries\Admin\DetailOnlyTrashedGenreService;
use App\Services\Countries\Admin\ForceDeleteGenreService;
use App\Services\Countries\Admin\ListOnlyTrashedGenreService;
use App\Services\Countries\Admin\RestoreGenreService;
use App\Services\Countries\Admin\SoftDeleteGenreService;
use App\Services\Countries\Admin\UpdateCountryService;
use App\Services\Genres\Admin\CreateGenreService;
use App\Services\Genres\Admin\DetailGenreService;
use App\Services\Genres\Admin\ListGenreService;

class GenreContreller extends BaseCrudController
{
    public function __construct(
        protected ListGenreService $listGenreService,
        protected CreateGenreService $createGenreService,
        protected DetailGenreService $detailGenreService,
        protected UpdateCountryService $updateGenreService,
        protected SoftDeleteGenreService $softDeleteGenreService,
        protected ForceDeleteGenreService $forceDeleteGenreService,
        protected RestoreGenreService $restoreGenreService,
        protected DetailOnlyTrashedGenreService $detailOnlyTrashedGenreService,
        protected ListOnlyTrashedGenreService $listOnlyTrashedGenreService
    ) {
        parent::__construct(
            serviceList: $listGenreService,
            resourceList: ListGenreResource::class,
            serviceCreate: $createGenreService,
            createRequestClass: CreateGenreRequest::class,
            serviceShow: $detailGenreService,
            resourceShow: DetailGenreResource::class,
            serviceUpdate: $updateGenreService,
            updateRequestClass: UpdateGenreRequest::class,
            serviceSoftDelete: $softDeleteGenreService,
            serviceForceDelete: $forceDeleteGenreService,
            serviceRestore: $restoreGenreService,
            serviceDetailOnlyTrashed: $detailOnlyTrashedGenreService,
            serviceListOnlyTrashed: $listOnlyTrashedGenreService,
        );
    }
}
