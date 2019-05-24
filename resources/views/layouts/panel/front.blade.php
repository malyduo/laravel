<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}" crossorigin="anonymous"

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style_panel.css') }}" rel="stylesheet">
</head>
<body class="front">

<main class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 login">
                <?php $action = Route::currentRouteName() ?>

                <div class="row">
                    <div class="col p-0">
                        <a href="{{ route('login') }}"
                           class="btn-login d-block @if($action == 'login')active @endif">{{ __('Logowanie') }}</a>
                    </div>
                    <div class="col p-0">
                        <a href="{{ route('register') }}"
                           class="btn-login d-block @if($action == 'register')active @endif">{{ __('Rejestracja') }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 p-4">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {

        //FontAwesome Config CSS
        window.FontAwesomeConfig = {
            searchPseudoElements: true
        }
    });
</script>
@yield('scripts')
</body>
</html>
