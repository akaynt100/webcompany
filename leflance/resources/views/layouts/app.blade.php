<!DOCTYPE html>
<html lang="ru">
@include('partials.head')
<body>
<div class="wrapper">
    <div class="wrapper-inner">
        @include('partials.header')
        @yield('content')
    </div>
    @include('partials.footer')
</div>
@include('partials.scripts')
@include('partials.alert')
</body>
</html>