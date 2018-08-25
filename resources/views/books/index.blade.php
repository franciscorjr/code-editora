@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de livros</h3>
            <a href="{{route('books.create')}}" class="btn btn-primary">Novo livro</a>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Ações</th>
                </tr>
                </thead>

                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>
                            <ul class="list-inline">
                                <li><a href="{{ route('books.edit', ['categorie' => $book->id]) }}">Editar</a></li>
                                <li>|</li>
                                <li>
                                    <?php $deleteForm = "delete-form-{$loop->index}"; ?>
                                    <a href="{{ route('books.destroy', ['categorie' => $book->id]) }}"
                                       onclick="event.preventDefault();document.getElementById('{{$deleteForm}}').submit();">Excluir</a>
                                    {!! Form::open(['route' => [
                                        'books.destroy',
                                         'book' => $book->id
                                         ], 'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:nome']) !!}
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $books->links() }}
        </div>
    </div>
@endsection