<?php
namespace App;
namespace App\Models;
use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class books extends Model
{
	use Sortable;
    use HasFactory;
	public $table = "books";
	public $fillable = [ 'id','title','author', 'description','category'];
	public $sortable = ['id', 'title','author', 'description', 'category'];
}
