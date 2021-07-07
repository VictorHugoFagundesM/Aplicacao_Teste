@extends('templates.default')

@section('content')
<div class="row">

    <div class="col-sm-8 offset-sm-2">

        <h1 class="display-3">{{ $title }}</h1>
  
        {{-- @dd($errors); --}}
        @if ($errors->form->any())
            <div>
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->form->all() as $messageError)
                        <li>{{ $messageError }}</li>
                        @endforeach
                    </ul>
            </div><br />
        @endif
            
            @php
            
                if ($product->id) {
                    $formUrl = route('products.update', $product->id);
                    $formMethod = "PUT";
                    
                } else {
                    $formUrl = route('products.store');
                    $formMethod = "POST";
                }
            
            @endphp
            
            <form method="POST" action="{{ $formUrl }}">

                @method($product->id ? 'PUT' : 'POST')

                @csrf

                <div class="form-group">    
                    <label for="name">Nome:</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}"  />
                </div>

                <div class="form-group">
                    <label for="categories">Escolha uma categoria:</label> <br>

                    <select class="form-control" name="category_id" id="categories" required__ >
                        <option value="">Selecione uma categoria</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach

                    </select>

                </div>

                
                <div class="form-group">
                    <label for="size_id">Escolha um tamanho</label>

                    <select class="form-control" name="size_id" id="Size" required____ >
                        <option value="">Selecione um tamanho</option>

                        @foreach ($size as $Size)
                            <option value="{{ $Size->id }}" {{ $product->size_id == $Size->id ? 'selected' : '' }}>{{ $Size->name }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="color_id">Escolha uma cor</label>

                    <select class="form-control" name="color_id" id="Color">
                        <option value="">Selecione uma cor</option>

                        @foreach ($color as $Color)
                            <option value="{{ $Color->id }}" {{ $product->color_id == $Color->id ? 'selected' : '' }}>{{ $Color->name }}</option>
                        @endforeach

                    </select>   

                    {{-- 
                        <p></p> 
                        @foreach ($color as $Color)
                        <div>
                            <input type="checkbox" value ="{{ $Color->id }}" {{ $product->color_id == $Color->id ? 'checked' : '' }} name="color_id">
                            <label for="{{ $Color->id }}">{{ $Color->name }}</label>
                            
                        </div>
                    @endforeach --}}
                        
                </div>
                
                <div class="form-group">
                    <label for="price">Preço:</label>
                    <input type="text" class="form-control money" id="price" name="price" value="{{ $product->price }}" required__/>
                </div>
                
                <div class="form-group">
                    <label for="amount">Quantidade:</label>
                    <input type="text" class="form-control" name="amount" value="{{$product->amount}}" required__ />
                </div>
                
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <input type="text" class="form-control" name="description" value="{{$product->description}}" required__ maxlength="35" minlength="10"/>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    {{ $product->id ? 'Atualizar produto' : 'Adicionar produto' }}
                </button>
                
            </form>
        </div>

    </div>

</div>
@endsection