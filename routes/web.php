<?php

use App\Http\Controllers\ClientsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ClientsController::class, 'index'])->name('clients.index');

Route::get('/create', [ClientsController::class, 'create'])->name('clients.create');
Route::post('/store', [ClientsController::class, 'store'])->name('clients.store');

Route::get('/show', [ClientsController::class, 'show'])->name('clients.show');

Route::get('/edit', [ClientsController::class, 'edit'])->name('clients.edit');
Route::put('/update', [ClientsController::class, 'update'])->name('clients.update');

Route::delete('/destroy', [ClientsController::class, 'destroy'])->name('clients.destroy');

Route::post('/export/lazy', [ClientsController::class, 'exportLazy'])->name('clients.export.lazy');
Route::get('/export', [ClientsController::class, 'export'])->name('clients.export');


