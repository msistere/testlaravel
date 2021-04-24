@extends('admin.layout.admin')

@section('title')
{{ __('Editar categoría') }} '{{ $category->name }}' | {{ __('Categorías') }}
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Inicio') }}</a></li>
	<li class="breadcrumb-item"><a href="{{ url('admin/categorias') }}">{{ __('Categorías') }}</a></li>
	<li class="breadcrumb-item active">{{ __('Editar categoría') }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="fade-in">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					{!! Form::model($category, ['method' => 'put', 'id' => 'category', 'route' => ['categorias.update', $category->id ], 'accept-charset' => 'utf-8', 'class' => 'needs-validation', 'novalidate']) !!}
					<div class="card-header">
						{{ __('Editar categoría') }}: <b>{{ $category->name }}</b>
					</div>
					<div class="card-body">
						@include('admin.categories.fields')
					</div>
					<div class="card-footer text-right">
        				<a href="{{ url('admin/categorias')}}" class="btn btn-secondary">Cancelar</a>
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
<script type="text/javascript">
(function () {
	  'use strict'

	  // Fetch all the forms we want to apply custom Bootstrap validation styles to
	  var forms = document.querySelectorAll('.needs-validation')

	  // Loop over them and prevent submission
	  Array.prototype.slice.call(forms)
	    .forEach(function (form) {
	      form.addEventListener('submit', function (event) {
	        if (!form.checkValidity()) {
	          event.preventDefault()
	          event.stopPropagation()
	        }

	        form.classList.add('was-validated')
	      }, false)
	    })
	})()
</script>
@endsection