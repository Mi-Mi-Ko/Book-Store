<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
  
Route::middleware('api')->group(function () {
    //ユーザールート
    Route::get('/users', [UserController::class, 'index'])->name('user.list');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/create', [UserController::class, 'store']);
    Route::put('/user/edit/{id}', [UserController::class, 'store'])->name('user.update');
    Route::get('/user/delete/{id}', [UserController::class, 'deleteUser'])->name('user.delete');
    //ボックルート
    Route::get('/books', [BookController::class, 'index'])->name('book.list');
    Route::get('/book/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::post('/book/create', [BookController::class, 'store']);
    Route::put('/book/edit/{id}', [BookController::class, 'store'])->name('book.update');
    Route::get('/book/delete/{id}', [BookController::class, 'deleteBook'])->name('book.delete');
});
