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