<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\Country\CreateRequest;
use App\Http\Requests\Admin\Country\UpdateRequest;
use App\Http\Resources\Admin\Country\DetailCountryResource;
use App\Http\Resources\Admin\Country\ListResource;
use App\Services\Countries\Admin\CreateCountryService;
use App\Services\Countries\Admin\DetailCountryService;
use App\Services\Countries\Admin\DetailOnlyTrashedCountryService;
use App\Services\Countries\Admin\ForceDeleteCountryService;
use App\Services\Countries\Admin\ListCountryService;
use App\Services\Countries\Admin\ListOnlyTrashedCountryService;
use App\Services\Countries\Admin\RestoreCountryService;
use App\Services\Countries\Admin\SoftDeleteCountryService;
use App\Services\Countries\Admin\UpdateCountryService;

/**
 * CountryController
 *
 * @package App\Http\Controllers\Admin
 * @author
 */
class CountryController extends BaseCrudController
{
    public function __construct(
        protected ListCountryService $listCountryService,
        protected CreateCountryService $createCountryService,
        protected DetailCountryService $detailCountryService,
        protected UpdateCountryService $updateCountryService,
        protected SoftDeleteCountryService $softDeleteCountryService,
        protected ForceDeleteCountryService $forceDeleteCountryService,
        protected RestoreCountryService $restoreCountryService,
        protected DetailOnlyTrashedCountryService $detailOnlyTrashedCountryService,
        protected ListOnlyTrashedCountryService $listOnlyTrashedCountryService,
    ) {
        parent::__construct(
            serviceList: $listCountryService,
            resourceList: ListResource::class,
            serviceCreate: $createCountryService,
            createRequestClass: CreateRequest::class,
            serviceShow: $detailCountryService,
            resourceShow: DetailCountryResource::class,
            serviceUpdate: $updateCountryService,
            updateRequestClass: UpdateRequest::class,
            serviceSoftDelete: $softDeleteCountryService,
            serviceForceDelete: $forceDeleteCountryService,
            serviceRestore: $restoreCountryService,
            serviceDetailOnlyTrashed: $detailOnlyTrashedCountryService,
            serviceListOnlyTrashed: $listOnlyTrashedCountryService,
        );
    }
}
