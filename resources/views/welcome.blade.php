
@extends('templates.default')


@section('content')
    <div class="row">

        <div class="col-sm-8 offset-sm-2">

            <h1 class="display-3">Menu</h1>

            <div>
                <a href="{{ url('products') }}"  class="btn btn-primary" style="margin-right: 10px">Listar produtos</a>
                <a href="{{ url('categories') }}" class="btn btn-primary" style="margin-left: 10px">Listar categorias</a>
            </div>
        </div>
    </div>
@endsection    

