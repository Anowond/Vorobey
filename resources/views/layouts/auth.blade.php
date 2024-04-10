<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="tf2 d-flex flex-column justify-content-center">
    <div class="container text-center mt-5">
        <a href="{{ route('index') }}"><img src="/img/icon.jpg" alt="le logo du créateur" class="rounded-circle"
                style="height: 75px; box-shadow: 2px 2px 10px;"></a>
    </div>
    <div class="container my-5">
        <form class="row g-3" method="POST" action="{{ $action }}" novalidate>
            @csrf
            {{ $slot }}
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-form">{{ $submitMessage }}</button>
            </div>
        </form>
    </div>
</body>
</div>

</html>
