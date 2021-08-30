<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\cart;
use App\Http\Controllers\BookExport;
use App\Http\Controllers\ExportBook;
//use App\Http\Controllers\ExportBook;
use App\Http\Controllers\ExportByDate;

use Illuminate\Http\Request;
use App\Models\Books;

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
//if(Session::get('LoggedAdmin'))   {
    Route::get('/successlogin', [AdminController::class,'successlogin'])->middleware('is_admin');
    Route::get('/change_password/{id}', [AdminController::class,'changePassword']);
    Route::any('/user_profile', [AdminController::class,'userProfile']);
    Route::get('edit_user/{id}', [AdminController::class,'editUser']);
    Route::any('/update_user', [AdminController::class,'updateUser']);
    Route::get('/del/{id}', [AdminController::class,'deleteUser']);
    Route::get('/add_book', [BookController::class,'addBook']);
    Route::any('/book_list', [BookController::class,'bookList']);
    Route::get('/delete_book/{id}', [BookController::class,'deleteBook']);
    Route::get('/edit_book/{id}', [BookController::class,'editBook']);
    Route::get('/logout', [AdminController::class,'logout']);
    Route::get('/request_book', [AdminController::class,'requestBook']);
    Route::get('/approve/{id}/{id2}', [AdminController::class,'approvePage']);
    Route::post('/approve_request', [AdminController::class,'approveRequest']);
    Route::get('/issue_id/{id}', [AdminController::class,'issue_id']);
});
    
Route::get('/admin', [AdminController::class,'mainpage']);
Route::get('/getcookie', [AdminController::class,'get_cookie']);
//Route::get('/login', [AdminController::class,'mainpage']);
//Route::get('/admin/login', [AdminController::class,'save_cookie']);
Route::post('/admin/check_login', [AdminController::class,'checkLogin']);
Route::post('admin/update_password', [AdminController::class,'updatePassword']);
//::get('/search_user', [AdminController::class,'search_user']);
// Route::get('/admin','AdminController@index');
Route::post('admin/save_book', [BookController::class,'saveBook']);
Route::post('/update_book', [BookController::class,'updateBook']);
Route::get('/singleBook/{id}', [BookController::class,'singleBook']);
Route::post('/borrow_book', [BookController::class,'borrowBook']);
Route::get('/borrow_list', [BookController::class,'borrowList']);
Route::get('/borrow_book_list', [AdminController::class,'borrowBookList']);
Route::get('/return_book', [AdminController::class,'returnBookList']);
//Route::get('/add_cart',[BookController::class,'getAddToCart']);
Route::post('/return_book/{id}/{id2}', [AdminController::class,'returnBook']);
Route::get('/return_book_page', [AdminController::class,'returnBookPage']);
//Route::get('/exportExcel','PostsController@exportExcel');
//Route::get('/exportExcel',[BookExport::class,'exportExcel']);
// Export to csv
//Route::get('/exportCSV',[BookController::class,'exportCSV']);
Route::any('/exportExcel/{id}', [ExportBook::class,'exportData']);
Route::any('/exportExcelByDate', [ExportByDate::class,'exportData']);

Route::get('/importExcel', [BookController::class,'importForm']);
Route::post('/import', [BookController::class,'importCSV']);


Route::group(['middleware'=>['AuthCheck']], function () {
    Route::get('/dashboard', [UserController::class,'dashboard']);
    Route::get('edit_user_profile/{id}', [UserController::class,'editProfile']);
    Route::get('change_user_pass/{id}', [UserController::class,'changeUserPassword']);
    Route::get('/logout', [UserController::class,'logout']);
});

//Route::get('/logout', [UserController::class,'logout']);
Route::get('/login', [UserController::class,'login']);
Route::get('/registration', [UserController::class,'registration']);
Route::get('/home', [UserController::class,'index']);

Route::post('/saveData', [UserController::class,'saveData']);
Route::post('/visitor/login', [UserController::class,'checkUserlogin']);
Route::any('/update_userData', [UserController::class,'updateUserData']);
Route::post('updateUserPassword', [UserController::class,'updateUserPassword']);

Route::get('/cart', [Cart::class,'cart'])->name('cart');
Route::get('/add_to_cart/{id}', [Cart::class,'addToCart'])->name('add_to_cart');
Route::get('/remove/{id}', [Cart::class,'remove'])->name('remove');


Route::get('/cart_log', [CartController::class,'cart'])->name('cart');
Route::any('/add_to_cart', [CartController::class,'addToCart'])->name('add_to_cart');
Route::get('/remove_log/{id}', [CartController::class,'remove']);

Route::get('send-email-pdf', [SendEmailController::class, 'sendmail']);

Route::get('sendbasicemail', [MailController::class,'basic_email']);
Route::get('sendhtmlemail', [MailController::class,'html_email']);
Route::get('sendattachmentemail', [MailController::class,'attachment_email']);

//Route::get('downloadPdf',[BookController::class,'downloadPdf']);

Route::get('/book/pdf', [BookController::class,'downloadPdf']);
//Route::resource('borrow_list',[BookController::class,'downloadPdf']);
//Route::get('bookList',array('as'=>'bookList','uses'=>'PDFController@bookList'));

Route::get('/create-pdf', [BookController::class, 'exportPDF']);
