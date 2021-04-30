<div class="form-group col-auto {{ $errors->first('dateorder', 'has-error') }}">
	{{ Form::label('dateorder', __('Fecha')), ['class' => 'control-label']  }}
	{{ Form::date('dateorder', (!empty($dateorder))?date('Y-m-d', strtotime($dateorder)):null, ['required', 'class' => 'form-control', 'min' => date('Y-m-d'), 'readonly']) }}
	{!!	$errors->first('dateorder', '<span class="help-block">:message</span>')	!!}
	<div class="invalid-feedback">{{ __('Introduce una fecha válida de pedido.') }}</div>
</div>
<div class="form-group col-auto {{ $errors->first('product_id', 'has-error') }}">
	{{ Form::label('product_id', __('Producto')), ['class' => 'control-label']  }}
	@if($products->count() > 0)
	<select id="product_id" name="product_id"  class="form-control" required>
		<option value="">{{ __('Selecciona') }}</option>
		@foreach($products as $product)
			<option value="{{ $product->id }}">{{ $product->name }}</option>
		@endforeach
	</select>
	{!!	$errors->first('product_id', '<span class="help-block">:message</span>')	!!}
	<div class="invalid-feedback">{{ __('Selecciona un producto.') }}</div>
	@else
	<p>{{ __('No hay productos con tarifas para este día. Selecciona otro día.') }}</p>
	@endif	
</div>
<div class="form-group col-auto {{ $errors->first('price', 'has-error') }}">
	{{ Form::label('price', __('Tarifa (€) / Unidad')), ['class' => 'control-label']  }}
	{{ Form::number('price', null, ['readonly', 'class' => 'form-control', 'min' => '0', 'step' => '0.01']) }}
</div>
<div class="form-group col-auto {{ $errors->first('units', 'has-error') }}">
	{{ Form::label('units', __('Unidades')), ['class' => 'control-label']  }}
	{{ Form::number('units', null, ['required', 'class' => 'form-control', 'min' => '1', 'step' => '1']) }}
	{!!	$errors->first('units', '<span class="help-block">:message</span>')	!!}
	<div class="invalid-feedback">{{ __('Introduce unidades enteras válidas.') }}</div>
</div>

<div class="form-group col-auto {{ $errors->first('total', 'has-error') }}">
	{{ Form::label('total', __('Total (€)')), ['class' => 'control-label']  }}
	{{ Form::number('total', null, ['readonly', 'class' => 'form-control', 'min' => '0', 'step' => '0.01']) }}
</div>

@section('scripts')
<script>
$(document).ready(function() {	
    $('select').select2({
    	allowClear: true,
    	sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
      	placeholder: 'Selecciona',
    		  language: "es"
     });

    @if($products->count() == 0)
        $('#save').prop("disabled",true);
    @endif

    var products = {
    	    'products':[
        @foreach($products as $product)
        {
            	'product_id': {{ $product->id }},
            	'prices': [
                	@foreach($product->prices()->where('from', '<=', $dateorder)->where('to', '>=', $dateorder)->get() as $price)
                	{'price_id': {{ $price->id }},	'price': {{ $price->price }} },
                	@endforeach
            	]
        },
        @endforeach
    ]};

    $('select[name="product_id"]').on('change', function() {
        //($(this).val());
        alert(products['products']);
    });
});
</script>
@endsection