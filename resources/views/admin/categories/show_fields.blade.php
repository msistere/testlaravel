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
<script>
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