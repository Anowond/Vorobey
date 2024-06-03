<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Not Found</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="tf2 min-vh-100 d-flex justify-content-center align-items-center flex-column bg-secondary">
    <div>
        <img src="/img/404_engineer.png" alt="A picture of the engineer of TF2 repairing a sentry"
        class="img-fluid rounded-4 my-2" style="width: 300px">
    </div>
    <div class="mt-3">
        <p>The page you are trying you reach isn't exists.</p>
    </div>
    <div class="mt-2">
        <a href="{{route('index')}}" class="btn btn-form">Back to the main page</a>
    </div>
</body>
