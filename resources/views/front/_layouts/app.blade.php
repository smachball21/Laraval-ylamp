<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')
    <title>@hasSection('title')@yield('title') - @endif{{ config('app.name') }}</title>
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset_cache('images/logo.png') }}"/>
    {{--Fonts--}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    {{--Styles--}}
    <link href="{{ mix('css/front/vendor.css') }}" rel="stylesheet">
    <link href="{{ mix('css/front/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
@include('_partials.maintenance_ribbon')
@include('_partials.switched-auth-warning')
<div class="bblue">
    <div class="container">
        <nav class="navbar navbar-dark w-100 d-flex justify-content-between">
            <div>
                <a class="navbar-brand" href="/">
                    <img
                        src="{{ asset_cache('images/logo.png') }}"
                        width="30px" height="30px" class="d-inline-block align-top" alt="logo">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            @auth
                <div class="text-uppercase">
{{--                    <a href="{{ route('contact') }}" class="btn cwhite">{{ __('Contact form') }}</a>--}}
                    <a href="{{ route('friendship.friends') }}" class="btn cwhite">{{ __('Amis') }}</a>
                    <a href="{{ route('posts.get') }}" class="btn cwhite">Mes Posts</a>
                </div>
            @endauth

            {{--Menu--}}
            <div>
                @if (isset($navMenus['menu']))
                    @foreach ($navMenus['menu']->getTree() as $node)
                        @if (empty($node['children']))
                            @include('front._partials._navbar_link', ['node' => $node, 'dropdownItem' => false, 'linkClass' => 'btn'])
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    {{ $node['item']->getSmartText() }}
                                </a>
                                <div class="dropdown-menu">
                                    @foreach ($node['children'] as $childNode)
                                        @include('front._partials._navbar_link', ['node' => $node, 'dropdownItem' => true, 'linkClass' => 'btn'])
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endforeach
                @endif
                {{--Authentication Links--}}
                @guest
                    {{--Login--}}
                    <a href="{{ route('login') }}" class="btn cwhite">{{ __('Login') }}</a>
                    {{--Register--}}
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn cwhite">{{ __('Register') }}</a>
                    @endif
                @else
                    @can($ACCESS_BACKOFFICE)
                        {{--Backoffice--}}
                        <a href="{{ route('back.dashboard') }}" class="btn btn-danger">
                            {{ __('Administration') }}
                        </a>
                    @endcan

                    {{--Logout--}}
                    <a href="{{ route('logout') }}" class="btn cwhite"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </div>
        </nav>
    </div>
</div>

@yield('content')

{{--Scripts--}}
<script>
    var APP = {};
    APP.csrf_token = '{{ csrf_token() }}';
    APP.notify = {
        info: '{{ Session::get('infoNotif') }}',
        success: '{{ Session::get('successNotif') }}',
        warning: '{{ Session::get('warningNotif') }}',
        danger: '{{ Session::get('dangerNotif') }}',
    };
</script>
<script src="{{ mix('js/front/app.js') }}"></script>
@stack('scripts')
<!-- Footer -->
<footer class="page-footer text-light font-small footer-color fixed-bottom mt-5">

    <!-- Copyright -->
    <div class="footer-copyright text-right py-3 mr-3">© 2020 Copyright:
        <a href="http://gtd.local"> GTD.local</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
</body>
</html>
