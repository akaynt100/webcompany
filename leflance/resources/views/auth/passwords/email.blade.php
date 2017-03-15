@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="container">

            @include('partials.alert')
            <h1 class="title text_center">Восстановление пароля</h1>
            <form class="user-form form" action="{{ url('/password/email') }}" method="POST">
                {{ csrf_field() }}
                <div class="field__wrap">
                    <p class="common-text">
                        Введите ваш адрес почты, который вы указали
                        при регистрации. Вам будет выслано письмо
                        с инструкциями по восстановлению.
                    </p>
                </div>
                <div class="field__wrap">
                    <label class="field__label custom-placeholder-wrap">
                        <input type="email" name="email" class="field" placeholder="" value="{{ old('email') }}"
                               required>
                        <span class="custom-placeholder">Почта</span>
                    </label>
                </div>
                <div class="field__wrap">
                    {!! Recaptcha::render() !!}
                </div>
                <div class="field__wrap">
                    <label class="field__label">
                        <input type="submit" class="submit__btn btn btn-lg btn_green" value="восстановить пароль">
                    </label>
                </div>
            </form>
        </section>
    </div>
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-8 col-md-offset-2">--}}
    {{--<div class="panel panel-default">--}}
    {{--<div class="panel-heading">Reset Password</div>--}}
    {{--<div class="panel-body">--}}
    {{--@if (session('status'))--}}
    {{--<div class="alert alert-success">--}}
    {{--{{ session('status') }}--}}
    {{--</div>--}}
    {{--@endif--}}

    {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">--}}
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

    {{--<div class="form-group">--}}
    {{--<div class="col-md-6 col-md-offset-4">--}}
    {{--<button type="submit" class="btn btn-primary">--}}
    {{--Send Password Reset Link--}}
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
