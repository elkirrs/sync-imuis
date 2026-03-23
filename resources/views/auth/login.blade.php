<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset='utf-8'>
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
    <title>@yield('title', config('app.name'))</title>

    <meta content='' name='description'>
    <meta content='' name='keywords'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.json-viewer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icon.css') }}">

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>

    @yield('head')
    @yield('styles')
</head>

<body class='main page'>

<header>
</header>
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">{{ __("Login") }}</h3>

                    <form method="POST"
                          action="{{ route('login') }}"
                    >
                        @csrf

                        {{-- Email --}}
                        {!! Html::Input(12, 'text', 'email', 'Email address') !!}


                        {{-- Password --}}
                        {!! Html::Input(12, 'password', 'password', 'Password') !!}

                        {{-- Remember me --}}
                        {!! Html::Checkbox("remember", "Remember Me", 0, false, 'primary', true) !!}

                        {{-- Submit --}}
                        <div class="d-grid mb-3">
                            {!! Html::Button(12, 'submit', 'login', 'Login', ['class' => 'btn btn-outline-primary']) !!}
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<footer>
</footer>

@yield('scripts')

</body>

</html>
