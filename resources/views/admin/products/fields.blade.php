<div class="form-group col-auto {{ $errors->first('name', 'has-error') }}">
	{{ Form::label('name', __('Nombre')), ['class' => 'control-label']  }}
	{{ Form::text('name', null, ['required', 'class' => 'form-control', 'max' => '255', 'autofocus']) }}
	{!!	$errors->first('name', '<span class="help-block">:message</span>')	!!}
	<div class="invalid-feedback">{{ __('Introduce un nombre.') }}</div>
</div>
<div class="form-group col-auto {{ $errors->first('description', 'has-error') }}">
	{{ Form::label('description', __('Descripción')), ['class' => 'control-label', 'required']  }}
	{{ Form::textarea('description', null, ['class' => 'form-control' ]) }}
	{!!	$errors->first('description', '<span class="help-block">:message</span>')	!!}
</div>

<div class="form-group col-auto {{ $errors->first('image', 'has-error') }}">
	{{ Form::label('image', __('Fotos')), ['class' => 'control-label']  }}
	@if(!empty($producto))
    	<div class="form-row">
    		@php $images = $producto->getMedia('images') @endphp
        	@foreach($images as $media)
            	@php $thumb = $media('thumb') @endphp
            	<div class="col-auto text-center">
            		<a href="{{ $media->getUrl() }}">{{ $thumb }}</a><br>
            		<a class="btn btn-danger text-white mt-1" href="javascript:;" onclick="deleteData({{ $media->id }}, '{{ $media->getUrl() }}')" data-id="{{ $media->id }}" data-toggle="modal" data-target="#delete_confirm"  style="text-decoration: none">
            			{{ __('Eliminar') }}
            		</a>
            	</div>
        	@endforeach    	
    	</div>
    	@if($images->count() > 0)
    	<p>{{ __('Selecciona nuevas imágenes, o elimina las existentes.') }}</p>
    	@endif
    @endif
	{{ Form::file('image', ['name' => 'image[]', 'class' => 'control-label filestyle', 'accept' => 'image/*;capture=camera', 'multiple', 'data-text' => 'Selecciona fotos']) }}
	{!!	$errors->first('image', '<span class="help-block">:message</span>')	!!}
</div>
<div class="form-group col-auto {{ $errors->first('categories', 'has-error') }}">
	@foreach($categories as $category)
	{!! Form::hidden('category_id[]', '', ['id' => 'category_id_'.$category->id]) !!} 
	@endforeach
	{{ Form::label('categories', __('Categorías')), ['class' => 'control-label']  }}
	<div id="categories"></div>
	{!!	$errors->first('categories', '<span class="help-block">:message</span>')	!!}
</div>
@section('scripts')
<div class="modal modal-danger fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="image_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="deleteLabel">Eliminar foto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <p>{{ __('¿Estás seguro de eliminar esta foto? Esta operación es irreversible.') }}</p>
      <div id="photo" class="text-center"></div> 
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

function deleteData(id, image){
	var url = '{{ url("admin/media") }}';
    url = url+"/"+ id;
    $('#photo').html('<image src="'+image+'"  style="max-height: 100px" />');
    $("#deleteForm").attr('action', url);
}

$(document).ready(function() {
	var $treeview = $('#categories');

	@if(!empty(old('category_id')))
    	@foreach(old('category_id') as $category_id)
    		@if(!empty($category_id))
    		$('#category_id_{{ $category_id }}').val('{{ $category_id }}');  
			@endif    
    	@endforeach
    @endif
    	
	$treeview.jstree({ 'core' : {			
        'data' : [
        	@foreach($categories as $category)
        		{ 
        			"id" : "{{ $category->id }}", 
        			"parent" : "{{ (!empty($category->parent_id))?$category->parent_id:'#' }}", 
        			"text" : "{{ $category->name }}" 
            		{!! ((!empty($producto)) && ($category->id == $producto->categories->contains('id', $category->id)))?', "state":{ checked : true }':'' !!} 
        		},
        	@endforeach           
        ],
        multiple : false
	},
	"checkbox" : {
          "keep_selected_style" : false,
          tie_selection : false,
          whole_node : false,
        },
        "plugins" : [ "checkbox" ]
     }).on('ready.jstree', function() {
    	$treeview.jstree('open_all');
  	}).on("check_node.jstree",
        function (e, data) {
			$('#category_id_'+data.node.id).val(data.node.id);  
  		
    });

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