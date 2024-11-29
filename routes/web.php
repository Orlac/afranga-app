<?php

use App\Http\Controllers\ClientsController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [ClientsController::class, 'index'])->name('clients.index');
Route::get('/create', [ClientsController::class, 'create']);
Route::delete('/destroy', [ClientsController::class, 'destroy'])->name('clients.destroy');
