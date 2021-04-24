@extends('admin.layout.admin')

@section('title')
{{ __('Añadir nueva categoría') }} | {{ __('Categorías') }}
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Inicio') }}</a></li>
	<li class="breadcrumb-item"><a href="{{ url('admin/categorias') }}">{{ __('Categorías') }}</a></li>
	<li class="breadcrumb-item active">{{ __('Añadir nueva categoría') }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="fade-in">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					{!! Form::open(['id' => 'category', 'route' => 'categorias.store', 'accept-charset' => 'utf-8', 'class' => 'needs-validation', 'novalidate']) !!}
					<div class="card-header">
						{{ __('Añadir nueva categoría') }}
					</div>
					<div class="card-body">
						@include('admin.categories.fields')
					</div>
					<div class="card-footer text-right">
        				<a href="{{ url('admin/categorias')}}" class="btn btn-secondary">{{ __('Cancelar') }}</a>
        				{{ Form::submit(__('Guardar'), [ 'class' => 'btn btn-primary']) }}
        			</div>
        			{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')

@endsection