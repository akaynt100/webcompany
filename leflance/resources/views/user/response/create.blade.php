@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="container">
            @include('partials.alert')
            <h1 class="title">Новый отклик</h1>

            @include('partials.breadcrumbs')

            <div class="content__wrap clearfix_">
                @include('partials.user')
                <div class="content">
                    <form action="{{ route('response-to-order.do-create', [Request::route('user_id'), Request::route('order_id')]) }}"
                          method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="client_deadline" value="{!! $order->deadline !!}">
                        <div class="clearfix_">
                            <div class="form-column-sm fl_l">
                                <div class="column__title">Форма добавления отклика</div>
                                <div class="field__wrap">
                                    <label class="field__label custom-placeholder-wrap">
                                        <span class="block">
                                            <input type="text" name="city" class="field" value="{{ old('city') }}"
                                                   placeholder="">
                                        </span>
                                        <span class="custom-placeholder">Ваш город</span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label custom-placeholder-wrap">
                                        <span class="block">
                                            <input type="text" name="deadline" value="{{ old('deadline') }}"
                                                   class="field " placeholder="">
                                        </span>
                                        <span class="custom-placeholder">Выполню заказ до</span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label custom-placeholder-wrap">
                                    <span class="block">
                                        <textarea class="field custom-textarea" name="comment"
                                                  placeholder="">{{ old('comment') }}</textarea>
                                    </span>
                                        <span class="custom-placeholder">Комментарий к отклику</span>
                                    </label>
                                </div>
                                <div class="captcha field__wrap">
                                    {!! Recaptcha::render() !!}
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label">
                                        <input type="submit" class="submit__btn btn btn-lg btn_green"
                                               value="Добавить отклик">
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <div class="react-select"></div>
                                </div>
                            </div>
                            <div class="form-column-md fl_r">
                                <div class="column__title">Основная информация заказа</div>
                                <div class="order-main-data">
                                    <div class="order__el order-title">
                                        {!! $order->theme !!}
                                    </div>
                                    <div class="order__el order-theme">
                                        {!! $order->type->name !!}
                                    </div>
                                    <div class="order__el order-description">
                                        {!! $order->description !!}
                                    </div>
                                    <div class="order__el">
                                        <div class="medium_bold">Сдать до:</div>
                                        <div class="uk-text-danger">{{ DateTimeHelper::parseDate($order->deadline) }}</div>
                                    </div>
                                    <div class="order__el order-files">
                                        <div class="medium_bold">Файлы:</div>

                                        @if(count($order->file) > 0)
                                            <div>
                                                @foreach($order->file as $file)
                                                    <span class="custom-input-file__text">
                                                        <span class="custom-input-file__item">
                                                            <a href="{{ route('orders.file.get', [Request::route('user_id'), Request::route('order_id'), $file->id]) }}"
                                                               class="link default_link custom-input-file__item-name">{!! $file->original_name !!}</a>
                                                            <span></span>
                                                        </span>
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="uk-text-muted uk-margin-small-top">Отсутствуют</div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

