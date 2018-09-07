@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de livros</h3>
            {!! Button::primary('Novo livro')->asLinkTo(route('books.create')) !!}
        </div>
        <br>
        <div class="row">
            {!! Form::model([compact('search')], ['class' => 'form-inline', 'method' => 'GET']) !!}
                {!! Form::label('search', 'Pesquisar por título:', ['class' => 'control-label']) !!}
                {!! Form::text('search', null, ['class' => 'form-control']) !!}


            {!! Html::openFormGroup() !!}
                {!! Button::primary('Buscar')->submit() !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
        </div>
        <br>
        <div class="row">
            {!! 
                 Table::withContents($books->items())->striped()
                        ->callback('Ações', function ($field, $book){
                            $linkEdit = route('books.edit', ['book' => $book->id]);
                            $linkDestroy = route('books.destroy', ['book' => $book->id]);
                            $deleteForm = "delete-form-{$book->id}";
                            $form = Form::open(['route' =>
                                            ['books.destroy', 'book' => $book->id],
                                             'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:nome']).
                                             Form::close();
                            $anchorDestroy = Button::link('Excluir')
                                                ->asLinkTo($linkDestroy)->addAttributes([
                                                    'onclick' => "event.preventDefault();document.getElementById(\"{$deleteForm}\").submit();"
                                                ]);
                            return "<ul class=\"list-inline\">".
                                        "<li>". Button::link('Editar')->asLinkTo($linkEdit) ."</li>".
                                        "<li>|</li>".
                                        "<li>". $anchorDestroy ."</li>".
                                    "</ul>".
                                    $form;
                        })
             !!}
            {{ $books->links() }}
        </div>
    </div>
@endsection