<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Requests\AuthorRequest;

class AuthorsController extends Controller
{

    public function index()
    {
        $authors = Author::query()->paginate(10);
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(AuthorRequest $request)
    {
        Author::create($request->all());
        return redirect()->route('authors.index');
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(AuthorRequest $request, Author $author)
    {
        $author->fill($request->all());
        $author->save();
        return redirect()->route('authors.index');
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index');
    }
}
