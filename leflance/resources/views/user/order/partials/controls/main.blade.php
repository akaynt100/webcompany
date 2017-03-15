@if (isset($order->status_id))
    @if (!is_null($statusName = $order->status()->name($order->order_status_id)))
        @include('user.order.partials.controls.' . $statusName)
    @endif
@endif