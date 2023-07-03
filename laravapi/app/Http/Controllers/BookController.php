<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Exports\ExportBook;
use App\Imports\BooksImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::select('id','name','price','description')->paginate(12);
    }

    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required',
            'price' =>'required',
            'description' => 'required'
        ]);
        Book::create($request->post());
        return response()->json([
            'message' => 'Boook created successfully'
        ]);
    }


    public function show(Book $book)
    {
      return response()->json([
        'book' => $book
      ]);
    }


    public function update(Request $request, Book $book)
    {
        $request->validate([
            'name' => 'required',
            'price' =>'required',
            'description' => 'required'
        ]);
        $book->fill($request->post())->update();
        return response()->json([
             'message' => 'Book update successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([
            'message' => 'Book delete successfully'
        ]);

    }

    public function exportBooks(){
        return Excel::download(new ExportBook, 'books.xlsx');
    }

    public function importBooks()
    {
        Excel::import(new BooksImport, request()->file('file'));
          return response()->json([
            'message' => 'ajoute bien'
        ]);
    }
}