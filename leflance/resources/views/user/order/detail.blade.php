@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="container">
            <div class="clearfix_">
                <h1 class="title fl_l">Заказ №{{ $order->id }}</h1>
                <div class="order-detail-actions fl_r">
                    <div class="flex_row flex_start">
                        @can('order.update', $order->id)
                            <a href="{{ route('order.update', [Request::route('user_id'), $order->id]) }}"
                               class="btn btn-md btn-md-w btn_green">редактировать</a>
                        @else
                            <a href=""
                               class="btn btn-md btn-md-w btn_green btn_disable">редактировать</a>
                        @endcan
                        @can('order.delete', $order->id)
                            <div class="order-detail-delete-btn flex_row flex_start">
                                <a href="{{ route('order.do-delete', [Request::route('user_id'), $order->id]) }}"
                                   class="order-detail-delete__btn confirm">Удалить заказ</a>
                                <div class="close-btn"></div>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
            @include('partials.breadcrumbs')
            <div class="content__wrap clearfix_">
                @include('partials.user')
                <div class="content">
                    <div class="order-detail-block">
                        <div class="column__title">Статус заказа</div>
                        <div class="order-progressbar-container">
                            <div class="progressbar-wrap" data-progress-status="57">
                                <div class="progress-points flex_row">
                                    <div class="progress-point progress-point-active-awaiting progress-point-active">
                                        1
                                    </div>
                                    <div class="progress-point progress-point-active-in-work">2</div>
                                    <div class="progress-point progress-point-active-completed">3</div>
                                </div>
                                <div class="progressbar progressbar-el"></div>
                                <div class="progressbar-overlay progressbar-el"></div>
                            </div>
                        </div>
                    </div>
                    <div class="order-detail-block clearfix_">
                        <div class="column__title">Описание</div>
                        <div class="order-detail-data form-column-1-2 fl_l">
                            <div class="order-main-data">
                                <div class="order__el order-title">
                                    {!! $order->theme !!}
                                </div>
                                <div class="order__el order-theme">
                                    {{ $order->type->name }}
                                </div>
                                <div class="order__el order-description">
                                    {!! $order->description !!}
                                </div>
                            </div>
                        </div>
                        <div class="order-additional-info form-column-1-2 fl_r">
                            <div class="order__el clearfix_">
                                <div class="form-column-1-2 fl_l">Сдать до:</div>
                                <div class="form-column-1-2 align_r medium_bold blue_text">{{ \DateTimeHelper::parseDate($order->deadline) }}</div>
                            </div>
                            <div class="order__el clearfix_">
                                <div class="form-column-1-2 fl_l">Количество страниц:</div>
                                <div class="form-column-1-2 align_r medium_bold">от {{ $order->pages_from }}
                                    до {{ $order->pages_to }}
                                </div>
                            </div>
                            <div class="order__el clearfix_">
                                <div class="form-column-1-2 fl_l">Город:</div>
                                <div class="form-column-1-2 align_r medium_bold">{{ $order->educational->city->name }}</div>
                            </div>

                            <div class="order__el clearfix_">
                                <div class="form-column-1-2 fl_l">ВУЗ:</div>
                                <div class="form-column-1-2 align_r medium_bold">{{ $order->educational->name }}</div>
                            </div>
                            <div class="order__el clearfix_">
                                <div class="form-column-1-2 fl_l">Факультет:</div>
                                <div class="form-column-1-2 align_r medium_bold">
                                    {{ $order->faculty->name }}
                                </div>
                            </div>

                            <div class="order__el order-files">
                                <div class="medium_bold">Файлы:</div>

                                @if(count($order->file) > 0)
                                    <div>
                                        @foreach($order->file as $file)
                                            <span class="custom-input-file__text">
                                                <span class="custom-input-file__item">
                                                    <a href="{{ route('orders.file.get', [Request::route('user_id'), Request::route('order_id'), $file->id]) }}"
                                                       class="link default_link custom-input-file__item-name">
                                                        {!! $file->original_name !!}
                                                    </a>
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
                    <div>
                        <div class="column__title">Отклики исполнителей</div>
                        <div class="responses">

                            @foreach($order->responses as $response)
                                <div class="response">
                                    <div class="response-inner">
                                        <div class="response__top">
                                            <div class="flex_row">
                                                <div>
                                                    <div class="flex_row">
                                                        <a href="" class="response-user__image">
                                                            <img src="{{ asset('assets/images/responce-user-img.png') }}"
                                                                 alt="">
                                                        </a>
                                                        <div>
                                                            <div class="response-user__wrap flex_row">
                                                                <a href=""
                                                                   class="response-user__name">{{ $response->user->full_name }}</a>
                                                                {{--<span class="response-status response-status-best">Лучший отклик</span>--}}
                                                                {{--<span class="response-status response-status-selected">Выбран исполнителем</span>--}}
                                                            </div>
                                                            <div class="response-user__deadline">
                                                                Выполню до:
                                                                <span class="blue_text">{{ DateTimeHelper::parseDate($response->deadline) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="flex_row flex_start">
                                                        <div class="response__datetime">{{ DateTimeHelper::parseDate($response->created_at, 'j F Y, H:i') }}</div>
                                                        <div class="response-close-btn close-btn confirm"
                                                             data-uk-tooltip
                                                             title="Не показывать">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="response__middle">
                                            <p class="response-text">
                                                {!! $response->comment !!}
                                            </p>
                                        </div>
                                        <div class="response__bottom">
                                            <div class="clearfix_">
                                                <div class="fl_r">
                                                    <div class="flex_row flex_start">
                                                        @if ($response->status()->work())
                                                            <a href="#"
                                                               class="close-deal__btn link gray_link link_dotted confirm">
                                                                Закрыть сделку
                                                            </a>
                                                        @endif
                                                        <button type="button"
                                                                class="response-btn btn btn_green confirm">
                                                            Выбрать исполнителем
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection