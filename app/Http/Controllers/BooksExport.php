<?php
namespace App\Http\Controllers;

//namespace App\Exports;
//use App\Books;
use Excel;
use App\Models\Books;
use Maatwebsite\Excel\Facades\Concerns\FromCollection;
//cheking pull request
//use Maatwebsite\Excel\Concerns\FromCollection;
class BooksExport extends Controller
{
    function exportExcel()
    {
      //return Books::all();
        return Excel::download(new DataExport, 'book.xlsx');
    }
}

class DataExport implements FromCollection
{
    function collection()
    {
        return Books::all();
    }
}
