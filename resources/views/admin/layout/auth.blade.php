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
    
    <!-- Icons -->
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet">
    
    <!-- Main styles for this application-->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
  </head>
  <body class="c-app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        	@yield('content')
      </div>
    </div>
    
    <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    
    
    
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
