@extends('admin.layout.auth')

@section('content')
<div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">
              	<form action="{{ route('login') }}" method="post" id="login_form" class="needs-validation" novalidate>
              	<!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <h1>{{ __('Administración') }}</h1>
                <p class="text-muted">{{ __('Accede a tu cuenta') }}</p>
                <div class="input-group mb-3 {{ $errors->first('email', 'has-error') }}">
                  <div class="input-group-prepend">
                  	<span class="input-group-text"><i class="icon cil-user"></i></span></div>
                  <input class="form-control" id="email" name="email" type="email" placeholder="{{ __('Correo electrónico') }}" value="{!! old('email') !!}" required autofocus="autofocus">
                  <div class="invalid-feedback">{{ __('Introduce un correo electrónico válido.') }}</div>
                  <div class="col-sm-12">{!! $errors->first('email', '<span class="help-block">:message</span>') !!}</div>
                </div>
                <div class="input-group mb-4 {{ $errors->first('password', 'has-error') }}">
                  <div class="input-group-prepend"><span class="input-group-text">
                  <i class="icon cil-lock-locked"></i></span></div>
                  <input class="form-control"  id="password" name="password" type="password" placeholder="{{ __('Contraseña') }}" required>
                  <div class="invalid-feedback">{{ __('Introduce una contraseña válida.') }}</div>
                  <div class="col-sm-12">{!! $errors->first('password', '<span class="help-block">:message</span>') !!}</div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">{{ __('Acceder') }}</button>
                  </div>
                </div>
              </div>
              </form>
            </div>            
          </div>
        </div>
@endsection