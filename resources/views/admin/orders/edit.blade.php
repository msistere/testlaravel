@extends('admin.layout.admin')

@section('title')
{{ __('Editar pedido') }} '{{ $pedido->id }}' | {{ __('Pedidos') }}
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
	<li class="breadcrumb-item"><a href="{{ url('admin/pedidos') }}">{{ __('Pedidos') }}</a></li>
	<li class="breadcrumb-item active">{{ __('Editar pedido') }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="fade-in">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					{!! Form::model($pedido, ['method' => 'put', 'id' => 'order', 'route' => ['pedidos.update', $pedido->id ], 'accept-charset' => 'utf-8', 'class' => 'needs-validation', 'novalidate']) !!}
					<div class="card-header">
						{{ __('Editar pedido') }}: <b>{{ $pedido->id }}</b>
					</div>
					<div class="card-body">
						@include('admin.orders.fields')
					</div>
					<div class="card-footer text-right">
        				<a href="{{ url('admin/pedidos')}}" class="btn btn-secondary">{{ __('Cancelar') }}</a>
        				{{ Form::submit(__('Guardar'), [ 'class' => 'btn btn-primary']) }}
        			</div>
        			{!! Form::close() !!}
				</div>
			</div>
		</div>		
	</div>
</div>
@endsection
