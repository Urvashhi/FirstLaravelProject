<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\books;

//use Illuminate\Database\Query\Builder;

use DB;

//use File;
use Illuminate\Filesystem\Filesystem;

class BookController extends Controller
{
	public function addBook(){
		return view('books.add_book');
	}
	
	public function saveBook(Request $request){
		
		$this->validate($request,[
			'isbn' 			=> 'required',
			'title'			=> 'required',
			'author'		=> 'required',
			'publisher'		=> 'required',
			'year'		 	=> 'required',
			'description'	=> 'required',
			'lang'	=> 'required',
			'category'		=> 'required',
			'quantity'      => 'required',
			'image'			=> 'required|image|mimes:jpeg,png|max:2048',
			
	]);
		$imageName = time().'.'.$request->image->extension();
//dd($imageName);		
		 $abc=$request->image->move('upload/', $imageName);
		$request->image=$imageName;
		DB::table('books')->insert([
			'isbn' 			=> $request->isbn,
			'title' 		=> $request->title,
			'author' 		=> $request->author,
			'publisher'		=> $request->publisher,
			'year'			=> $request->year,
			'description'	=> $request->description,
			'lang'	=> $request->lang,
			'category' 		=> $request->category,
			'quantity' 		=> $request->quantity,
			'image' 		=> $request->image
			
			
		]);
		
		return back()->with('success',"Book inserted successfully.")->with('image',$imageName); 
	}
	
	public function bookList(Request $request){
		//$p=$_GET['perPage'];
		//dd($p);
		//nsbdjsjd
		  //$perPage = request('perPage', 2);
		  //dd($perPage);
		 
			//dd($record_per_page);
			//nndskjsd
			//$page=$request->page;
			
			//dd($page);
			$search=request()->query('search');
			if(isset($search)){
					$record_per_page = isset($_GET["record_per_page"]) ? $_GET["record_per_page"] : 3; 
				//echo "zdjbsdkj";
				$search_text = $search;
				//dd($search_text);
				$books = books::where('title','LIKE', '%'.$search_text.'%')->orWhere('description','LIKE', '%'.$search_text.'%')->orWhere('id','LIKE', '%'.$search_text.'%')->orWhere('category','LIKE', '%'.$search_text.'%')->sortable()->paginate($record_per_page);
			//dd($books);
			// Search in the title and body columns from the posts table
			/*$books = books::query()
				->where('title', 'LIKE', "%{$search}%")
				->get();*/
			//$books = DB::table('books')->paginate(5);
			// Return the search view with the resluts compacted
				return view('books.book_list', ['books' => $books]);
			}
			else
			{
					$record_per_page = isset($_GET["record_per_page"]) ? $_GET["record_per_page"] : 3; 
				$books = books::sortable()->paginate($record_per_page);
			//	dd($record_per_page);
				//$books=book::sortable()->paginate(3);
				//$books=book::sortable()->paginate(5);
				return view('books.book_list', compact('books'));
			}
		
	}
	
	public function editBook($id){
		$book = DB::table('books')->where('id', $id)->first();
		return view('books.edit_book', compact('book'));
	}
	
	public function updateBook(Request $request){
		if($request->image){
		$this->validate($request,[
			'isbn' 			=> 'required',
			'title'			=> 'required',
			'author'		=> 'required',
			'publisher'		=> 'required',
			'year'		 	=> 'required',
			'description'	=> 'required',
			'lang'	=> 'required',
			'category'		=> 'required',
			'quantity'      => 'required',
			'image'			=> 'required|image|mimes:jpeg,png|max:2048',
			
	]);
		$imageName = time().'.'.$request->image->extension();
//dd($imageName);		
		 $path=$request->image->move(public_path('upload/'), $imageName);
       
		$request->image=$imageName;
		
		DB::table('books')->where('id', $request->id)->update([
			'isbn' => $request->isbn,
			'isbn' 			=> $request->isbn,
			'title' 		=> $request->title,
			'author' 		=> $request->author,
			'publisher'		=> $request->publisher,
			'year'			=> $request->year,
			'description'	=> $request->description,
			'lang'	=> $request->lang,
			'category' 		=> $request->category,
			'quantity' 		=> $request->quantity,
			'image' 		=> $request->image
		]);
		return redirect('/book_list')->with('bookupdate', "Book data updated successfully");
		}
		else
		{
			$this->validate($request,[
			'isbn' 			=> 'required',
			'title'			=> 'required',
			'author'		=> 'required',
			'publisher'		=> 'required',
			'year'		 	=> 'required',
			'description'	=> 'required',
			'lang'	=> 'required',
			'category'		=> 'required',
			'quantity'      => 'required'
			
			
	]);
		//$imageName = time().'.'.$request->image->extension();
//dd($imageName);		
		// $path=$request->image->move(public_path('upload/'), $imageName);
       
		//$request->image=$imageName;
		
		DB::table('books')->where('id', $request->id)->update([
			'isbn' 			=> $request->isbn,
			'title' 		=> $request->title,
			'author' 		=> $request->author,
			'publisher'		=> $request->publisher,
			'year'			=> $request->year,
			'description'	=> $request->description,
			'lang'	=> $request->lang,
			'category' 		=> $request->category,
			'quantity' 		=> $request->quantity,
			//'image' 		=> $request->image
		]);
		return redirect('/book_list')->with('bookupdate', "Book data updated successfully");
		}
		//return redirect('admin/edit_book');
		
		//return back()->with('bookupdate',"Book data updated successfully")->with('image',$imageName);
	}
	
	public function deleteBook(Request $request,$id){
		$books = books::find($id);
		//$file_name = $request->image;
		$file_name = $books->image;
		//$imageName =  $request->image;	
		 
       
		$path=public_path('upload/'.$file_name);
		
	//	  $destinationPath = 'your_path';
 //File::delete($destinationPath.'/your_file');
		//$file->delete();
		$book = DB::table('books')->where('id', $id)->delete();
		unlink($path);
		return back()->with('deletebook',"Book deleted successfully");
	}
	
	
	
	public function search(Request $request){
    // Get the search value from the request
	//echo "fkhkjfrewh";
    //$search = $request->input('search');
	$record_per_page = isset($_GET["record_per_page"]) ? $_GET["record_per_page"] : 3; 
	if(isset($_GET['search'])){
		//echo "zdjbsdkj";
		$search_text = $_GET['search'];
		//dd($search_text);
		$books = books::where('title','LIKE', '%'.$search_text.'%')->orWhere('description','LIKE', '%'.$search_text.'%')->orWhere('id','LIKE', '%'.$search_text.'%')->orWhere('category','LIKE', '%'.$search_text.'%')->sortable()->paginate($record_per_page);
	//dd($books);
    // Search in the title and body columns from the posts table
    /*$books = books::query()
        ->where('title', 'LIKE', "%{$search}%")
        ->get();*/
	//$books = DB::table('books')->paginate(5);
    // Return the search view with the resluts compacted
		return view('books.book_list', ['books' => $books]);
	}
	else
	{
		//echo "dhskd";
			return view('books.book_list');
	}
	}
}
