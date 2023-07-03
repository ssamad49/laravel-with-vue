<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;

class BooksImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       return new Book([
            'name' => $row[0],
            'price' => $row[1],
            'description' => $row[2],
        ]);
    }
}