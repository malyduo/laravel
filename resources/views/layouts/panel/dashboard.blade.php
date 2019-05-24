<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style_panel.css') }}" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-resize">
                    <i class="fas fa-bars"></i>
                </button>
                <h2 class="main-title">CATERING</h2>

                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Zaloguj') }}</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a id="navbarDropdown" class="nav-link" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="far fa-envelope"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="navbarDropdown" class="nav-link" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="far fa-bell"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            @role('super_admin')
                            <select class="selectpicker" id="btn-change-client" data-live-search="true">
                                @foreach($clients as $client)
                                <option data-tokens="{{ $client->name }}" value="{{ $client->id }}" {{ ($client->id == Auth::user()->id_client) ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>

                            @else
                            <a id="navbarDropdown" class="nav-link" href="#">
                                {{ $client->name }}
                            </a>
                            @endrole
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->email }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">
                                    {{ __('Profil') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                    {{ __('Wyloguj') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt fa-fw"></i>
                            Kokpit
                        </a>
                    </li>
                    @if(auth()->user()->can('catering_foods_list'))
                    <li>
                        <a href="#catering" data-toggle="collapse" aria-expanded="{{ Request::is('catering/*') ? 'true' : 'false'}}" class="dropdown-toggle">
                            <i class="fas fa-utensils fa-fw"></i>
                            Catering
                        </a>
                        <ul class="collapse list-unstyled{{ Request::is('catering/*') ? ' show' : ''}}" id="catering">
                            @can('catering_foods_list')
                            <li>
                                <a href="{{ route('catering.foods') }}">Dania</a>
                            </li>
                            @endcan
                            <li>
                                <a href="#">Zestawy obiadowe</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li>
                        <a href="#schedule" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-calendar-alt fa-fw"></i>
                            Terminarz
                        </a>
                        <ul class="collapse list-unstyled" id="schedule">
                            <li>
                                <a href="#">Kalendarz</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#summary" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-calculator fa-fw"></i>
                            Rozliczenia
                        </a>
                        <ul class="collapse list-unstyled" id="summary">
                            <li>
                                <a href="#">Link</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#stats" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-chart-pie fa-fw"></i>
                            Statystyki
                        </a>
                        <ul class="collapse list-unstyled" id="stats">
                            <li>
                                <a href="#">Link</a>
                            </li>
                        </ul>
                    </li>
                    @role('super_admin')
                    <li>
                        <a href="#admin" data-toggle="collapse" aria-expanded="{{ (Request::is('admin/*')) ? 'true' : 'false' }}" class="dropdown-toggle">
                            <i class="fas fa-cogs fa-fw"></i>
                            Administracja
                        </a>
                        <ul class="collapse list-unstyled{{ (Request::is('admin/*')) ? ' show' : '' }}" id="admin">
                            <li>
                                <a href="#admin-catering" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle submenu">
                                    Catering
                                </a>
                                <ul class="collapse list-unstyled submenu-items" id="admin-catering">
                                    <li>
                                        <a href="{{ route('admin.allergens') }}">Alergeny</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.menu-categories') }}">Kategorie dań</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#admin-system" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle submenu">
                                    System
                                </a>
                                <ul class="collapse list-unstyled submenu-items" id="admin-system">
                                    <li>
                                        <a href="{{ route('admin.roles') }}">Grupy użytkowników</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.users') }}">Użytkownicy</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.clients') }}">Klienci</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.modules') }}">Moduły</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.permissions') }}">Uprawnienia</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @endrole
                </ul>
            </nav>

            <!-- Content  -->
            <div id="wrapper-content">
                <div class="container-fluid">
                    <div class="row main-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
                integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
                integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
        <!--Nice scroll-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.0/jquery.nicescroll.min.js"></script>
        <!--Sweet alert-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <!-- Bootstrap Select -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
        <script type="text/javascript">
                                       $(document).ready(function () {
                                           $("#wrapper-content").niceScroll();
                                           $("#sidebar").niceScroll();
                                           $("#sidebar").on('mouseover', function () {
                                               $("#sidebar").getNiceScroll().resize();
                                               $("#sidebar").niceScroll();
                                           });

                                           $('[data-toggle="tooltip"]').tooltip();

                                           $('#sidebarCollapse').on('click', function () {
                                               $('#sidebar').toggleClass('active');
                                               $('.navbar-left').toggleClass('active');
                                           });

                                           $('#btn-change-client').on('change', function () {
                                               let id = <?= Auth::user()->id ?>;
                                               let id_client = $(this).val();
                                               $.ajax({
                                                   url: '/admin/user/change-client',
                                                   type: 'POST',
                                                   async: true,
                                                   dataType: 'json',
                                                   data: {id: id, id_client: id_client},
                                                   headers: {
                                                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                   },
                                                   success: function (data) {
                                                       if (data) {
                                                           Swal.fire({
                                                               html: '<h2 class="fm-sa-header">Zmieniono klienta!</h2>',
                                                               type: 'success',
                                                               confirmButtonText: 'OK',
                                                           }).then((result) => {
                                                               if (result.value) {
                                                                   window.location.reload();
                                                               }
                                                           });
                                                           sweet_css_modify();
                                                       }
                                                   }
                                               });
                                           });

                                           sweet_css_modify = function () {
                                               $(".swal2-confirm").css('background', '#d4213d');
                                               $(".swal2-cancel").css('background', '#999');
                                               $(".swal2-icon.swal2-question").css({
                                                   'border-color': '#999',
                                                   'color': '#999',
                                               });
                                           }

                                           //FontAwesome Config CSS
                                           window.FontAwesomeConfig = {
                                               searchPseudoElements: true
                                           }
                                       }
                                       );
        </script>
        @yield('scripts')
    </body>
</html>
