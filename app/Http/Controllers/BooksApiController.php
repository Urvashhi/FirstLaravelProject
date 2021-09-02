<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Books;

use App\Models\Cart;

use App\Models\IssueBook;

use DB;

class BooksApiController extends Controller
{
    public function index(Request $request)
    {
          $search=$request->search;
           
        if (isset($search)) {
            $record_per_page = isset($request->record_per_page) ? $request->record_per_page : 3;
            $search_text = $search;
            //dd($search_text);
            return books::where('title', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('description', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('id', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('category', 'LIKE', '%'.$search_text.'%')
                                ->sortable()
                                ->paginate($record_per_page);
        } else {
            $record_per_page = isset($request->record_per_page) ? $request->record_per_page: 3;
            return books::sortable()->paginate($record_per_page);
        }
    }
        
    public function singleBook($id)
    {
        return Books::all()->where('id', $id)->first();
    }
    
    public function borrowNow()
    {
            
               //$userId=auth()->user()->id;
               $userId=3;
               $cartDetail = Cart::where('user_id', $userId)->get();
        foreach ($cartDetail as $cart) {
            $issue =new IssueBook;
            $issue->user_id=$cart['user_id'];
            $issue->book_id=$cart['book_id'];
            $issue->approve="pending";
            $issue->issue_date="pending";
            $issue->return_date="pending";
            Cart::where('user_id', $userId)->delete();
            $result=$issue->save();
            if ($result) {
                             return ["result"=>"Book Borrowed successfully Successful."];
            } else {
                           return ["result"=>"Fail Borrow book."];
            }
                    /* if (IssueBook::where('approve', $issue->approve === 'return')->where('user_id',3 )->where('book_id',4)){
                      // $issue =new IssueBook;
                        $issue->user_id=$cart['user_id'];
                     $issue->book_id=$cart['book_id'];
                     //dd($issue->book_id);
                        $issue->approve="pending";
                     $issue->issue_date="pending";
                     $issue->return_date="pending";
                      Cart::where('user_id', $userId)->delete();

                    $result=$issue->save();
                     if ($result) {
                        return ["result"=>"Book Borrowed successfully Successful."];
                     } else {
                        return ["result"=>"Fail Borrow book."];
                     }
                  /*  }

                   if (IssueBook::where('approve', $issue->approve === 'yes')->where('user_id', 3)->where('book_id',4) ){
                      return ["result"=>"You can't borrow book same book."];
                    }
                    if (IssueBook::where('approve', $issue->approve === 'pending')->where('user_id',3 )->where('book_id',4)) {
                         // $issue =new IssueBook;
                        $issue->user_id=$cart['user_id'];
                        $issue->book_id=$cart['book_id'];
                        //dd($issue->book_id);
                        $issue->approve="pending";
                        $issue->issue_date="pending";
                        $issue->return_date="pending";
                         Cart::where('user_id', $userId)->delete();
                        $result=$issue->save();
                          if ($result) {
                     return ["result"=>"Book Borrowed successfully Successful."];
                         } else {
                     return ["result"=>"Fail Borrow book."];
                         }
                    }*/
        }
    }
}
