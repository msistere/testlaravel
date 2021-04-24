@extends('admin.layout.admin')

@section('title')
{{ __('Editar producto') }} '{{ $producto->name }}' | {{ __('Productos') }}
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
	<li class="breadcrumb-item"><a href="{{ url('admin/productos') }}">{{ __('Productos') }}</a></li>
	<li class="breadcrumb-item active">{{ __('Editar producto') }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="fade-in">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					{!! Form::model($producto, ['method' => 'put', 'id' => 'product', 'route' => ['productos.update', $producto->id ], 'accept-charset' => 'utf-8', 'class' => 'needs-validation', 'novalidate', 'enctype' => 'multipart/form-data']) !!}
					<div class="card-header">
						{{ __('Editar producto') }}: <b>{{ $producto->name }}</b>
					</div>
					<div class="card-body">
						@include('admin.products.fields')
					</div>
					<div class="card-footer text-right">
        				<a href="{{ url('admin/productos')}}" class="btn btn-secondary">{{ __('Cancelar') }}</a>
        				{{ Form::submit(__('Guardar'), [ 'class' => 'btn btn-primary']) }}
        			</div>
        			{!! Form::close() !!}
				</div>
			</div>
		</div>
		<div class="form-row">
    		<div class="form-group col-auto">
    			<div class="card">
    				<div class="card-header">
    					{!! Form::label('prices', __('Tarifas')) !!}
    					<div class="card-header-actions">
							<a class="btn btn-primary" href="{{ route('productos.tarifas.create', $producto->id) }}">{{__('Añadir tarifa') }}</a>
						</div>
    				</div>
    				<div class="card-body">
                    	<table id="prices">
                    		<thead>
                    			<th>{{ __('Inicio') }}</th>
                    			<th>{{ __('Fin') }}</th>
                    			<th>{{ __('Tarifa') }} (€)</th>
                    			<th>{{ __('Acciones') }}</th>
                    		</thead>
                    		<tbody>
                    		@foreach($producto->prices as $price)
                    			<tr>
                    				<td>{{ date('d/m/Y', strtotime($price->from)) }}</td>
                    				<td>{{ date('d/m/Y', strtotime($price->to)) }}</td>
                    				<td>{{ number_format($price->price, 2, ',', '.') }} &euro;</td>
                    				<td>
                    					<a class="btn btn-primary" href="{{ route('productos.tarifas.edit', ['producto' => $producto->id, 'tarifa' => $price->id]) }}">{{ __('Edita') }}</a>
    									<a class="btn btn-danger" href="javascript:;" onclick="deletePrice({{ $price->id }}, '{{ number_format($price->price, 2, ',', '.') }}')" data-id="{{ $price->id }}" data-toggle="modal" data-target="#price_delete_confirm">
    										{{ __('Eliminar') }}
    									</a>
                    				</td>
                    			</tr>
                    		@endforeach
                    		</tbody>
                    	</table>
                    </div>
               </div>
        	</div>
		</div>
	</div>
</div>
@endsection
