<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use Session;

class Cart extends Model
{
    use HasFactory;
	public $fillable = ['book_id','user_id'];
	
	public function show($userId){
		//dd($userId);
		return $this->join('books', 'carts.book_id', '=', 'books.id')
            ->where('carts.user_id', $userId)
            ->select('books.*', 'carts.id as cart_id')
            ->get();
	}
	
	     public function addBookToCart($data,$book_id,$userId){
          //   dd($userId);
			 $count = $this->where('book_id', $book_id)->count();
          //  dd($count); 
			$ct = $this->where('user_id', $userId)->count();
					if ($count >= 1 && $ct > 0) {
							return redirect('dashboard')->with('error', "Book is already in cart");
					}
					$query= Book::where('id', '=', $book_id);
					$query->decrement('quantity', 1);
					
					$this->create($data);
		 }
	
	public function removeBook($id)
	{
		
        if (!empty(Session::get('bookId'))) {
		
		$query=Book::where('id', '=', Session::get('bookId'));
		$query->increment('quantity', 1);
		 $this->destroy($id);
	  
		}
	}
	public function cartItems($userId)
	{
		return $this->where('user_id', $userId)->count();
	}
	
}
