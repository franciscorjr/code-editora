@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de categorias</h3>
            {!! Button::primary('Nova categoria')->asLinkTo(route('categories.create')) !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($categories->items())->striped()
                    ->callback('Ações', function ($field, $category){
                        $linkEdit = route('categories.edit', ['categorie' => $category->id]);
                        $linkDestroy = route('categories.destroy', ['categorie' => $category->id]);
                        $deleteForm = "delete-form-{$category->id}";
                        $form = Form::open(['route' =>
                                        ['categories.destroy', 'category' => $category->id],
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
            {{ $categories->links() }}
        </div>
    </div>
@endsection