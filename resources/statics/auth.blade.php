<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="tf2 d-flex flex-column justify-content-center">
    <div class="container text-center my-5">
        <a href="{{ route('index') }}"><img src="/img/icon.jpg" alt="le logo du créateur" class="rounded-circle"
                style="height: 75px"></a>
    </div>
    <div class="container my-5">
        <form class="row g-3">
            <div class="col-8">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-8">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword4">
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Remember me
                    </label>
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </form>
    </div>
</body>
</div>

</html>
