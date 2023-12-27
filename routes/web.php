<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AlbumUserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/albumUser/store',  [AlbumUserController::class, 'store'])->name('albumUser.store');
Route::get('/group/{id}', [GroupController::class, 'show'])->name('group.show');
Route::get('/group', [GroupController::class, 'filter'])->name('group.filter');
Route::get('/album/{id}', [AlbumController::class, 'show'])->name('album.show');
Route::post('/albumUser/addComment',  [AlbumController::class, 'addComment'])->name('albumUser.addComment');
require __DIR__.'/auth.php';
