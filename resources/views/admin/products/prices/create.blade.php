@extends('admin.layout.admin')

@section('title')
{{ __('Añadir tarifa') }} | {{ __('Producto') }}: {{ $producto->name }} | {{ __('Productos') }}
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Inicio') }}</a></li>
	<li class="breadcrumb-item"><a href="{{ url('admin/productos') }}">{{ __('Productos') }}</a></li>
	<li class="breadcrumb-item"><a href="{{ route('productos.show', $producto->id) }}">{{ __('Producto') }}: {{ $producto->name }}</a></li>
	<li class="breadcrumb-item active">{{ __('Añadir tarifa') }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="fade-in">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<form class="needs-validation" method="post" action="{{ route('productos.tarifas.store', [ 'producto' => $producto->id ]) }}" novalidate>
					@csrf
					<div class="card-header">
						{{ __('Añadir tarifa de') }} <b>{{ $producto->name }}</b>
					</div>
					<div class="card-body">						
						@include('admin.products.prices.fields')
					</div>
					<div class="card-footer text-right">
        				<a href="{{ route('productos.edit', $producto->id)}}" class="btn btn-secondary">{{ __('Cancelar') }}</a>
        				{{ Form::submit(__('Guardar'), [ 'class' => 'btn btn-primary']) }}
        			</div>
        			</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
