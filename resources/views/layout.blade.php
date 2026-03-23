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
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.json-viewer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/highlight.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}">

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.json-viewer.js') }}"></script>
    <script src="{{ asset('js/highlight.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    @yield('head')
    @yield('styles')

</head>

<body class='main page'>

<header class="p-3 border-bottom">
    <div class="d-flex flex-wrap align-items-ler justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                <use xlink:href="#bootstrap"></use>
            </svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
        </ul>

        <div class="dropdown mt-1 text-end">

            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
               data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
            </a>
            <ul class="dropdown-menu text-small" style="">
                {{--                <li><a class="dropdown-item" href="#">Settings</a></li>--}}
                {{--                <li><a class="dropdown-item" href="#">Profile</a></li>--}}
                <li>
                    {{--                    <hr class="dropdown-divider">--}}
                </li>
                <li>
                    {!! Html::Link('#', __("Sign out"), ['class' => 'dropdown-item sign-out']) !!}
                </li>
            </ul>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <div class="sidebar border border-right px-0 bg-body-tertiary" style="width: 7.5rem;">
            <div class="d-flex flex-column flex-shrink-0" style="height: 95vh;">

                <ul class="nav nav-pills nav-flush flex-column mb-auto text-center py-3">
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link rounded-0 link-secondary"
                           data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Users"
                           data-bs-original-title="Users">
                            <i class="bi bi-people md-icon"></i>
                            <div class="ts-12">{{ __('Users') }}</div>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('connections.index') }}" class="nav-link rounded-0 link-secondary"
                           data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Connection"
                           data-bs-original-title="Connection">
                            <i class="bi bi-building md-icon"></i>
                            <div class="ts-12">{{ __("Connection") }}</div>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('sync.index') }}" class="nav-link rounded-0 link-secondary"
                           data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Sync Job"
                           data-bs-original-title="Sync Job">
                            <i class="bi bi-calendar3 md-icon"></i>
                            <div class="ts-12">{{ __('Sync Job') }}</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="ps-5 col-lg-11">
            <div class=" px-4 py-4" id="featured-3">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('logout') }}" id="sign-out">
    @csrf
</form>

<!-- Footer -->

<footer>
</footer>

@yield('scripts')

</body>

</html>
