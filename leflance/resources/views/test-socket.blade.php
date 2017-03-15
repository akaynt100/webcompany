@extends('layouts.app')

@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font: 13px Helvetica, Arial;
        }

        form {
            background: #000;
            padding: 3px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        form input {
            border: 0;
            padding: 10px;
            width: 90%;
            margin-right: .5%;
        }

        form button {
            width: 9%;
            background: rgb(130, 224, 255);
            border: none;
            padding: 10px;
        }

        #messages {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #messages li {
            padding: 5px 10px;
        }

        #messages li:nth-child(odd) {
            background: #eee;
        }
    </style>

    <ul id="messages"></ul>
    <form action="">
        <input id="m" autocomplete="off"/>
        <button>Send</button>
    </form>

    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script>

        $(document).ready(function () {
            var socket = io(window.location.hostname + ':6001');

            @if(Auth::check())
                socket.on('App\\Notifications\\CreateOrder', function (channel, message) {
                    alert(channel, message);
                UIkit.notify('ПРИШЛО НОВОЕ ОХУЕННОЕ УВЕДОМЛЕНИЕ', {status: 'success', pos: 'top-right'})
            });

            @endif

        });


    </script>


@stop