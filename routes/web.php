<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFsController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\SendEmailsController;
use App\Http\Controllers\MailsController;
use App\Http\Controllers\Carts;
use App\Http\Controllers\BooksExport;
use App\Http\Controllers\ExportBooks;
//use App\Http\Controllers\ExportBook;
use App\Http\Controllers\ExportByDates;

//use Illuminate\Http\Request;
//use App\Models\Books;

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
Route::group(['middleware'=>['AuthCheckAdmin']], function () {

    Route::get('/successlogin', [AdminsController::class,'successlogin'])->middleware('is_admin');
    Route::get('/change_password/{id}', [AdminsController::class,'changePassword']);
    Route::any('/user_profile', [AdminsController::class,'userProfile']);
    Route::get('edit_user/{id}', [AdminsController::class,'editUser']);
    Route::any('/update_user', [AdminsController::class,'updateUser']);
    Route::get('/del/{id}', [AdminsController::class,'deleteUser']);
    Route::get('/add_book', [BooksController::class,'addBook']);
    Route::any('/book_list', [BooksController::class,'bookList']);
    Route::get('/delete_book/{id}', [BooksController::class,'deleteBook']);
    Route::get('/edit_book/{id}', [BooksController::class,'editBook']);
    Route::get('/logout', [AdminsController::class,'logout']);
    Route::get('/request_book', [AdminsController::class,'requestBook']);
    Route::get('/approve/{id}/{id2}', [AdminsController::class,'approvePage']);
    Route::post('/approve_request', [AdminsController::class,'approveRequest']);
    Route::get('/issue_id/{id}', [AdminsController::class,'issue_id']);
	Route::get('/borrow_list', [BooksController::class,'borrowList']);
	Route::get('/borrow_book_list', [AdminsController::class,'borrowBookList']);
	Route::get('/return_book', [AdminsController::class,'returnBookList']);
});
    
Route::get('/admin', [AdminsController::class,'mainpage']);
//Route::get('/getcookie', [AdminController::class,'get_cookie']);
//Route::get('/login', [AdminController::class,'mainpage']);
//Route::get('/admin/login', [AdminController::class,'save_cookie']);
Route::post('/admin/check_login', [AdminsController::class,'checkLogin']);
Route::post('admin/update_password', [AdminsController::class,'updatePassword']);
//::get('/search_user', [AdminController::class,'search_user']);
// Route::get('/admin','AdminController@index');
Route::post('admin/save_book', [BooksController::class,'saveBook']);
Route::post('/update_book', [BooksController::class,'updateBook']);
Route::get('/singleBook/{id}', [BooksController::class,'singleBook']);
Route::post('/borrow_book', [BooksController::class,'borrowBook']);

//Route::get('/add_cart',[BookController::class,'getAddToCart']);
Route::post('/return_book/{id}/{id2}', [AdminsController::class,'returnBook']);
Route::get('/return_book_page', [AdminsController::class,'returnBookPage']);
//Route::get('/exportExcel','PostsController@exportExcel');
//Route::get('/exportExcel',[BookExport::class,'exportExcel']);
// Export to csv
//Route::get('/exportCSV',[BookController::class,'exportCSV']);
Route::any('/exportExcel/{id}', [ExportBooks::class,'exportData']);
Route::any('/exportExcelByDate', [ExportByDates::class,'exportData']);

Route::get('/importExcel', [BooksController::class,'importForm']);
Route::post('/import', [BooksController::class,'importCSV']);


Route::group(['middleware'=>['AuthCheck']], function () {
    Route::get('/dashboard', [UsersController::class,'dashboard']);
    Route::get('edit_user_profile/{id}', [UsersController::class,'editProfile']);
    Route::get('change_user_pass/{id}', [UsersController::class,'changeUserPassword']);
    Route::get('/logout', [UsersController::class,'logout']);
});

//Route::get('/logout', [UserController::class,'logout']);
Route::get('/login', [UsersController::class,'login']);
Route::get('/registration', [UsersController::class,'registration']);
Route::get('/home', [UsersController::class,'index']);

Route::post('/saveData', [UsersController::class,'saveData']);
Route::post('/visitor/login', [UsersController::class,'checkUserlogin']);
Route::any('/update_userData', [UsersController::class,'updateUserData']);
Route::post('updateUserPassword', [UsersController::class,'updateUserPassword']);

Route::get('/cart', [Carts::class,'cart'])->name('cart');
Route::get('/add_to_cart/{id}', [Carts::class,'addToCart'])->name('add_to_cart');
Route::get('/remove/{id}', [Carts::class,'remove'])->name('remove');


Route::get('/cart_log', [CartsController::class,'cart'])->name('cart');
Route::any('/add_to_cart', [CartsController::class,'addToCart'])->name('add_to_cart');
Route::get('/remove_log/{id}', [CartsController::class,'remove']);

Route::get('send-email-pdf', [SendEmailsController::class, 'sendmail']);

Route::get('sendbasicemail', [MailsController::class,'basic_email']);
Route::get('sendhtmlemail', [MailsController::class,'html_email']);
Route::get('sendattachmentemail', [MailsController::class,'attachment_email']);

//Route::get('downloadPdf',[BookController::class,'downloadPdf']);

Route::get('/book/pdf', [BooksController::class,'downloadPdf']);
//Route::resource('borrow_list',[BookController::class,'downloadPdf']);
//Route::get('bookList',array('as'=>'bookList','uses'=>'PDFController@bookList'));

Route::get('/create-pdf', [BooksController::class, 'exportPDF']);
