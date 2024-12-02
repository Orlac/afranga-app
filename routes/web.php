<?php

use App\Http\Controllers\ClientsController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::post('/export', [ClientsController::class, 'export'])->name('clients.export');
Route::get('/', [ClientsController::class, 'index'])->name('clients.index');
Route::get('/create', [ClientsController::class, 'create']);
//Route::get('/export', [ClientsController::class, 'export']);
Route::delete('/destroy', [ClientsController::class, 'destroy'])->name('clients.destroy');
//Route::get('/test', [ClientsController::class, 'test']);
Route::post('/export/lazy', [ClientsController::class, 'exportLazy'])->name('clients.export.lazy');
Route::get('/export', [ClientsController::class, 'export'])->name('clients.export');


