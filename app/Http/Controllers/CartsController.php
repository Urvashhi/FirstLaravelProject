<?php

namespace App\Http\Controllers;

use Auth;
//use App\Model\Books;
use App\Models\Cart;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class CartsController extends Controller
{
   
    
    public function cart()
    {
        try {
            $userId=auth()->user()->id;
            $books=Cart
            ::join('books', 'cart.book_id', '=', 'books.id')
            ->where('cart.user_id', $userId)
            ->select('books.*', 'cart.id as cart_id')
            ->get();
            return view('books.cartForm', ['books'=>$books]);
        } catch (\Exception $e) {
            return redirect('/cart');
        }
    }
    
    public function addToCart(Request $request)
    {
        //DD("sdsSD");
            $this->validate($request, [
                'book_id'                 =>' unique:carts,book_id',
                'user_id'               => 'unique:carts,user_id'
                ]);
        
             $cart=new Cart;
             $cart->book_id=$request->id;
             // dd($cart->book_id);
             $id=$cart->book_id;
             $request->session()->put('bookId', $id);
             $cart->user_id=auth()->user()->id;
              
             $count =Cart::where('book_id', $cart->book_id)->count();
             
            $ct = DB::table('cart')->where('user_id', $cart->user_id)->count();
        if ($count >= 1 && $ct > 0) {
                return redirect('dashboard')->with('error', "Book is already in cart");
        }
            
             
            $query= DB::table('books')->where('id', '=', $id);
            $query->decrement('quantity', 1);
            
            
            $cart->save();
             return redirect('dashboard')->with('success', "Book added to cart successfully");
    }
    
    static function cartItem()
    {
        //echo "sjdggsew";
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
        if (!empty(Session::get('bookId'))) {
           // dd(Session::get('bookId'));
    
        //dd( Session::get('bookId'));
                //$query = DB::table('books')->latest('id');
                $query=DB::table('books')->where('id', '=', Session::get('bookId'));
                 $query->increment('quantity', 1);
        
                Cart::destroy($id);
                return redirect('cart_log')->with('success', "Book removed successfully");
        }
    }
}
