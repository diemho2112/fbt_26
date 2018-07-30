<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('message.title')</title>
    {{ Html::style(asset('css/app.css')) }}
    {{ Html::style(asset('css/all.css')) }}
    {{ Html::style(asset('css/admin.css')) }}
    {{ Html::style(asset('css/font-awesome.css')) }}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    @lang('message.brand')
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @auth
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" id="logout-admin">
                                <i class="fa fa-sign-out"></i>@lang('message.logout')
                            </a>
                            {!! Form::open(['route' => 'logout', 'id' => 'logout-admin-form']) !!}
                            {!! Form::close() !!}
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </nav>
        @yield('content')
    </div>
    {{ Html::script(asset('js/app.js')) }}
    {{ Html::script(asset('js/admin.js')) }}
</body>
</html>
