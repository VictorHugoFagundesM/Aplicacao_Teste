
@extends('templates.default')

@section('content')

	<div class="title">
		<h3 class="mb-0">Produtos</h3>
		<div>Visualize os produtos cadastradas</div>
	</div>

	@include('partials._alert')

	<div class="filters mt-4">
		<form method="GET" action="">
			<div class="input-group mb-3">
				<input type="text" class="form-control" name="search" placeholder="Pesquise por algo..." value="{{ Request::get('search') }}">
				<div class="input-group-append">
					<button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
				</div>
			</div>
		</form>
	</div>

	@if($products->count())

	<table class="table">

		<thead>
			<tr>
				<th>ID</th>
				<th>Categoria</th>
				<th>Tamanho</th>
				<th>Cor</th>
				<th>Nome</th>
				<th>Preço</th>
				<th>Qtde</th>
				<th>Descrição</th>
				<th>Data criação</th>
				<th>Data atualização</th>
				<th>Editar</th>
				<th>Deletar</th>
			</tr>
		</thead>

		<tbody>
			
			@foreach ($products as $product)
				<tr>
					<td>{{ $product->id }}</td>
					<td>{{ $product->category_name }}</td>
					{{-- <td>{{ $product->size_id ? $product->Size->name: '-'}}</td> --}}
					<td>{{ $product->size_name }}</td>
					<td>{{ $product->color_name }}</td>
					<td>{{ $product->name}}</td>
					<td>{{ $product->price}}</td>
					<td>{{ $product->amount}}</td>
					<td>{{ $product->description }}</td>
					<td>{{ $product->created_at }}</td>
					<td>{{ $product->updated_at }}</td>
					<td>
						<a href="{{ route('products.edit', $product->id)}}" class="btn btn-primary">Editar</a>
						{{-- <form action="{{ route('products.edit', $product->id) }}" method="GET">
							@csrf
							<button class="btn btn-primary" type="submit">Edit</button>
						</form> --}}
					</td>
					<td>
						<form action="{{ route('products.delete', $product->id) }}" method="POST">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger" type="submit">Delete</button>
						</form>
					</td>
				</tr>

			@endforeach
			
		</tbody>

	</table>

	{{-- Manter os dados da pesquisa quando mudar de pagina (paginação) --}}
	{{ $products->appends(request()->except('page'))->links() }}

	@else
		<div>Nenhum produto foi encontrado</div>
	@endif

	<div class="text-right"><a href="{{ route('products.create') }}" class="btn btn-primary">Criar novo produto</a></div>


@endsection