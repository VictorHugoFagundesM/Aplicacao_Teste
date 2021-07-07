@extends('templates.default')

@section('content')

	<div class="title">
		<h3 class="mb-0">Categorias</h3>
		<div>Cadastre uma nova categoria</div>
    </div>
    
    @include('partials._alert')

    <div class="mt-2">
        <form method="POST" action="{{ url('categories') }}">

            @method($category->id ? 'PUT' : 'POST')

            @csrf

            <input type="hidden" name="id" value="{{ $category->id }}"/>

            <div class="form-group">    
                <label for="name">Nome:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}" required__/>
            </div>
            
            <a href="{{ url('categories') }}" title="Voltar" class="btn-default">Voltar</a>
            <button type="submit" class="btn btn-primary">
                {{ $category->id ? 'Atualizar' : 'Cadastrar' }} Categoria
            </button>
            
        </form>
    </div>

@endsection