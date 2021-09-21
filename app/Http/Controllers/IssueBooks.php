<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Cart;
//use App\Models\borrow;
use App\Models\IssueBook;
use App\Models\User;
//use Maatwebsite\Excel\Facades\Excel;
//use App\Post;
use Excel;
use Illuminate\Database\Eloquent\Collection;
//use Maatwebsite\Excel\Facades\Concerns\FromCollection;
use App\Imports\BookImport;
//use Illuminate\Database\Query\Builder;
use DB;
use PDF;
//use App\Repositories\UserRepository;
//use File;
use Illuminate\Filesystem\Filesystem;

class IssueBooks extends Controller
{
    
	/*public function user()
    {
        return $this->belongsTo('App\User');
    }*/
    
     //protected $users;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(IssueBook $issueBooks)
    {
        $this->issueBook = $issueBooks;
    }

	public function requestBook(){
		$borrow=$this->issueBook->requestBook();
		return view("Books.requestBook",['issue_book'=>$borrow]);
	}
	
	public function approvePage($id,$id2){
		//$book=User::find($id2);
		//$book1=IssueBook::find($id);
		$book1=$this->issueBook->bookId($id2);
		$book=$this->issueBook->userId($id);
		return view("Books.approve",['book'=>$book],['book1'=>$book1]);
	}
	
	public function approveRequest(Request $request){
		$this->validate($request,[
			'approve'=>'required',
			'issue_date'=>'required',
			'return_date'=>'required',
		]);
		$id=$request->id;
		$id2=$request->id2;
		$approve=$request->approve;
		$issue_date=$request->issue_date;
		$return_date=$request->return_date;
		$borrow=$this->issueBook->acceptRequest($id, $id2, $approve, $issue_date, $return_date);
		
		return back()->with("success","Request Accepted.");
	}
	
	
	public function borrowList(){
		$userId=auth()->user()->id;
		$borrow=$this->issueBook->listBorrow($userId);
		return view("Books.borrowList",['issue_book'=>$borrow]);
	}
	
	public function borrowBookList(){
		$borrow=$this->issueBook->listOfBorrow();
		return view('Books.borrowBook',['issue_book'=>$borrow]);
	}
		
	
   /* public function borrownow1(){
		try{
		   if (!auth()->user()) {
                   return back()->with('error', "You Must Have To Login To borrow book.");
            } 
			else {
                $userId=auth()->user()->id;
				$allCart=Cart::where('user_id','=',$userId);
				$borrow=$this->issueBook->borrowNow($allCart, $userId);
				return redirect("/dashboard")->with("error","Request has been sent");
              }
            
        } catch (\Exception $e) {
            return back()->with('error', "Fail to borrow Book.");
        }
	}
	*/
	public function borrowNow(Request $request)
    {
      
       
            try {
            //dd($request->$book->id);
            if (!auth()->user()) {
                   return back()->with('error', "You Must Have To Login To borrow book.");
            } 
			else {
                $userId=auth()->user()->id;
				$allCart=Cart::where('user_id','=',$userId)->get();
				$borrow=$this->issueBook->borrowBook($allCart, $userId);
				//dd($borrow);
				return redirect("/dashboard")->with("success","Request has been sent");
              }
            
        } catch (\Exception $e) {
            return back()->with('error', "Fail to borrow Book.");
        }
    }
	
	public function returnBookList(){
		$borrow=$this->issueBook->returnBook();
		return view("Books.returnBook",['issue_book'=>$borrow]);
	}
	
	public function returnBook($id,$id2){
		$borrow=$this->issueBook->returnBooks($id,$id2);
		return back()->with("success","Book Return successfully.");
	}
	
    public function borrowBook(Request $request)
    {
      
        try {
            //dd($request->$book->id);
            if (!auth()->user()) {
                   return back()->with('error', "You Must Have To Login To borrow book.");
            } 
			else {
                $userId=auth()->user()->id;
				$allCart=Cart::where('user_id','=',$userId);
				$borrow=$this->issueBook->borrowNow($allCart, $userId);
				return redirect("/dashboard")->with("error","Request has been sent");
              }
            
        } catch (\Exception $e) {
            return back()->with('error', "Fail to borrow Book.");
        }
    }
    
	public function downloadPdf()
	{
		$pdf=\App::make('dompdf.wrapper');
		$userId=auth()->user()->id;
		$borrow=$this->issueBook->pdfDownload($userId);
			  $output = '
		 <h3 align="center">Borrow Book List</h3>
		 <table width="100%" style="border-collapse: collapse; border: 0px;">
		  <tr>
			<th style="border: 1px solid; padding:12px;" width="15%">ISBN</th>
		<th style="border: 1px solid; padding:12px;" width="20%">Book Name</th>
		<th style="border: 1px solid; padding:12px;" width="30%">Author</th>
		 <th style="border: 1px solid; padding:12px;" width="15%">Publisher</th>
		<th style="border: 1px solid; padding:12px;" width="20%">Description</th>
	   
	   </tr>
		 ';
			foreach ($borrow as $book) {
				$output .= '
		  <tr>
		   <td style="border: 1px solid; padding:12px;">'.$book->isbn.'</td>
		   <td style="border: 1px solid; padding:12px;">'.$book->title.'</td>
		   <td style="border: 1px solid; padding:12px;">'.$book->author.'</td>
		   <td style="border: 1px solid; padding:12px;">'.$book->publisher.'</td>
		  
		   <td style="border: 1px solid; padding:12px;">'.$book->description.'</td>
		  </tr>
		  ';
			}
        $output .= '</table>';
        
		$pdf->loadHTML("$output");
		return $pdf->download("borrowList.pdf");
	}
	
}
