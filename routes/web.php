<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\QuestionController;

Route::get('/', function () {});

Route::get('/home', [HomeController::class, 'index']);

Route::get('/matakuliah', [MatakuliahController::class, 'index']);

Route::get('/matakuliah/create', [MatakuliahController::class, 'create']);

Route::post('/matakuliah', [MatakuliahController::class, 'store']);

Route::get('/matakuliah/show/{kode?}', [MatakuliahController::class, 'show']);

Route::get('/matakuliah/{kode}/edit', [MatakuliahController::class, 'edit']);

Route::put('/matakuliah/{kode}', [MatakuliahController::class, 'update']);

Route::delete('/matakuliah/{kode}', [MatakuliahController::class, 'destroy']);

Route::post('question/store', [QuestionController::class, 'store'])
    ->name('question.store');
