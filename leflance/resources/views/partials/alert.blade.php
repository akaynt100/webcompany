{{--<div class="uk-alert uk-alert-success" data-uk-alert="">--}}
{{--<a href="" class="uk-alert-close uk-close custom-uk-alert"></a>--}}
{{--<p class="uk-margin-left">Операция прошла успешно</p>--}}
{{--</div>--}}

{{--@if (session('status'))--}}
{{--<div class="alert alert-success">--}}
{{--{{ session('status') }}--}}
{{--</div>--}}
{{--@endif--}}

@if (count($errors->all()) > 0)
    {{ dump($errors->all()) }}
@endif

@if(session('message.success'))
    <script>
        var message = "{!! session('message.success') !!}";
        UIkit.notify(message, {status: 'success', pos: 'top-right'})
    </script>
@endif