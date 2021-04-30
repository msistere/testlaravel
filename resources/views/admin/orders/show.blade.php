@extends('admin.layout.admin')

@section('title')
{{ __('Ver pedido') }} '{{ $pedido->id }}' | {{ __('Pedidos') }}
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Inicio') }}</a></li>
	<li class="breadcrumb-item"><a href="{{ url('admin/pedidos') }}">{{ __('Pedidos') }}</a></li>
	<li class="breadcrumb-item active">{{ __('Ver pedido') }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="fade-in">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						{{ __('Ver pedido') }}: <b>{{ $pedido->id }}</b>
						<div class="card-header-actions">
                			<a class="btn btn-primary" href="{{ route('pedidos.edit', $pedido->id) }}">{{ __('Editar pedido') }}</a>
                			<a class="btn btn-danger" href="javascript:;" onclick="deleteData('{{ $pedido->id }}')" data-id="{{ $pedido->id }}" data-toggle="modal" data-target="#delete_confirm">
    						{{ __('Eliminar pedido') }}
    						</a>
                		</div>
					</div>
					<div class="card-body">
						@include('admin.orders.show_fields')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
