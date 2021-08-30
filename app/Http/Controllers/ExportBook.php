<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Books;

use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;
use Session;
use Excel;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBook extends Controller
{
    function exportData(Request $request)
    {
        $id=$request->id;
        Session::put('key', $id);
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
          'status'
        ];
    }
    
    function collection()
    {
        $userId=Session::get('key');
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
              return DB::table('issue_book')
               ->join('books', 'issue_book.book_id', '=', 'books.id')
               ->join('users', 'issue_book.user_id', '=', 'users.id')
               //->where('issue_book.approve', "borrow")
                ->where('issue_book.user_id', $userId)
               ->select('first_name', 'title', 'author', 'isbn', 'lang', 'approve')
                ->get();
    }
}
