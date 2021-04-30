@extends('admin.layout.admin')

@section('title')
{{ __('Pedidos') }}
@endsection

@section('styles')
<link href="{{ asset('css/fullcalendar/main.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Inicio') }}</a></li>
	<li class="breadcrumb-item active">{{ __('Pedidos') }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="fade-in">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						{{ __('Pedidos') }}
					</div>
					<div class="card-body">
						<p>{{ __('Selecciona la fecha del pedido.') }}</p>
						<div id="orders"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<form id="pedidos" action="{{ route('pedidos.form') }}" method="post">
    @csrf
    <input type="hidden" name="dateorder" id="dateorder">
</form>
@endsection

@section('scripts')
<script src="{{ asset('js/fullcalendar/main.min.js') }}"></script>
<script src="{{ asset('js/fullcalendar/es.js') }}"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('orders');
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
          	initialView: 'dayGridMonth',
          	locale: 'es',
          	dateClick: function(info) {
              	$('#dateorder').val(info.dateStr);
              	$('#pedidos').submit();
          	}
        });
        calendar.render();
      });
</script>
@endsection