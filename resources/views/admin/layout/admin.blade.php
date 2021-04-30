<!DOCTYPE html>
<html lang="es">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/assets/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/assets/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/assets/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/assets/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/assets/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/assets/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/assets/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/assets/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('/assets/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/assets/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/assets/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/assets/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('/assets/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    
    <!-- Icons -->
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet">
    
    <!-- Tree -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Main styles for this application-->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
  </head>
  <body class="c-app">
  	
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
      <div class="c-sidebar-brand d-lg-down-none">
      	<!-- a href="{{ route('dashboard') }}" -->
      		<svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
              <use xlink:href="{{ asset('/assets/brand/coreui.svg') }}#full"></use>
            </svg>
            <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
              <use xlink:href="{{ asset('/assets/brand/coreui.svg') }}#signet"></use>
            </svg>
        <!-- /a -->
      </div>
      <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('admin/categorias') }}">
            <i class="c-sidebar-nav-icon cil-tags"> </i> Categorías</a></li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('admin/productos') }}">
            <i class="c-sidebar-nav-icon cil-3d"> </i> Productos</a></li>        
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('admin/pedidos') }}">
            <i class="c-sidebar-nav-icon cil-cart"> </i> Pedidos</a></li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('admin/logs') }}" target="_blank">
            <i class="c-sidebar-nav-icon cil-bug"> </i> Logs</a></li>
      </ul>
      <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>
    <div class="c-wrapper c-fixed-components">
      <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        	<i class="c-icon c-icon-lg cil-menu"></i>
        </button><a class="c-header-brand d-lg-none" href="#">
          <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
              <use xlink:href="{{ asset('/assets/brand/coreui.svg') }}#full"></use>
            </svg></a>
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
          <i class="c-icon c-icon-lg cil-menu"></i>
        </button>
        <ul class="c-header-nav ml-auto mr-4">          
          <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <div class="c-avatar"><img class="c-avatar-img" src="{{ asset('assets/img/avatar.png') }}" alt="user@email.com"></div>
            </a>            
            <div class="dropdown-menu dropdown-menu-right pt-0">
            	<a class="dropdown-item" href="#">{{ Auth::user()->name }}</a>
            	<div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}">
              	<i class="c-icon cil-account-logout mr-2"> </i> {{ __('Cerrar sesión') }}</a>
            </div>
          </li>
        </ul>
        
        <div class="c-subheader px-3">
          <!-- Breadcrumb-->
          <ol class="breadcrumb border-0 m-0">
            @yield('breadcrumb')
            <!-- Breadcrumb Menu-->
          </ol>
        </div>
      </header>
      <div class="c-body">
        <main class="c-main">
        	@include('notifications') 
        	@yield('content')
        </main>
        <footer class="c-footer">
          <div><a href="https://laravel.com/">Laravel</a> &copy; 2021.</div>
          <div class="ml-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a></div>
        </footer>
      </div>
    </div>
    
    <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    
    <!-- Datatables -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script language="JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>    
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.24/sorting/datetime-moment.js"></script>
    
    <!-- Tree -->    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script type="text/javascript">
    (function () {
    	  'use strict'
    
    	  // Fetch all the forms we want to apply custom Bootstrap validation styles to
    	  var forms = document.querySelectorAll('.needs-validation')
    
    	  // Loop over them and prevent submission
    	  Array.prototype.slice.call(forms)
    	    .forEach(function (form) {
    	      form.addEventListener('submit', function (event) {
    	        if (!form.checkValidity()) {
    	          event.preventDefault()
    	          event.stopPropagation()
    	        }
    
    	        form.classList.add('was-validated')
    	      }, false)
    	    })
    	})()
    </script>
    @yield('scripts')
    
  </body>
</html>
