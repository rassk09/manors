@extends('layouts.login')

@section('content')
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    Усадебное достояние
                    <small>Административная часть</small>
                </div>
                <div class="icon">
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <!-- end brand -->
            <!-- begin login-content -->
            <div class="login-content">
                {!! Form::open(['class' => 'margin-bottom-0', 'method' => 'post', 'route' => ['login'], 'files' => true]) !!}
                    <div class="form-group m-b-20">
                        <input id="email" type="email" class="form-control form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail адрес" required autofocus>
                    </div>
                    <div class="form-group m-b-20">
                        <input id="password" type="password" class="form-control form-control-lg{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Пароль">
                    </div>
                    <div class="checkbox checkbox-css m-b-20">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember_checkbox" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember_checkbox">
                            Запомнить меня
                        </label>
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Войти</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <!-- end login-content -->
        </div>
        <!-- end login -->
    </div>
@endsection
