@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="container">
            <h1 class="title">Настройки профиля</h1>
            @include('partials.breadcrumbs')
            <div class="content__wrap clearfix_">
                @include('partials.orders.nav-left')
                <div class="content">
                    <form action="{{ route('settings.subscribe.do-update', Request::route('user_id')) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="subscribe-settings clearfix_">
                            <div class="form-column-sm fl_l">
                                <div class="column__title">Интересует</div>
                                <div class="field__wrap">
                                    <label class="field__label">
                                    <span class="block">
                                        <select class="field custom-select" name="create_order_with_type">
                                            <option value="0" selected disabled>Тип работы</option>
                                            <option value="Реферат">Реферат</option>
                                            <option value="Курсовая работа">Курсовая работа</option>
                                        </select>
                                    </span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label">
                                    <span class="block">
                                        <select class="field custom-select" name="create_order_with_city">
                                            <option value="0" selected disabled>Город</option>
                                            <option value="Минск">Минск</option>
                                            <option value="Брест">Брест</option>
                                        </select>
                                    </span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label">
                                    <span class="block">
                                        <select class="field custom-select" name="create_order_with_institution">
                                            <option value="0" selected disabled>Высшее учебное заведение</option>
                                            <option value="БГУИР">БГУИР</option>
                                            <option value="БГУ">БГУ</option>
                                        </select>
                                    </span>
                                    </label>
                                </div>
                            </div>
                            <div class="subscribe-checkbox__wrap form-column-md fl_r">
                                <div class="field__wrap">
                                    <label class="field__label custom-checkbox">
                                        <input type="checkbox" name="create_order">
                                        <span class="checkbox__replacer">Любой новый заказ</span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label custom-checkbox">
                                        <input type="checkbox" name="took_response">
                                        <span class="checkbox__replacer">Оповещать в случае одобрения на отклик</span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label custom-checkbox">
                                        <input type="checkbox" name="create_response">
                                        <span class="flex_row flex_start align_start">
                                            <span class="checkbox__replacer"></span>
                                            <span class="checkbox__replacer-inner-title">
                                                Оповещать в случае отклика
                                                <br>
                                                <span class="xs_text">(в случае, когда на любое ваше задание откликнется исполнитель)</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <div class="field__wrap">
                                    <label class="field__label custom-checkbox">
                                        <input type="checkbox" name="reject_response">
                                        <span class="flex_row flex_start align_start">
                                            <span class="checkbox__replacer"></span>
                                            <span class="checkbox__replacer-inner-title">
                                                Оповещать в случае отказа на отклик
                                                <br>
                                                <span class="xs_text">(в случае, когда любой ваш отклик получит подтверждение заказчика)</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="column__title">Связаться через:</div>
                            <div class="field__wrap flex_row flex_start">
                                <label class="field__label custom-checkbox">
                                    <input type="checkbox" value="">
                                    <span class="checkbox__replacer">Электронная почта</span>
                                </label>
                                <label class="field__label custom-placeholder-wrap field__label-sm">
                                    <span class="block">
                                    <input type="email" name="notify_via[email]"
                                           value="{{ Auth::user()->getAttribute('email') }}"
                                           class="field" placeholder="">
                                    </span>
                                    <span class="custom-placeholder">Ваш email</span>
                                </label>
                            </div>
                            <div class="field__wrap">
                                <input type="submit" class="submit__btn btn btn-md btn_green" value="Обновить подписку">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
