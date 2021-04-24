@extends('admin.layout.admin')

@section('title')
{{ __('Ver categoría') }} '{{ $category->name }}' | {{ __('Categorías') }}
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Inicio') }}</a></li>
	<li class="breadcrumb-item"><a href="{{ url('admin/categorias') }}">{{ __('Categorías') }}</a></li>
	<li class="breadcrumb-item active">{{ __('Ver categoría') }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="fade-in">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						{{ __('Ver categoría') }}: <b>{{ $category->name }}</b>
						<div class="card-header-actions">
                			<a class="btn btn-block btn-primary" href="{{ route('categorias.edit', $category->id) }}">{{ __('Editar categoría') }}</a>
                		</div>
					</div>
					<div class="card-body">
						@include('admin.categories.show_fields')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection