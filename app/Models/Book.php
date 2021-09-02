<?php
namespace App;

namespace App\Models;
use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use Sortable;
    use HasFactory;
  
    public $fillable = ['isbn','title','author','publisher','year', 'description','lang','category','quantity','image'];
	
	 public function show($search,$record_per_page){

            if (isset($search)) {
               
                $search_text = $search;
               
				 $record_per_page = isset($record_per_page) ? $record_per_page: 3;
					
				$books = book::where('title', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('description', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('id', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('category', 'LIKE', '%'.$search_text.'%')
                                    ->sortable()
                                    ->paginate($record_per_page);
                return $books;
            } else {
                $record_per_page = isset($record_per_page) ? $record_per_page: 3;
                $books = book::sortable()->paginate($record_per_page);
               return $books;
            }
	 }
	 
	 public function store_book($book){
		Book::create($book);
	 }

	public function update_book($data,$id){
		Book::where('id', $id)->update($data);
	 }
	
	public function delete_book($id){
		Book::where('id', $id)->delete();
	 }

 
}
