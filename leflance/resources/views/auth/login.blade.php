@extends('layouts.app')

@section('content')
    @include('partials.alert')
    <div class="main-content">
        <section class="container">
            <h1 class="title text_center">Войти</h1>
            <form class="user-form form" action="{{ url('login') }}" method="POST">
                {{ csrf_field() }}
                <div class="field__wrap">
                    <label class="field__label custom-placeholder-wrap">
                        <input name="email" value="{{ old('email') }}" type="email" class="field {{ $errors->has('email') ? 'not-valid-field' : '' }}" placeholder="" required autofocus>
                        <span class="custom-placeholder">Почта</span>
                    </label>
                </div>
                <div class="field__wrap">
                    <label class="field__label custom-placeholder-wrap">
                        <input name="password" type="password" class="field {{ $errors->has('password') ? 'not-valid-field' : '' }}" placeholder="" required>
                        <span class="custom-placeholder">Пароль</span>
                    </label>
                </div>
                <div class="field__wrap">
                    <div class="flex_row">
                        <a href="{{ url('/password/reset') }}" class="link default_link">Забыли пароль?</a>
                        <label class="field__label custom-checkbox">
                            <input type="checkbox" value="" name="remember" {{ old('remember') ? 'checked' : ''}}>
                            <span class="checkbox__replacer">Запомнить</span>
                        </label>
                    </div>
                </div>
                <div class="field__wrap">
                    {!! Recaptcha::render(['data-size' => 'compact']) !!}
                </div>
                <div class="field__wrap">
                    <label class="field__label">
                        <input type="submit" class="submit__btn btn btn-lg btn_green" value="войти">
                    </label>;
                </div>
            </form>
            <div class="already__registered text_center">
                Еще не зарегистрированы? <a href="" class="link default_link">Зарегистрируйтесь!</a>
            </div>

        </section>
    </div>
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Login</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-8 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Login--}}
                                {{--</button>--}}

                                {{--<a class="btn btn-link" href="{{ url('/password/reset') }}">--}}
                                    {{--Forgot Your Password?--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
