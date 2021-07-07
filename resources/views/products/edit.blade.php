@extends('templates.default')

@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Atualizar um produto</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('products.update', $product->id) }}">
            @method('PUT') 
            @csrf
            <div class="form-group">

                <label for="name">Nome:</label>
                <input type="text" class="form-control" name="name" value={{ $product->name }} />
            </div>

            <div class="form-group">
                <label for="price">Preço</label>
                <input type="text" class="form-control" name="price" value={{ $product->price }} />
            </div>

            <div class="form-group">
                <label for="amount">Quantidade:</label>
                <input type="text" class="form-control" name="amount" value={{ $product->amount }} />
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <input type="text" class="form-control" name="description" value={{ $product->description }} />
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
</div>
@endsection