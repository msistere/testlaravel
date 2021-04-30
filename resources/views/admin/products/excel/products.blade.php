<!doctype html>
<html>
<head>
	<title>
	{{ __('Productos') }} | {{ config('app.name') }}
	</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>{{ __('Productos') }}</h1>
	<table width="100%">
		<thead>
			<tr>
    			<th>{{ __('ID Producto') }}</th>
    			<th>{{ __('Nombre') }}</th>
    			<th>{{ __('Descripción') }}</th>
    			<th>{{ __('Categorías') }}</th>                
                <th>{{ __('Tarifas') }}</th>
			</tr>
		</thead>
		<tbody>
		@foreach($products as $product)
		<tr>
			<td>{{ $product->id }}</td>
			<td>{{ $product->name }}</td>
			<td>{{ $product->description }}</td>
			<td colspan="2">
				<table>
					<thead>
						<tr>
							<th>{{ __('ID Categoría') }}</th>
                			<th>{{ __('Categoría') }}</th>
						</tr>
					</thead>
                	<tbody>
                		@foreach($product->categories as $category)
                		<tr>
                			<td>{{ $category->id }}</td>
                			<td>
                				@foreach($category->getAncestors() as $ancestor)
                				{{ $ancestor->name }} /
        						@endforeach
        						{{ $category->name }}
        					</td>
                		</tr>
                		@endforeach
                	</tbody>
                </table>
               </td>
               <td colspan="3">
               	<table>
    					<thead>
    						<tr>
    							<th>{{ __('Desde') }}</th>
                				<th>{{ __('Hasta') }}</th>
                				<th>{{ __('Tarifa') }}</th>
    						</tr>
    					</thead>
                	<tbody>
                       	@foreach($product->prices as $price)
                       		<tr>
                       			<td>{{ date('d/m/Y', strtotime($price->from)) }}</td>
    							<td>{{ date('d/m/Y', strtotime($price->to)) }}</td>
    							<td>{{ $price->price }}</td>
                       		</tr>
                       	@endforeach
                    </tbody>
                 </table>
               </td>
              </tr>
         @endforeach
		</tbody>
	</table>
</body>
</html>