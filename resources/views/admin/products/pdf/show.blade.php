@extends('admin.products.pdf.layout')

@section('title')
{{ $product->name }}
@endsection

@section('content')
<ul>
@foreach($product->categories as $category)
	<li>
		@foreach($category->getAncestors() as $ancestor)
			{{ $ancestor->name }} /
		@endforeach
		{{ $category->name }}
	</li>
@endforeach
</ul>

<p>{!! str_replace(PHP_EOL, '<br />', $product->description); !!}</p>

@foreach($product->getMedia('images') as $media)
	<div class="col-auto text-center">
		<img src="{{ $media->getPath() }}" class="img-fluid" />
	</div>
@endforeach

@if($product->prices->count() > 0)	
<h2>{{ __('Tarifas') }}</h2>								
<table class="table-bordered table-striped" width="100%">
    <thead>
		<th>{{ __('Inicio') }}</th>
		<th>{{ __('Fin') }}</th>
		<th>{{ __('Tarifa') }} (€)</th>
	</thead>
	<tbody>
	@foreach($product->prices()->orderBy('from', 'desc')->get() as $price)
		<tr>
			<td>{{ date('d/m/Y', strtotime($price->from)) }}</td>
			<td>{{ date('d/m/Y', strtotime($price->to)) }}</td>
			<td>{{ number_format($price->price, 2, ',', '.') }} &euro;</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endif

@endsection