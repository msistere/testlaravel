<div class="form-row">
	<div class="form-group col-auto">
    	<strong>{!! Form::label('ancestors', __('Categorías superiores')) !!}:</strong> 
    	<div id="ancestors"></div>
    </div>
</div>
<div class="form-row">
	<div class="form-group col-auto">
    	<strong>{!! Form::label('name', __('Nombre')) !!}:</strong> {!! $category->name !!}
    </div>
    <div class="form-group col-auto">
    	<strong>{!! Form::label('description', __('Descripción')) !!}:</strong> {!! $category->description !!}
    </div>
</div>
<div class="form-row">
	<div class="form-group col-auto">
    	<strong>{!! Form::label('descendants', __('Categorías descedientes')) !!}:</strong>
    	<div id="descendants"></div>
    </div>
</div>

@section('scripts')
<div class="modal modal-danger fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="category_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="deleteLabel">{{ __('Eliminar categoría') }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <p>{{ __('¿Estás seguro de eliminar esta categoría? Esta operación es irreversible, y eliminará sus categorías inferiores. Así como su relación con los productos.') }}</p>
      <p><b id="category"></b></p>
      </div>
      <div class="modal-footer">
      	<form id="deleteForm" method="post">
      	{{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancelar') }}</button>
        <button type="submit" class="btn btn-danger pull-right delete-confirm text-white">{{ __('Sí, elimínala') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
function deleteData(id, name){
	var url = '{{ url(("admin/categorias")) }}';
    url = url+"/"+ id;
    $('#category').html(name);
    $("#deleteForm").attr('action', url);
}

$(document).ready(function() {
	var $ancestors = $('#ancestors');
	$ancestors.jstree({ 'core' : {			
        'data' : [
        	@foreach($category->ancestors as $ancestor)
        		{ 
        			"id" : "{{ $ancestor->id }}", 
        			"parent" : "{{ (!empty($ancestor->parent_id))?$ancestor->parent_id:'#' }}", 
        			"text" : "{{ $ancestor->name }}" 
        		},
        	@endforeach           
        ],
        multiple : false
		}
     }).on('ready.jstree', function() {
    	 $ancestors.jstree('open_all');
  	});
    
	var $descendants = $('#descendants');
	$descendants.jstree({ 'core' : {			
        'data' : [
        	@foreach($category->descendants as $descendant)
        		{ 
        			"id" : "{{ $descendant->id }}", 
        			"parent" : "{{ ((!empty($descendant->parent_id)) && ($descendant->parent_id != $category->id))?$descendant->parent_id:'#' }}", 
        			"text" : "{{ $descendant->name }}" 
        		},
        	@endforeach           
        ]
		}
    }).on('ready.jstree', function() {
   	 $descendants.jstree('open_all');
 	});
});
</script>
@endsection