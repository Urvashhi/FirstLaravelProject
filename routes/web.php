<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\visitorController;
use Illuminate\Http\Request;
use App\Models\books;
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

//Route::view("login","login");
Route::get('/admin', [AdminController::class,'mainpage']);
//Route::get('/login', [AdminController::class,'mainpage']);
Route::post('/admin/check_login', [AdminController::class,'check_login']);
Route::get('/successlogin', [AdminController::class,'successlogin'])->middleware('is_admin');
Route::get('/change_password', [AdminController::class,'change_password']);
Route::post('admin/update_password', [AdminController::class,'update_password']);
Route::any('/user_profile', [AdminController::class,'user_profile']);
//::get('/search_user', [AdminController::class,'search_user']);
Route::get('/edit_user/{id}', [AdminController::class,'editUser']);
Route::any('/update_user', [AdminController::class,'updateUser']);
Route::get('/del/{id}', [AdminController::class,'delete_user']);
// Route::get('/admin','AdminController@index');
Route::get('/logout', [AdminController::class,'logout']);

Route::get('/add_book', [BookController::class,'addBook']);
Route::post('/save_book', [BookController::class,'saveBook']);
Route::any('/book_list', [BookController::class,'bookList']);
Route::get('/edit_book/{id}', [BookController::class,'editBook']);
Route::post('/update_book', [BookController::class,'updateBook']);
Route::get('/delete_book/{id}', [BookController::class,'deleteBook']);
/*Route::get('/book_list', function(){
   $books = books::sortable()->paginate(5);
   return view('books.book_list',compact('books'));
});*/
//Route::get('/search',[BookController::class,'search']);


Route::get('/home', [visitorController::class,'index']);
Route::get('/login', [visitorController::class,'login']);
Route::post('visitor/login', [visitorController::class,'check_userlogin']);
Route::get('/dashboard', [visitorController::class,'dashboard']);
Route::get('/registration', [visitorController::class,'registration']);
Route::post('/saveData', [visitorController::class,'saveData']);
Route::get('/logout', [visitorController::class,'logout']);