<?php

namespace App\Http\Controllers;

use Auth;
//use App\Model\Books;
use App\Models\Cart;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class CartsApiController extends Controller
{
	
	public function __construct(Cart $cartBooks)
    {
        $this->cartBook = $cartBooks;
    }

   
    public function cart()
    {
            $userId=auth()->user()->id;
            $books=$this->cartBook->show($userId);
            return $books; 
    }
    
    public function addToCart(Request $request)
    {
       
        /*     $cart=new Cart;
             $cart->book_id=$request->book_id;
               $cart->user_id=$request->user_id;
             // dd($cart->book_id);
             $id=$cart->book_id;
            // $request->session()->put('bookId', $id);
            // $cart->user_id=auth()->user()->id;
              
             $count = DB::table('cart')->where('book_id', $cart->book_id)->count();
             
            $ct = DB::table('cart')->where('user_id', $cart->user_id)->count();
        if ($count >= 1 && $ct > 0) {
                return ["result"=>"Book is already into a cart."];
        }
                 
            $query= DB::table('books')->where('id', '=', $id);
            $query->decrement('quantity', 1);
            
           $result= $cart->save();
        */
		  $book_id=$request->book_id;
            
             $userId=auth()->user()->id;
          
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
                    
           $result= $this->cartBook->addBookToCart($data, $book_id);
           if ($result) {
            return ["result"=>"Book added to cart successfully."];
        } else {
            return ["result"=>"Fail to add into a cart."];
        }
		}
    }
    
    static function cartItem()
    {
        $userId=auth()->user()->id;
        //$userId=3;
        return Cart::where('user_id', $userId)->count();
    }
    
    public function remove($id)
    {
        
       /* if (!empty(Session::get('bookId'))) {

                $query=DB::table('books')->where('id', '=', Session::get('bookId'));
                 $query->increment('quantity', 1);

                Cart::destroy($id);
                return ["result"=>"Book remove from cart successfully."];
        }*/
        //return $id;
     /*   if (!empty($id)) {
       8        $query=DB::table('books')->where('id', '=', $id);
                $query->increment('quantity', 1);
        
               Cart::destroy($id);
        
               return ["result"=>"Book remove from cart successfully."];
        }*/
		$bookId=8;
		 $result= $this->cartBook->removeBook($id, $bookId);
			if ($result) {
            return ["result"=>"Book deleted successfully."];
        } else {
            return ["result"=>"Fail to remove from cart."];
        }
	}
}
