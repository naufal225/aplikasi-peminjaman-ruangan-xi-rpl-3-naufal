<?php

use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeminjamanPengembalianController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard.index');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/import', [UserController::class, 'importForm'])->name('users.import.form');
Route::post('/users/import', [UserController::class, 'import'])->name('users.import');

Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
Route::get('/ruangan/{ruangan}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
Route::put('/ruangan/{ruangan}', [RuanganController::class, 'update'])->name('ruangan.update');
Route::delete('/ruangan/{ruangan}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');
Route::get('/ruangan/import', [RuanganController::class, 'importForm'])->name('ruangan.import.form');
Route::post('/ruangan/import', [RuanganController::class, 'import'])->name('ruangan.import');

Route::prefix('peminjaman-ruangan')->name('peminjaman-pengembalian.')->group(function () {
    Route::get('/', [PeminjamanPengembalianController::class, 'index'])->name('index');
    Route::get('/create', [PeminjamanPengembalianController::class, 'create'])->name('create');
    Route::post('/', [PeminjamanPengembalianController::class, 'store'])->name('store');
    Route::patch('/{id}/status', [PeminjamanPengembalianController::class, 'updateStatus'])->name('update-status');
    Route::patch('/pengembalian/{id}/status', [PeminjamanPengembalianController::class, 'updatePengembalianStatus'])->name('update-pengembalian-status');
    Route::post('/export', [PeminjamanPengembalianController::class, 'exportData'])->name('export');
});