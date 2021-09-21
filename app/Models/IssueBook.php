<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\User;

class IssueBook extends Model
{
    use HasFactory;
    //$table="issue_book";
   // public $timestamps= false;
   
    public function listOfBorrow()
    {
    
              return $this->join('books', 'issue_books.book_id', '=', 'books.id')
               ->join('users', 'issue_books.user_id', '=', 'users.id')
               ->where('issue_books.approve', "yes")
               // ->select( 'issue_book.*', 'users.id AS u_id', 'book.*' ,'issue_book.*' )
               ->get();
    }
   
    public function listBorrow($userId)
    {
        //dd($userId);
        return $this->join('books', 'issue_books.book_id', '=', 'books.id')
               ->where('issue_books.user_id', $userId)
               ->get();
    }
   
    public function returnBook()
    {
         $books=$this
               ->join('books', 'issue_books.book_id', '=', 'books.id')
               ->join('users', 'issue_books.user_id', '=', 'users.id')
               ->where('issue_books.approve', "return")
               // ->select( 'issue_book.*', 'users.id AS u_id', 'book.*' ,'issue_book.*' )
               ->get();
		return $books;
    }
     
    public function returnList()
    {
			  if (isset($search)) {
            $search_text = $search;
               
            $record_per_page = isset($record_per_page) ? $record_per_page: 3;
                    
          /*  $books = $this->where('title', 'LIKE', '%'.$search_text.'%')
                              ->orWhere('description', 'LIKE', '%'.$search_text.'%')
                              ->orWhere('id', 'LIKE', '%'.$search_text.'%')
                              ->orWhere('category', 'LIKE', '%'.$search_text.'%')
                              ->sortable()
                              ->paginate($record_per_page);
            */ return $this->join('books', 'issue_books.book_id', '=', 'books.id')
              ->join('users', 'issue_books.user_id', '=', 'users.id')
              ->where('issue_books.approve', "return")
              // ->select( 'issue_book.*', 'users.id AS u_id', 'book.*' ,'issue_book.*' )
              ->get();
			  }
    }
     
    public function requestBook()
    {
        
               $book =$this->join('books', 'issue_books.book_id', '=', 'books.id')
               ->join('users', 'issue_books.user_id', '=', 'users.id')
               ->where('issue_books.approve', "pending")
               // ->select( 'issue_book.*', 'users.id AS u_id', 'book.*' ,'issue_book.*' )
               ->get();
			  //dd($book);
          return $book;
              
          
       
    }
     
    public function returnBooks($id, $id2)
    {
         $borrow= $this->where('user_id', $id)->where('book_id', $id2)->update([
            'approve'=>"return"
        //'issue_date'=>$request->issue_date,
        //'return_date'=>$request->return_date
             ]);
            $query=Book::where('id', '=', $id);
            $query->increment('quantity', 1);
    }
    
    public function request()
    {
        return  $this->join('books', 'issue_books.book_id', '=', 'books.id')
               ->join('users', 'issue_books.user_id', '=', 'users.id')
               ->where('issue_books.approve', "pending")
               // ->select( 'issue_book.*', 'users.id AS u_id', 'book.*' ,'issue_book.*' )
               ->get();
    }
    
    public function bookId($id2)
    {
        return Book::where('id', $id2)->first();
    }
    public function userId($id)
    {
        return User::where('id', $id)->first();
    }
    
    public function acceptRequest($id, $id2, $approve, $issue_date, $return_date)
    {
        return $this->where('user_id', $id)->where('book_id', $id2)->update([
                    'approve' => $approve,
                    'issue_date' => $issue_date,
                    'return_date' => $return_date,
                ]);
    }
    
    public function sendMail($userId, $bookId)
    {
        
              return $this->join('books', 'issue_books.book_id', '=', 'books.id')
               ->join('users', 'issue_books.user_id', '=', 'users.id')
              // ->where("issue_book.approve",'=',"pending")->where('user_id',$userId)
               ->where("issue_books.approve", '=', "yes")->where('user_id', $userId)->where('book_id', $bookId)
               // ->select( 'issue_book.*', 'users.id AS u_id', 'book.*' ,'issue_book.*' )
               ->get();
    }
    
    public function pdfDownload($userId)
    {
    //dd($userId);
              $data= $this->join('books', 'issue_books.book_id', '=', 'books.id')
               ->where('issue_books.user_id', $userId)
               ->get();
               return $data;
    }
    
    public function borrowBook($allCart, $userId)
    {
		//print($allCart);
        foreach ($allCart as $cart) {
            //dd($bookid);
            $this->book_id=$cart['book_id'];
            $this->user_id=$cart['user_id'];
            $this->approve="pending";
            $this->issue_date="pending";
            $this->return_date="pending";
            
           $data=$this->save();
            
            Cart::where('user_id', $userId)->delete();
           return $data;
        }
    }
    
    
    public function exportDataByDate($date, $date1)
    {
             $export=   $this->join('books', 'issue_books.book_id', '=', 'books.id')
               ->join('users', 'issue_books.user_id', '=', 'users.id')
               //->where('issue_book.approve', "borrow")
               ->whereBetween('issue_books.issue_date')
               // ->where('issue_book.issue_date', $date)
               ->select('first_name', 'title', 'author', 'isbn', 'lang', 'approve', 'issue_date')
                ->get();
        return $export;
    }
}
