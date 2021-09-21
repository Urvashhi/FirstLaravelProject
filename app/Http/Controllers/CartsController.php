<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class CartsController extends Controller
{
   
    public function __construct(Cart $cartBooks)
    {
        $this->cartBook = $cartBooks;
    }
    
    public function cart()
    {
            $userId=auth()->user()->id;
            $books=$this->cartBook->show($userId);
            return view('books.cartForm', ['books'=>$books]);
    }
    
    public function addToCart(Request $request)
    {
             $book_id=$request->id;
             $request->session()->put('bookId', $book_id);
             $userId=auth()->user()->id;
              $request->session()->put('userId', $userId);
            $data=([
                'book_id' => $book_id,
                'user_id' => $userId
                ]);
                 $count = $this->cartBook->where('book_id', $book_id)->count();
             //  dd($count);
                $ct = $this->cartBook->where('user_id', $userId)->count();
        if ($count  && $ct >= 1) {
               return redirect('dashboard')->with('error', "Book is already in cart");
        }else{
                    
            $this->cartBook->addBookToCart($data, $book_id);
           
		}/*if($count){
                redirect('dashboard')->with('error', "Book is already in cart");
                }*/
                    
             return redirect('dashboard')->with('success', "Book added to cart successfully");
    }
    
    static function cartItem()
    {
        //echo "sjdggsew";
       // $userId=auth()->user()->id;
        //$this->cartBook->cartItems($userId);
         $userId=auth()->user()->id;
        return Cart::where('user_id', $userId)->count();
    }
    
    public function remove($id)
    {
        // $cart = Cart::find($id);
             //dd($books);
        //$cart = DB::table('cart')->where('id', $id)->delete();
               
        //        return back()->with('deletebook', "Book deleted successfully");
        //dd($id);
        //->where('id','=','books.id')
        //$cart=new Cart;
         //$cart->book_id=$request->id;
        
        /*$users = DB::table('books')->get();

        foreach ($users as $user)
        {
            var_dump($user->id);
        }*/
           // dd(Session::get('bookId'));
    
        //dd( Session::get('bookId'));
                //$query = DB::table('books')->latest('id');
           $bookId= Session::get('bookId');
                $this->cartBook->removeBook($id, $bookId);
               
                return redirect('cart_log')->with('success', "Book removed successfully");
    }
}
