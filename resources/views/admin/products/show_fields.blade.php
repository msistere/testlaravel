<div class="form-row">
	<div class="form-group col-auto">
    	<strong>{!! Form::label('name', __('Nombre')) !!}:</strong> {!! $producto->name !!}
    </div>
    <div class="form-group col-auto">
    	<strong>{!! Form::label('description', __('Descripción')) !!}:</strong> {!! $producto->description !!}
    </div>
</div>
<div class="form-group col-auto">
	<strong>{{ Form::label('image', __('Fotos')) }}</strong>
	<div class="form-row">
    		@php $images = $producto->getMedia('images') @endphp
        	@foreach($images as $media)
            	@php $thumb = $media('thumb') @endphp
            	<div class="col-auto text-center">
            		<a href="{{ $media->getUrl() }}">{{ $thumb }}</a>
            	</div>
        	@endforeach    	
    	</div>
</div>
<div class="form-row">
	<div class="form-group col-auto">
    	<strong>{!! Form::label('categories', __('Categorías')) !!}:</strong>
    	<ul>
    	@foreach($producto->categories as $category)
    		<li>
        		@foreach($category->getAncestors() as $ancestor)
        			<a href="{{ route('categorias.show', $ancestor->id) }}">{{ $ancestor->name }}</a> /
        		@endforeach
        		<a href="{{ route('categorias.show', $category->id) }}">{{ $category->name }}</a>
        	</li>
    	@endforeach
    	</ul>
    </div>	
</div>
<div class="form-row">
	<div class="form-group col-auto">
    	<strong>{!! Form::label('prices', __('Tarifas')) !!}:</strong>
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
@section('scripts')
<div class="modal modal-danger fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="product_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="deleteLabel">{{ __('Eliminar producto') }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <p>{{ __('¿Estás seguro de eliminar este producto? Esta operación es irreversible. Se eliminarán las fotos asociadas.') }}</p>
      <p><b id="product"></b></p>
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
function deleteData(id, name){
	var url = '{{ url(("admin/productos")) }}';
    url = url+"/"+ id;
    $('#product').html(name);
    $("#deleteForm").attr('action', url);
}
$(document).ready(function() {
	$.fn.dataTable.moment( 'DD/MM/YYYY' );
	$('#prices').DataTable({
    	"order": [[0, "desc"]],
    	language: {     
        	url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
		}
    });
});
</script>
@endsection