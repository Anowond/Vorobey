<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="tf2" x-data>
    <header class='sticky-sm-top sticky-sm-bottom'>
        <nav class="navbar w-100 rounded-lg">
            <div class="container-fluid">
                <a class="navbar-brand tf2 fs-4" href="{{ route('index') }}">Vorobey.com</a>
                <img src="/img/icon.jpg" class="logo navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <div class='collapse navbar-collapse justify-content-end' id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">My Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                    @click.prevent="$refs.logout.submit()">logout</a>
                            </li>
                            <form x-ref='logout' action="{{ route('logout') }}" method="post" class="invisible">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    @if (session('status'))
        <div class="container border-2 rounded" style="background-color: var(--bs-gray-500)">
            <p class="mt-3 text-light text-center py-3">{{ session('status') }}</p>
        </div>
    @endif

    {{ $slot }}

    <section class="footer mt-4 sticky-bottom">
        <h2 class="text-center tf2 py-2">
            My Socials
        </h2>
        <div class="container">
            <div class="row">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-brands fa-discord fa-2x"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-brands fa-steam fa-2x"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-brands fa-twitch fa-2x"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-brands fa-youtube fa-2x"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</body>

</html>