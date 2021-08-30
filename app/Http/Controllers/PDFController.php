<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class PDFController extends Controller
{
                     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookList()
    {
        /*$data = [
            'title' => 'Welcome to Ashi's Library,
            'date' => date('m/d/Y')
        ];*/
        $books=DB::table('books')=>get();
        view()->share('books.bookList', $books)
          
        if ($request->has('download'){
            $pdf = PDF::loadView('Books.bookList');
    
            return $pdf->download('Books.bookList.pdf');
        }
        return view("Books.bookList");
    }
}
