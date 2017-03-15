@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="container">
            <h1 class="title">Все заказы</h1>
            @include('partials.breadcrumbs')
            <div class="content__wrap clearfix_">
                @include('partials.orders.nav-left')

                <div class="content content-lg">
                    <div class="orders">
                        @if (count($orders))
                            @foreach($orders as $order)
                                <div class="order">
                                    <div class="order-inner">
                                        <a href="{{ route('order.show', [Request::route('user_id'), $order->id]) }}"
                                           target="_blank" class="order-title order__inner-el">{!! $order->theme !!}</a>
                                        <div class="order-theme order__inner-el">{{ $order->type->name }}</div>
                                        <p class="order-description order__inner-el">
                                            {!! $order->description !!}
                                        </p>
                                        <div class="order-info order__inner-el">
                                            <div class="flex_row">
                                                @include('user.order.partials.statuses.main')
                                                <div class="order__deadline">До <span
                                                            class="medium_bold">{{ \DateTimeHelper::parseDate($order->deadline) }}</span>
                                                </div>
                                                <div class="order__responses">
                                                    <a href="" class="link default_link">
                                                        {{ $order->responses->count() }} откликов
                                                    </a>
                                                </div>
                                                <div class="order__date">{{ \DateTimeHelper::parseDate($order->created_at) }}</div>
                                            </div>
                                        </div>
                                        <div class="order-actions">
                                            <div class="action-btns-container">
                                                <div class="clearfix_">
                                                    @can('response-to-order.create', $order->id)
                                                        <a href="{{ route('response-to-order.create', [Request::route('user_id'), $order->id]) }}"
                                                           target="_blank"
                                                           class="btn action-btn response-action-btn">
                                                            Откликнуться
                                                        </a>
                                                    @endcan
                                                    @can('order.delete', $order->id)
                                                        <a href="{{ route('order.do-delete', [Request::route('user_id'), $order->id]) }}"
                                                           class="btn action-btn delete-action-btn confirm">
                                                        </a>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @include('partials.empty')
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
