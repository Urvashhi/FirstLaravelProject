<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

//use App\Http\Controllers\ExportBook;
use App\Http\Controllers\ExportByDate;
use App\Http\Controllers\ApiCheck;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\BookApiController;
use App\Http\Controllers\CartApiController;

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

Route::get('/home', [UserApiController::class,'index']);
Route::post('/login', [UserApiController::class,'login']);
Route::post('/register', [UserApiController::class,'resval']);
Route::post('/edit/{id}', [UserApiController::class,'edit']);
Route::put('/update', [UserApiController::class,'update']);
Route::post('/update_password', [UserApiController::class,'updateUserPassword']);
Route::delete('/delete/{id}', [UserApiController::class,'delete']);
Route::get('/search/{name}', [UserApiController::class,'search']);

Route::post('/book_index', [BookApiController::class,'index']);
Route::get('/single_book/{id}', [BookApiController::class,'singleBook']);
Route::post('/borrow_now', [BookApiController::class,'borrowNow']);

Route::post('/add_to_cart', [CartApiController::class,'addToCart']);
Route::post('/cart_item', [CartApiController::class,'cartItem']);
Route::get('/cart_list', [CartApiController::class,'cart']);
Route::post('/remove/{id}', [CartApiController::class,'remove']);
