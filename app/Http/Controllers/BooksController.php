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
        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'Livro cadastrado com sucesso.');
        return redirect()->to($url);
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(BookRequest $request, Book $book)
    {
        $book->fill($request->all());
        $book->save();
        $request->session()->flash('message', 'Livro alterado com sucesso.');
        $url = $request->get('redirect_to', route('books.index'));
        return redirect()->to($url);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        \Session::flash('message', 'Livro excluido com sucesso.');
        return redirect()->to(\URL::previous());
    }
}
