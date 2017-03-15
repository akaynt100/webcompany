@extends('layouts.app')
@section('content')
    @include('partials.alert')
    <div class="main-content">
        <section class="container">
            <h1 class="title text_center">Регистрация</h1>
            <form class="user-form form" action="{{ url('/register') }}" method="POST">
                {{ csrf_field() }}
                <div class="field__wrap">
                    <label class="field__label custom-placeholder-wrap">
                        <input name="email" type="email" class="field" value="{{ old('email') }}" placeholder="" autofocus required>
                        <span class="custom-placeholder">Почта</span>
                    </label>
                </div>
                <div class="field__wrap">
                    <label class="field__label custom-placeholder-wrap">
                        <input name="password" type="password" class="field" placeholder="" required>
                        <span class="custom-placeholder">Пароль</span>
                    </label>
                </div>
                <div class="field__wrap">
                    <label class="field__label custom-placeholder-wrap">
                        <input name="password_confirmation" type="password" class="field" placeholder="" required>
                        <span class="custom-placeholder">Повторите пароль</span>
                    </label>
                </div>
                <div class="field__wrap">
                    <label class="field__label custom-checkbox">
                        <input type="checkbox" value="">
                        <span class="checkbox__replacer">Я принимаю <a href="#" class="link default_link">пользовательское соглашение</a></span>
                    </label>
                </div>

                <center>{!! Recaptcha::render() !!}</center>
                <br>

                <div class="field__wrap">
                    <label class="field__label">
                        <input type="submit" class="submit__btn btn btn-lg btn_green" value="регистрация">
                    </label>
                </div>
            </form>
            <div class="already__registered text_center">
                Уже зарегистрированы? <a href="{{ url('/login') }}" class="link default_link">Авторизуйтесь!</a>
            </div>

        </section>
    </div>
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-8 col-md-offset-2">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Register</div>--}}
                    {{--<div class="panel-body">--}}
                        {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">--}}
                            {{--{{ csrf_field() }}--}}

                            {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                                {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="email" type="email" class="form-control" name="email"--}}
                                           {{--value="{{ old('email') }}" required>--}}

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

                            {{--<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">--}}
                                {{--<label for="password" class="col-md-4 control-label">password_confirmation</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password" type="password" class="form-control"--}}
                                           {{--name="password_confirmation" required>--}}

                                    {{--@if ($errors->has('password_confirmation'))--}}
                                        {{--<span class="help-block">--}}
                                            {{--<strong>{{ $errors->first('password_confirmation') }}</strong>--}}
                                        {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--{!! Recaptcha::render() !!}--}}
                            {{--@if ($errors->has('g-recaptcha-response'))--}}
                                {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('g-recaptcha-response') }}</strong>--}}
                                {{--</span>--}}
                            {{--@endif--}}

                            {{--<div class="form-group">--}}
                                {{--<div class="col-md-6 col-md-offset-4">--}}
                                    {{--<button type="submit" class="btn btn-primary">--}}
                                        {{--Register--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
