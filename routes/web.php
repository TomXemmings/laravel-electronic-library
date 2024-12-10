<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/books/search', [BookController::class, 'search'])->name('books.search');

Route::middleware('auth')->group(function () {
    Route::post('/books/{id}/favorites', [BookController::class, 'addToFavorites'])->name('books.favorites.add');
    Route::delete('/books/{id}/favorites', [BookController::class, 'removeFromFavorites'])->name('books.favorites.remove');
    Route::get('/favorites', [BookController::class, 'favorites'])->name('books.favorites');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
});

Route::middleware(['check_ip'])->group(function () {
    // Защищенные маршруты
    Route::get('/books/{id}', [BookController::class, 'showBook'])->name('books.show');
});
