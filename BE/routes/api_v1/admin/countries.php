<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CountryController as CountryControllerAdmin;

Route::prefix('countries')->group(function () {
    Route::get('/', [CountryControllerAdmin::class, 'index']);
    Route::post('/', [CountryControllerAdmin::class, 'create']);
    Route::get('/only-trashed',[CountryControllerAdmin::class,'listOnlyTrashed']);
    Route::get('/only-trashed/{id}',[CountryControllerAdmin::class,'detailOnlyTrashed'])->middleware('validate.id');
    Route::get('/{id}', [CountryControllerAdmin::class, 'show'])->middleware('validate.id');
    Route::put('/{id}',[CountryControllerAdmin::class,'update'])->middleware('validate.id');
    Route::delete('/{id}',[CountryControllerAdmin::class,'softDelete'])->middleware('validate.id');
    Route::delete('/{id}/force-delete',[CountryControllerAdmin::class,'forceDelete'])->middleware('validate.id');
    Route::post('/{id}/restore',[CountryControllerAdmin::class,'restore'])->middleware('validate.id');
});


