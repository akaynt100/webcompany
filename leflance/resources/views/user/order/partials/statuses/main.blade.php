@if (isset($order))
    @if (!is_null($statusName = $order->status()->name($order->getCurrentStatusId())))
        @include('user.order.partials.statuses.' . $statusName)
    @endif
@endif