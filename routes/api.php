<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

//use App\Http\Controllers\ExportBook;
use App\Http\Controllers\ExportByDate;
use App\Http\Controllers\ApiCheck;
use App\Http\Controllers\UsersApiController;
use App\Http\Controllers\BooksApiController;
use App\Http\Controllers\CartsApiController;
use App\Http\Controllers\IssueBooksApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/api_check', [ApiCheck::class,'index']);
Route::post('/api_login', [ApiCheck::class,'login']);
Route::post('/save', [ApiCheck::class,'res']);
Route::post('/try', [UserApiController::class,'index']);


Route::get('/home', [UsersApiController::class,'index'])->middleware('auth:sanctum');
Route::post('/login', [UsersApiController::class,'login']);
Route::post('/register', [UsersApiController::class,'resval']);
Route::post('/edit/{id}', [UsersApiController::class,'edit'])->middleware('auth:sanctum');
Route::put('/update', [UsersApiController::class,'update'])->middleware('auth:sanctum');
Route::post('/update_password', [UsersApiController::class,'updateUserPassword'])->middleware('auth:sanctum');
Route::post('/logout', [UsersApiController::class,'logout'])->middleware('auth:sanctum');
//Route::delete('/delete/{id}', [UsersApiController::class,'delete']);
//Route::get('/search/{name}', [UsersApiController::class,'search']);

Route::post('/book_index', [BooksApiController::class,'index'])->name('book_index')->middleware('auth:sanctum');
Route::get('/single_book/{id}', [BooksApiController::class,'singleBook'])->middleware('auth:sanctum');
Route::post('/borrow_now', [BooksApiController::class,'borrowNow'])->middleware('auth:sanctum');

Route::post('/add_to_cart', [CartsApiController::class,'addToCart'])->middleware('auth:sanctum');
Route::post('/cart_item', [CartsApiController::class,'cartItem'])->middleware('auth:sanctum');
Route::get('/cart_list', [CartsApiController::class,'cart'])->middleware('auth:sanctum');
Route::post('/remove/{id}', [CartsApiController::class,'remove'])->middleware('auth:sanctum');

Route::get('/borrow_list', [IssueBooksApiController::class,'borrowBookList'])->middleware('auth:sanctum');
Route::post('/borrowNow', [IssueBooksApiController::class,'borrowNow'])->middleware('auth:sanctum');
