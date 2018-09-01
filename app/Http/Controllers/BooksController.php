<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;
use Auth;

class BooksController extends Controller
{

    public function index()
    {
        $books = Book::query()->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(BookRequest $request)
    {
        $request['author_id'] = Auth::user()->id;
        Book::create($request->all());
        return redirect()->route('books.index');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(BookRequest $request, Book $book)
    {
        if ($request['author_id'] ==  Auth::user()->id){
            $book->fill($request->all());
            $book->save();
        }

        return redirect()->route('books.index');
    }

    public function destroy(Book $book)
    {
        if ($book->author_id == Auth::user()->id){
            $book->delete();
        }
        return redirect()->route('books.index');
    }
}
