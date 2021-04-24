@extends('admin.layout.admin')

@section('title')
{{ __('Ver producto') }} '{{ $producto->name }}' | {{ __('Productos') }}
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Inicio') }}</a></li>
	<li class="breadcrumb-item"><a href="{{ url('admin/productos') }}">{{ __('Productos') }}</a></li>
	<li class="breadcrumb-item active">{{ __('Ver producto') }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="fade-in">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						{{ __('Ver producto') }}: <b>{{ $producto->name }}</b>
						<div class="card-header-actions">
                			<a class="btn btn-primary" href="{{ route('productos.edit', $producto->id) }}">{{ __('Editar producto') }}</a>
                			<a class="btn btn-primary" href="{{ route('products.pdf', $producto->id) }}">{{ __('PDF') }}</a>
                			<a class="btn btn-danger" href="javascript:;" onclick="deleteData('{{ $producto->id }}', '{{ $producto->name }}')" data-id="{{ $producto->id }}" data-toggle="modal" data-target="#delete_confirm">
    						{{ __('Eliminar producto') }}
    						</a>
                		</div>
					</div>
					<div class="card-body">
						@include('admin.products.show_fields')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection