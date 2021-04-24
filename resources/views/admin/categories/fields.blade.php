<div class="form-group col-auto {{ $errors->first('parent_id', 'has-error') }}">
	{{ Form::label('parent_id', __('Categoría superior')), ['class' => 'control-label']  }}	
	<select name="parent_id" id="parent_id" class="form-control {{ ($errors->has('grua_id') ? 'is-invalid' : '') }}"  autofocus>
		<option value="">{{ __('Ninguna') }}</option>
		@foreach($categories as $categoria)
		<option value="{{ $categoria->id }}" {{ (((!empty($category)) && ($category->parent_id == $categoria->id)) || (old('parent_id') == $categoria->id))?'selected':'' }}>
		@for($i=0;$i<$categoria->ancestors()->count();$i++)-@endfor		
		{{ $categoria->name }}
		</option>
		@endforeach
	</select>
	{!!	$errors->first('parent_id', '<span class="help-block">:message</span>')	!!}
</div>
<div class="form-group col-auto {{ $errors->first('name', 'has-error') }}">
	{{ Form::label('name', __('Nombre')), ['class' => 'control-label']  }}
	{{ Form::text('name', null, ['required', 'class' => 'form-control' ]) }}
	{!!	$errors->first('name', '<span class="help-block">:message</span>')	!!}
	<div class="invalid-feedback">{{ __('Introduce un nombre.') }}</div>
</div>
<div class="form-group col-auto {{ $errors->first('description', 'has-error') }}">
	{{ Form::label('description', __('Descripción')), ['class' => 'control-label']  }}
	{{ Form::textarea('description', null, ['class' => 'form-control' ]) }}
	{!!	$errors->first('description', '<span class="help-block">:message</span>')	!!}
</div>