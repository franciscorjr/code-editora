<?php

namespace CodePub\Http\Controllers;

use CodePub\Criteria\FindByAuthorCriteria;
use CodePub\Criteria\FindByTitleCriteria;
use CodePub\Http\Requests\BookUpdateRequest;
use CodePub\Models\Book;
use CodePub\Http\Requests\BookCreateRequest;
use CodePub\Repositories\BookRepository;
use Auth;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;

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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = $this->repository->paginate(10);
        return view('books.index', compact('books','search'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(BookCreateRequest $request)
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

    public function update(BookUpdateRequest $request, $id)
    {
        $data = $request->except(['author_id']);
        $this->repository->update($data, $id);
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
