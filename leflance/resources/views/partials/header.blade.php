@if (Auth::check())
    @include('partials.headers.auth.user')
@else
    @include('partials.headers.base')
@endif