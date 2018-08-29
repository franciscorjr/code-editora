@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de autores</h3>
            <a href="{{route('authors.create')}}" class="btn btn-primary">Novo autor</a>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
                </thead>

                <tbody>
                @foreach($authors as $author)
                    <tr>
                        <td>{{ $author->id }}</td>
                        <td>{{ $author->name }}</td>
                        <td>
                            <ul class="list-inline">
                                <li><a href="{{ route('authors.edit', ['categorie' => $author->id]) }}">Editar</a></li>
                                <li>|</li>
                                <li>
                                    <?php $deleteForm = "delete-form-{$loop->index}"; ?>
                                    <a href="{{ route('authors.destroy', ['author' => $author->id]) }}"
                                       onclick="event.preventDefault();document.getElementById('{{$deleteForm}}').submit();">Excluir</a>
                                    {!! Form::open(['route' => [
                                        'authors.destroy',
                                         'author' => $author->id
                                         ], 'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:nome']) !!}
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $authors->links() }}
        </div>
    </div>
@endsection