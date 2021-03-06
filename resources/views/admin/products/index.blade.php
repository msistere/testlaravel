@extends('admin.layout.admin')

@section('title')
{{ __('Productos') }}
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Inicio') }}</a></li>
	<li class="breadcrumb-item active">{{ __('Productos') }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="fade-in">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						Productos
						<div class="card-header-actions">
							<a class="btn btn-primary" href="{{ route('productos.create') }}">{{__('Añadir producto') }}</a>
							<a class="btn btn-primary" href="{{ route('products.excel') }}">{{__('MS Excel') }}</a>
						</div>
					</div>
					<div class="card-body">
						<table id="products">
							<thead>
								<th>ID</th>
								<th>{{ __('Nombre') }}</th>
								<th>{{ __('Foto') }}</th>
								<th>{{ __('Acciones') }}</th>
							</thead>
							<tbody>
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
$(document).ready( function () {
	
    $('#products').DataTable({
    	processing: true,
    	serverSide: true,
    	deferRender: true,
    	"order": [[1, "asc"]],
    	ajax: {
        	url: "{!! route('products.data') !!}",
        },
        columns: [
        	{ data: 'id', name: 'id'},
            { data: 'name', name: 'name'},
            { data: 'image', name: 'image', searchable: false, orderable: false},
            { data: 'actions', name: 'actions', searchable: false, orderable: false }
        ],
    	language: {     
        	url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
		}
    });
} );
</script>
@endsection