<input type="hidden" name="product_id" value="{{ $producto->id }}"/>
<div class="form-group col-auto {{ $errors->first('from', 'has-error') }}">
	{{ Form::label('from', __('Desde')), ['class' => 'control-label']  }}
	{{ Form::date('from', (!empty($tarifa))?date('Y-m-d', strtotime($tarifa->from)):null, ['required', 'class' => 'form-control', 'min' => date('Y-m-d'), 'autofocus']) }}
	{!!	$errors->first('from', '<span class="help-block">:message</span>')	!!}
	<div class="invalid-feedback">{{ __('Introduce una fecha válida de inicio de esta tarifa.') }}</div>
</div>
<div class="form-group col-auto {{ $errors->first('to', 'has-error') }}">
	{{ Form::label('to', __('Hasta')), ['class' => 'control-label']  }}
	{{ Form::date('to', (!empty($tarifa))?date('Y-m-d', strtotime($tarifa->to)):null, ['required', 'class' => 'form-control', 'min' => date('Y-m-d')]) }}
	{!!	$errors->first('to', '<span class="help-block">:message</span>')	!!}
	<div class="invalid-feedback">{{ __('Introduce la fecha válida de fin de esta tarifa.') }}</div>
</div>
<div class="form-group col-auto {{ $errors->first('price', 'has-error') }}">
	{{ Form::label('price', __('Tarifa (€)')), ['class' => 'control-label']  }}
	{{ Form::number('price', null, ['required', 'class' => 'form-control', 'step' => '0.01', 'min' => '0.0']) }}
	{!!	$errors->first('price', '<span class="help-block">:message</span>')	!!}
	<div class="invalid-feedback">{{ __('Introduce una tarifa válida.') }}</div>
</div>
