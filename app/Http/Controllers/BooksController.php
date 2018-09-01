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
        if ($request['author_id'] ==  Auth::user()->id){
            $book->fill($request->all());
            $book->save();
            $request->session()->flash('message', 'Livro alterado com sucesso.');
        }else{
            $request->session()->flash('message', 'Usuário sem permissão, açao bloqueada');
        }

        $url = $request->get('redirect_to', route('books.index'));
        return redirect()->to($url);
    }

    public function destroy(Book $book)
    {
        if ($book->author_id == Auth::user()->id){
            $book->delete();
            \Session::flash('message', 'Livro excluido com sucesso.');
        }
        \Session::flash('message', 'Usuário sem permissão, açao bloqueada.');
        return redirect()->to(\URL::previous());
    }
}
