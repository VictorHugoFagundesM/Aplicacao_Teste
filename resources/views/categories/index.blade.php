
@extends('templates.default')

@section('content')

	<div class="title">
		<h3 class="mb-0">Categorias</h3>
		<div>Visualize as categorias cadastradas</div>
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

	@if($categories->count())

	<table class="table">

		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Criação</th>
				<th>Alteração</th>
				<th>Editar</th>
				<th>Deletar</th>
			</tr>
		</thead>
		
		<tbody>

			@foreach ($categories as $category)
				@php
					// $cloth
				@endphp
				<tr>
					<td>{{ $category->id }}</td>
					<td>{{ $category->name }}</td>
					<td>{{ $category->created_at ? $category->created_at->format('d/m/Y H:i:s') : '-' }}
					<td>{{ $category->updated_at ? $category->updated_at->format('d/m/Y H:i:s') : '-' }}
					<td>
						<a href="{{ url('categories/'.$category->id.'/edit') }}" class="btn btn-primary">Editar</a>
					</td>
					<td>
						<form action="{{ url("categories/{$category->id}/delete") }}" method="POST">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger" type="submit">Delete</button>
						</form>
					</td>
				</tr>

			@endforeach
			
		</tbody>

	</table>

	{{ $categories->appends(request()->except('page'))->links() }}

	@else
		<div>Nenhuma categoria foi encontrada</div>
	@endif

	<div class="text-right"><a href="{{ url('categories/create') }}" class="btn btn-primary">Criar nova categoria</a></div>

@endsection