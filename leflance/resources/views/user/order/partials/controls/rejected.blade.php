@can('order.delete', $order->id)
    <a href="{{ route('order.do-delete', [Request::route('user_id'), $order->id]) }}"
       class="btn action-btn delete-action-btn confirm">
    </a>
@endcan