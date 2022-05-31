<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BeritaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Dashboard
Route::get('/', [BeritaController::class, 'index']);

// Action Dashboard
Route::get('/detail/{slug}', [BeritaController::class, 'show']);
Route::get('/delete/{id}', [BeritaController::class, 'destroy']);
Route::get('/edit/{id}', [BeritaController::class, 'editView']);
Route::post('/edit', [BeritaController::class, 'edit']);

// Create Category
Route::get('/category', [BeritaController::class, 'categoryView']);
Route::post('/category', [BeritaController::class, 'createCategory']);

// Create Berita
Route::get('/create', [BeritaController::class, 'createView']);
Route::post('/create', [BeritaController::class, 'create']);


