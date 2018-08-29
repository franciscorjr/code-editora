@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo autor</h3>


            {!! Form::open(['route' => 'authors.store', 'class' => 'form']) !!}

            @include('authors._form')

            <div class="form-group">
                {!! Form::submit('Criar autor', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection