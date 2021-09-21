<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

use App\Models\Cart;

use App\Models\IssueBook;

use DB;

class BooksApiController extends Controller
{
	 public function __construct(Book $books)
    {
        $this->book = $books;
    }

    public function index(Request $request)
    {
         $search=$request->search;
               $record_per_page = isset($request->record_per_page) ? $request->record_per_page: 3;
                $books=$this->book->show($search, $record_per_page);
				return $books;
    }
        
    public function singleBook($id)
    { 
		$book =$this->book->bookSingle($id);
             
        return $book;
    }
    
	public function borrowNow(){
		
	}

}
