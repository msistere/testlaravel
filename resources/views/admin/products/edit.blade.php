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
    				</div>
    				<div class="card-body">
                    	<table id="prices">
                    		<thead>
                    			<th>{{ __('Inicio') }}</th>
                    			<th>{{ __('Fin') }}</th>
                    			<th>{{ __('Precio') }}</th>
                    		</thead>
                    		<tbody>
                    		@foreach($producto->prices as $price)
                    			<tr>
                    				<td>{{ date('d/m/Y', strtotime($price->from)) }}</td>
                    				<td>{{ date('d/m/Y', strtotime($price->to)) }}</td>
                    				<td>{{ number_format($price, 2, ',', '.') }} &euro;</td>
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
