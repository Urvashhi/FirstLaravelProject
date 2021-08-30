<?php
namespace App;

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use Sortable;
    use HasFactory;
    public $table = "books";
    public $fillable = ['isbn','title','author','publisher','year', 'description','lang','category','quantity','image'];
    public $sortable = ['id', 'title','author', 'description', 'category'];
     public $timestamps= false;
}
