<div class="form-row">
	<div class="form-group col-auto">
    	<strong>{!! Form::label('id', __('ID')) !!}:</strong> {!! $pedido->id !!}
    </div>
    <div class="form-group col-auto">
    	<strong>{!! Form::label('dateorder', __('Fecha')) !!}:</strong> {!! date('d/m/Y', strtotime($pedido->dateorder)) !!}
    </div>
</div>
@foreach($pedido->orderlines as $line)
<div class="form-row">
	<div class="form-group col-auto">
    	<strong>{!! Form::label('product_id', __('Producto')) !!}:</strong> <a href="{{ route('productos.show', $line->product_id) }}">{!! $line->product->name !!}</a>
    </div>
    <div class="form-group col-auto">
    	<strong>{!! Form::label('tarifa', __('Tarifa (€) / Unidad')) !!}:</strong>
    	@php
    		$price = $line->product->prices()
    					->where('from', '<=', date('Y-m-d', strtotime($pedido->dateorder)))
    					->where('to', '>=', date('Y-m-d', strtotime($pedido->dateorder)))
    					->first()->price;
    	@endphp 
    	{!!  number_format($price, 2, ',', '.'); !!}
    </div>
    <div class="form-group col-auto">
    	@php $units = $line->units; @endphp
    	<strong>{!! Form::label('units', __('Unidades')) !!}:</strong> {!! $units !!}</a>
    </div>
</div>
<div class="form-row">
	<div class="form-group col-auto">
    	<strong>{!! Form::label('total', __('Total')) !!}:</strong> {!! number_format($price*$units, 2, ',', '.') !!} €
    </div>
</div>
@endforeach

@section('scripts')
<div class="modal modal-danger fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="order_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="deleteLabel">{{ __('Eliminar pedido') }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <p>{{ __('¿Estás seguro de eliminar esta pedido? Esta operación es irreversible.') }}</p>
      </div>
      <div class="modal-footer">
      	<form id="deleteForm" method="post">
      	{{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancelar') }}</button>
        <button type="submit" class="btn btn-danger pull-right delete-confirm text-white">{{ __('Sí, elimínalo') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
function deleteData(id){
	var url = '{{ url(("admin/pedidos")) }}';
    url = url+"/"+ id;
    $("#deleteForm").attr('action', url);
}

</script>
@endsection