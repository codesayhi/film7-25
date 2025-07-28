<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CountryController as CountryControllerAdmin;


Route::get('/countries', [CountryControllerAdmin::class, 'index']);
Route::post('/countries', [CountryControllerAdmin::class, 'create']);
Route::get('/countries/only-trashed',[CountryControllerAdmin::class,'listOnlyTrashed']);
Route::get('/countries/only-trashed/{id}',[CountryControllerAdmin::class,'detailOnlyTrashed'])->middleware('validate.id');
Route::get('/countries/{id}', [CountryControllerAdmin::class, 'show'])->middleware('validate.id');
Route::put('/countries/{id}',[CountryControllerAdmin::class,'update'])->middleware('validate.id');
Route::delete('/countries/{id}',[CountryControllerAdmin::class,'softDelete'])->middleware('validate.id');
Route::delete('/countries/{id}/force-delete',[CountryControllerAdmin::class,'forceDelete'])->middleware('validate.id');
Route::post('/countries/{id}/restore',[CountryControllerAdmin::class,'restore'])->middleware('validate.id');


