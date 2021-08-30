<?php

namespace App\Imports;

use App\Models\Books;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\withHeadingRow;

class BookImport implements ToModel, withHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Books([
         //'id' => $row['id'],
            'isbn' => $row['isbn'],
             'title' => $row['title'],
              'author' => $row['author'],
               'publisher' => $row['publisher'],
                'year' => $row['year'],
                 'description' => $row['description'],
                  'lang' => $row['lang'],
                  'category' => $row['category'],
                   'quantity' => $row['quantity'],
                    'image' => $row['image']
                     
        ]);
    }
}
