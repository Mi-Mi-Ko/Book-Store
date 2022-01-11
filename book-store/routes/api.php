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

Route::post('register', [UserController::class, 'register']); //ユーザー登録
Route::post('login', [UserController::class, 'login']); //ログイン

//ユーザー&ボック検索
Route::get('users', [UserController::class, 'index'])->name('user.list');
Route::get('books', [BookController::class, 'index'])->name('book.list');
Route::get('book/list/{cat_id}',[BookController::class, 'search'])->name('book.search');

Route::group(['middleware' => ['auth:sanctum']], function () {
    //ログアウト
    Route::post('logout', [UserController::class, 'logout']);
    //ユーザー
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    //ボック
    Route::get('book/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::post('book/create', [BookController::class, 'store'])->name('book.create');
    Route::put('book/edit/{id}', [BookController::class, 'store'])->name('book.update');
    Route::get('book/delete/{id}', [BookController::class, 'delete'])->name('book.delete');
});