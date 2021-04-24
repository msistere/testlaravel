@extends('admin.layout.admin')

@section('title')
{{ __('Categorías') }}
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Inicio') }}</a></li>
	<li class="breadcrumb-item active">{{ __('Categorías') }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="fade-in">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						{{ __('Categorías') }}
						<div class="card-header-actions">
							<a class="btn btn-primary" href="{{ route('categorias.create') }}" title="{{ __('Añadir categoría') }}">
								{{ __('Añadir categoría') }}
							</a>
						</div>
					</div>
					<div class="card-body">
						<table id="categories">
							<thead>
								<th>ID</th>
								<th>{{ __('Nombre') }}</th>
								<th>{{ __('Acciones') }}</th>
							</thead>
							<tbody>
								@if(!empty($categories))
    								@foreach($categories as $category)
    									<tr>
    										<td>{{ $category->id }}</td>
    										<td>
    											@foreach($category->getAncestors() as $ancestor)
    												<a href="{{ route('categorias.show', $ancestor->id) }}">{{ $ancestor->name }}</a> /
    											@endforeach
    											<a href="{{ route('categorias.show', $category->id) }}">{{ $category->name }}</a>
    										</td>
    										<td>
    											<a class="btn btn-primary" href="{{ route('categorias.show', $category->id) }}">{{ __('Ver') }}</a>
    											<a class="btn btn-primary" href="{{ route('categorias.edit', $category->id) }}">{{ __('Edita') }}</a>
    											<a class="btn btn-danger" href="javascript:;" onclick="deleteData('{{ $category->id }}', '{{ $category->name }} ')" data-id="{{ $category->id }}" data-toggle="modal" data-target="#delete_confirm">
    												{{ __('Eliminar') }}
    											</a>
    										</td>
    									</tr>
    								@endforeach
    							@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

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
$(document).ready( function () {
    $('#categories').DataTable({
    	"order": [[0, "asc"]],
    	"columnDefs": [
    	    { "orderable": false, searchable: false, "targets": 2 }
    	  ],
    	language: {     
        	url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
		}
    });
} );
</script>
@endsection