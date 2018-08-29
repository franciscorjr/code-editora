@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar autor</h3>


            {!! Form::model($author, [
                'route' => ['authors.update', 'author' => $author->id],
                 'class' => 'form', 'method' => 'PUT']) !!}

            @include('authors._form')

            <div class="form-group">
                {!! Form::submit('Criar autor', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection