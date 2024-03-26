<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Vorobey') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="container col-12 py-2">
    <header>
        <nav class="navbar navbar-expand-lg bg-warning rounded border">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Vorobey</a>
                <img class="navbar-toggler w-25 border-0 rounded-circle" src="/img/icon.jpg" alt="logo du createur" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation" />
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

        <section class="my-2">

        </section>
        <section class="my-2">

        </section>
        <section class="my-2">

        </section>

    <footer class="my-2 bg-warning">

    </footer>
</body>


</html>
