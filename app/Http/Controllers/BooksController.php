<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookRequest;
use App\Repositories\BookRepository;
use Auth;
use Illuminate\Config\Repository;

class BooksController extends Controller
{

    /**
     * @var BookRepository
     */
    private $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $books = $this->repository->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(BookRequest $request)
    {
        $request['author_id'] = Auth::user()->id;
        $this->repository->create($request->all());
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

    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Livro excluido com sucesso.');
        return redirect()->to(\URL::previous());
    }
}
