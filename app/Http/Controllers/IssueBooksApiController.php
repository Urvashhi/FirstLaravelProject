<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\IssueBook;
use App\Models\Cart;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class IssueBooksApiController extends Controller
{
	
	public function __construct(IssueBook $issueBook)
    {
        $this->issueBook = $issueBook;
    }

   
    public function borrowNow()
    {
          $userId=auth()->user()->id;
		 // print($userId);
			$allCart=Cart::where('user_id','=',$userId)->get();
			print($allCart);
			$result=$this->issueBook->borrowBook($allCart, $userId);
			//return $result;
			if ($result) {
            return ["result"=>"Book borrow successfully."];
        } else {
            return ["result"=>"Fail to borrow book."];
        }
	}
    
	 public function borrowBookList()
    {
         $userId=auth()->user()->id;
		$borrow=$this->issueBook->listBorrow($userId);
		return $borrow;
	}
   
}
