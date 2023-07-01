<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::select('id','name','price','description')->get();
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
}