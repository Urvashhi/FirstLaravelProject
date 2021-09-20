<?php
// phpcs:ignoreFile

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
    
	
	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
	
    public function show($search, $record_per_page)
    {

        if (isset($search)) {
            $search_text = $search;
               
            $record_per_page = isset($record_per_page) ? $record_per_page: 3;
                    
            $books = $this->where('title', 'LIKE', '%'.$search_text.'%')
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
     
    public function storeBook($book)
    {
        $this->create($book);
    }

    public function updateBook($data, $id)
    {
        $this->where('id', $id)->update($data);
    }
    
    public function deleteBook($id)
    {
        
        $this->where('id', $id)->delete();
    }

    public function bookEdit($id)
    {
          $book= $this->where('id', $id)->first();
          return $book;
    }
    
    public function bookSingle($id)
    {
        return $this->where('id', $id)->first();
    }
}
