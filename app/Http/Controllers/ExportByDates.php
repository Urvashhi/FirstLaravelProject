<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Books;

use App\Models\IssueBook;

use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;
use Session;
use Excel;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportByDates extends Controller
{
    function exportData(Request $request)
    {
        $date=$request->date1;
         $date1=$request->date2;
        session::put('key', $date);
        session::put('key1', $date1);
        return Excel::download(new DataExport($request->exp_vlas), 'book.xlsx');
    }
}

class DataExport implements FromCollection, WithHeadings
{
    public function headings():array
    {
        return[
          'User name',
          'Title',
          'Author',
          'ISBN',
          'Language',
          'Status',
          'Date'
        ];
    }
    
    function collection()
    {
        $date=Session::get('key');
        $date1=Session::get('key1');
        //dd($this->exportData($id));
        //$request->id;
         /*$result=DB::table('issue_book')
               ->join('books', 'issue_book.book_id', '=', 'books.id')
               ->join('users', 'issue_book.user_id', '=', 'users.id')
               ->where('issue_book.approve',"pending")
               ->select('first_name','title','author','isbn','lang','approve')
                ->get()->toArray();
               // ->select( 'issue_book.*', 'users.id AS u_id', 'book.*' ,'issue_book.*' )
               //->get();
        /*$result = DB::table('issue_book')->join('books','issue_book.book_id','=','issue_book.id')

                    ->join('users','issue_book.user_id','=','issue_book.id')

               ->where('issue_book.approve','=',"approved")
               //->select('borrow.*','borrow.user_id','borrow.book_id')
            */
              return DB::table('issue_books')
               ->join('books', 'issue_books.book_id', '=', 'books.id')
               ->join('users', 'issue_books.user_id', '=', 'users.id')
               //->where('issue_book.approve', "borrow")
               ->whereBetween('issue_books.issue_date', array($date, $date1))
               // ->where('issue_book.issue_date', $date)
               ->select('first_name', 'title', 'author', 'isbn', 'lang', 'approve', 'issue_date')
                ->get();
    }
}
