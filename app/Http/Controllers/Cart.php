<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class Cart extends Controller
{
   
    
    public function cart()
    {
        try {
            //$book = Books::all();
            return view('books.cartList');
        } catch (\Exception $e) {
            return redirect('/cart');
        }
    }
    
    public function addToCart($id)
    {
        //echo"jksakhdd";
        //echo $book->id;
        $book = Books::find($id);
        //dd($book);
        $cart= session()->get('cart');
        //dd($cart);
        // if cart is empty then this the first product
        if (!$cart) {
        //dd("sdjsd");
            $cart =[
            $id =>[
            'image' => $book->image,
            'title' => $book->title,
            'author'=>$book->author,
            'category'=>$book->category,
            'quantity'=> 1
            ]
            ];
        //dd($cart);
            //print_r($id);
            //$cat=session()->put('cart', $cart);
            //dd($cat);
            session()->put('cart', $cart);
            //dd(session()->put('cart', $cart));
            return redirect('/home')->with('success', "Book added to cart.");
        }
            // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {
          //dd("FTRT");
          //$cart[$book->id]['quantity']++;
            $cart[$id]['quantity']++;
          //session('cart', $cart);
          //dd(session('cart'));
            session()->put('cart', $cart);
          //dd(session()->put('cart',$cart));
            return redirect('/home')->with('success', "Book added to cart.");
        }
            
        // if item not exist in cart then add to cart with quantity = 1
         $cart[$id] = [
           'image' => $book->image,
           'title' => $book->title,
           'author'=>$book->author,
           'category'=>$book->category,
           'quantity'=>$book->quantity
            
           ];
               //echo $book->title;
           //dd($cart);
           //session('cart', $cart);
           //dd(session('cart'));
           session()->put('cart', $cart);
           //dd(session('cart', $cart));
           return redirect('/home')->with('success', "Book added to cart.");
    }
    
    public function remove($id)
    {
        //dd($id);
        $cart=session()->get('cart');
            
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
         return redirect('/cart')->with('success', "Book removed from cart successfully");
            
         //$request->session()->forget('cart');
    }
}
