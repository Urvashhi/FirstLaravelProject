<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Cart;
//use App\Models\borrow;
use App\Models\IssueBook;
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

class BooksController extends Controller
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
    public function __construct(Book $books)
    {
        $this->book = $books;
    }

    public function addBook()
    {
        try {
            return view('books.add_book');
        } catch (\Exception $e) {
            return redirect('/successlogin')->with('error', "Fail to get add Book page.");
        }
    }
    
    public function saveBook(Request $request)
    {
        
                $this->validate($request, [
                    'isbn'          => 'required',
                    'title'         => 'required',
                    'author'        => 'required',
                    'publisher'     => 'required',
                    'year'          => 'required',
                    'description'   => 'required',
                    'lang'          => 'required',
                    'category'      => 'required',
                    'quantity'      => 'required',
                    'image'         => 'required|image|mimes:jpeg,png,jpg',
                    
                ]);
        try {
                $imageName = time().'.'.$request->image->extension();
                //dd($imageName);
                $abc=$request->image->move('upload/', $imageName);
                $request->image=$imageName;
                
               $book=([
                    'isbn'          => $request->isbn,
                    'title'         => $request->title,
                    'author'        => $request->author,
                    'publisher'     => $request->publisher,
                    'year'          => $request->year,
                    'description'   => $request->description,
                    'lang'          => $request->lang,
                    'category'      => $request->category,
                    'quantity'      => $request->quantity,
                    'image'         => $request->image
                    
                ]);
                
            
                $this->book->storeBook($book);
                return back()->with('success', "Book inserted successfully.");
        } catch (\Exception $e) {
            return back()->with('error', "Fail to insert Book.");
        }
    }
    
    public function bookList(Request $request)
    {
       /* try {
            $search=$request->search;
            //$search=request()->query('search');
            if (isset($search)) {
                $record_per_page = isset($request->record_per_page) ? $request->record_per_page : 3;
                $search_text = $search;
                //dd($search_text);
                $books = books::where('title', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('description', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('id', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('category', 'LIKE', '%'.$search_text.'%')
                                    ->sortable()
                                    ->paginate($record_per_page);
                //dd($books);
                // Return the search view with the resluts compacted
                return view('books.book_list', ['books' => $books]);
            } else {
                $record_per_page = isset($request->record_per_page) ? $request->record_per_page: 3;
                $books = books::sortable()->paginate($record_per_page);
                //  dd($record_per_page);
                //$books=book::sortable()->paginate(3);
                //$books=book::sortable()->paginate(5);
                return view('books.book_list', compact('books'));
            }
        } catch (\Exception $e) {
            return view('books.notfound');
        }*/
        //$b=new Book;
        try {
             $search=$request->search;
               $record_per_page = isset($request->record_per_page) ? $request->record_per_page: 3;
                $books=$this->book->show($search, $record_per_page);
            //dd($books);
                return view('books.book_list', compact('books'));
        } catch (\Exception $e) {
             return view('books.notfound');
        }
    }
    
    public function editBook($id)
    {
        try {
            $book=$this->book->bookEdit($id);
             return view('books.edit_book', compact('book'));
        } catch (\Exception $e) {
            return back()->with('editid', "id not found ");
        }
    }
    
    public function updateBook(Request $request)
    {
        
        if ($request->image) {
            $this->validate($request, [
                    'isbn'          => 'required',
                    'title'         => 'required',
                    'author'        => 'required',
                    'publisher'     => 'required',
                    'year'          => 'required',
                    'description'   => 'required',
                    'lang'          => 'required',
                    'category'      => 'required',
                    'quantity'      => 'required',
                    'image'         => 'required|image|mimes:jpeg,png,jpg',
                            
            ]);
            try {
                $imageName = time().'.'.$request->image->extension();
                //dd($imageName);
                $path=$request->image->move(public_path('upload/'), $imageName);
                   
                $request->image=$imageName;
                        
                $data=([
                    'isbn' => $request->isbn,
                    'isbn'          => $request->isbn,
                    'title'         => $request->title,
                    'author'        => $request->author,
                    'publisher'     => $request->publisher,
                    'year'          => $request->year,
                    'description'   => $request->description,
                    'lang'          => $request->lang,
                    'category'      => $request->category,
                    'quantity'      => $request->quantity,
                    'image'         => $request->image
                ]);
                $id=$request->id;
                //$book_update=new Book;
                $this->book->updateBook($data, $id);
            } catch (\Exception $e) {
                 return back()->with('error', "Fail to update Book.");
            }
            return back()->with('success', "Book data updated successfully");
        } else {
                $this->validate($request, [
                'isbn'          => 'required',
                'title'         => 'required',
                'author'        => 'required',
                'publisher'     => 'required',
                'year'          => 'required',
                'description'   => 'required',
                'lang'          => 'required',
                'category'      => 'required',
                'quantity'      => 'required'
                
                
                ]);
                //$imageName = time().'.'.$request->image->extension();
                //dd($imageName);
                // $path=$request->image->move(public_path('upload/'), $imageName);
               
                //$request->image=$imageName;
            try {
                 $data=([
                    'isbn'          => $request->isbn,
                    'title'         => $request->title,
                    'author'        => $request->author,
                    'publisher'     => $request->publisher,
                    'year'          => $request->year,
                    'description'   => $request->description,
                    'lang'          => $request->lang,
                    'category'      => $request->category,
                    'quantity'      => $request->quantity,
                    //'image'       => $request->image
                    ]);
                    $id=$request->id;
                 // dd($id);
                 //$book_update=new book;
                 $this->book-> updateBook($data, $id);
            } catch (\Exception $e) {
                return back()->with('success', "Fail to update Book.");
            }
                return back()->with('error', "Book data updated successfully");
        }
                //return redirect('admin/edit_book');
                
                //return back()->with('bookupdate',"Book data updated successfully")->with('image',$imageName);
    }
    
    public function deleteBook($id)
    {
        try {
                $books = $this->book::find($id);
                //dd($books);
                //$file_name = $request->image;
                $file_name = $books->image;
                //$imageName =  $request->image;
                $path=public_path('upload/'.$file_name);
               // $book =new Book;
                $this->book->deleteBook($id);
                unlink($path);
                return back()->with('success', "Book deleted successfully");
        } catch (\Exception $e) {
            return back()->with('error', "Fail to delete Book.");
        }
    }
    
    public function borrowBook(Request $request)
    {
      
        try {
            //dd($request->$book->id);
            if (!auth()->user()) {
                   return back()->with('error', "You Must Have To Login To borrow book.");
            } else {
                $userId=auth()->user()->id;
                $cartDetail = Cart::where('user_id', $userId)->get();
                foreach ($cartDetail as $cart) {
                    $issue =new IssueBook;
                    $issue->user_id=$cart['user_id'];
                    $issue->book_id=$cart['book_id'];
                    $issue->approve="pending";
                     $issue->issue_date="pending";
                     $issue->return_date="pending";
                        
                    $ct = IssueBook::where('user_id', $cart['user_id'])->count();
                 //   //dd($ct);
                    //$count = DB::table('issue_book')->where('book_id', $cart['book_id'])->count();
                    //$count = DB::table('cart')
                    //dd($ct);
                   /*if( $ct >=1)
                    {
                            //dd("djsahdsa");
                        return redirect('dashboard')->with('error',"One book is already you havde so you can't borrow second again.");
                    }*/
                    
                    if (IssueBook::where('approve', $issue->approve === 'return')) {
                             // $issue =new IssueBook;
                        $issue->user_id=$cart['user_id'];
                            $issue->book_id=$cart['book_id'];
                            //dd($issue->book_id);
                        $issue->approve="pending";
                            $issue->issue_date="pending";
                            $issue->return_date="pending";
                             Cart::where('user_id', $userId)->delete();
                            /*if(!Books::where('id',$cart->book_id)->where('quantity',">=",$cart->quantity))
                            {
                                $cartDetail= Cart::where('user_id',auth()->user()->id)->where('book_id',$book_id)->first();
                                $removeBook->delete();
                            }*/
                           $issue->save();
                            return redirect('/dashboard')->with('success', 'Your book request has been sent');
                    }
                }
            }
        } catch (\Exception $e) {
            return back()->with('error', "Fail to borrow Book.");
        }
    }
    public function singleBook($id)
    {
        try {
            //dd($id);
             $book =$this->book->bookSingle($id);
             
            //$data=['LoggedUserInfo'=>User::where('id', '=', session('LoggedUser'))->first()];
            //dd(session('LoggedUser'));
            return view('visitor.singleBook', compact('book'));
        } catch (\Exception $e) {
            return redirect('/dashboard')->with('error', "Fail to get detail of page.");
        }
    }
    
   
    
   
    function importForm()
    {
        return view('Books.importForm');
      //return Books::all();
    //return Excel::download(new DataExport, 'book.xlsx');
    }
  /**
   * Export to csv
   */
    public function importCSV(Request $request)
    {
        //dd("Ferereewrt");
        Excel::import(new BookImport, $request->file);
        return "Record are imported successfully";
    }
    
   /*  public function exportPDF() {
     //   ini_set('display_errors', 1);
        //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);

 $books = Books::all();

      // share data to view
      view()->share('books',$books);
      $pdf = PDF::loadView('Books.book_list', $books);

      // download PDF file with download method
      return $pdf->download('pdf_file.pdf');
    //require_once __DIR__ . 'C:/xampp/php/PEAR/vendor/autoload.php';
     /*   $books= Books::all();
 view()->share('book',$books);
        //view()->share('p', $p);
        $pdf_doc = PDF::loadView('Books.book_list', compact('books'));

        return $pdf_doc->download('check_pdf.pdf');
    }*/
}
