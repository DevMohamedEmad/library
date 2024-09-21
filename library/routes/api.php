<?php

use App\Exports\BookExport;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Middleware\BookAuthorIsCurrentUser;
use App\Http\Middleware\IsAdminMiddlewre;
use App\Imports\BooksImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;



Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'authors', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/store', [AuthorController::class, 'store'])->middleware(IsAdminMiddlewre::class);
});

Route::group(['prefix' => 'categories', 'middleware' => ['auth:sanctum' , IsAdminMiddlewre::class]], function () {

    Route::delete('/delete/{category}', [CategoryController::class, 'destroy']);
    Route::put('/update/{category}', [CategoryController::class, 'update']);
    Route::post('/store', [CategoryController::class, 'store']);
    
});

Route::group(['prefix' => 'books', 'middleware' => 'auth:sanctum'], function () {

    Route::post('/store', [BookController::class, 'store']);
    Route::delete('/delete/{book}', [BookController::class, 'destroy'])->middleware(BookAuthorIsCurrentUser::class);
    Route::put('/update/{book}', [BookController::class, 'update'])->middleware(BookAuthorIsCurrentUser::class);

    Route::get('/export', [BookController::class, 'export']);

    Route::post('/import', [BookController::class, 'import']);

    Route::get('/', [BookController::class, 'index'])->middleware(IsAdminMiddlewre::class);
    
    Route::post('/filter', [BookController::class, 'filter']);
});
