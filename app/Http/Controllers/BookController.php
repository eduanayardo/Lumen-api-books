<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
    public function showAllBooks()
    {
        return response()->json(Book::all());
    }

    public function showOneBook($id)
    {
        return response()->json(Book::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'authors' => 'required',
            'isbn' => 'required|unique:books',
            'year' => 'required|numeric|digits:4',
            'edition_number' => 'numeric'
        ]);
        $book = Book::create($request->all());

        return response()->json($book, 201);
    }

    public function update($id, Request $request)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());

        return response()->json($book, 200);
    }

    public function delete($id)
    {
        Book::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}