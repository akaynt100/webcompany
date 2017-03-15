@if (isset($response))
    @if (!is_null($statusName = $response->status()->name($response->getCurrentStatusId())))
        @include('user.response.partials.statuses.' . $statusName)
    @endif
@endif