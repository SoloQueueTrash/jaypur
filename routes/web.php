<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductLikeController;
use App\Http\Controllers\StaticController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('', 'welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/like/{id}', [ProductLikeController::class, 'toggleLike'])->name('like');
});

Route::get('welcome', [PhotosController::class, 'welcome'])->name('welcome');
Route::get('contacts', [StaticController::class, 'contacts'])->name('contacts');
Route::get('about', [StaticController::class, 'about'])->name('about');
Route::get('products', [ProductsController::class, 'index'])->name('products');
Route::get('product/{id}', [ProductsController::class, 'show'])->name('product');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('admin', [AdminController::class, 'create'])->name('admin');
    Route::post('admin', [AdminController::class, 'store'])->name('admin.store');
    Route::post('admin/upload/{product_id}', [AdminController::class, 'upload'])->name('admin.upload');
    Route::put('admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('admin/{type}/{id}/', [AdminController::class, 'destroy'])->name('admin.destroy');
});

require __DIR__ . '/auth.php';
