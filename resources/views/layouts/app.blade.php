<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Full Stack Test</title>

    <link rel="stylesheet" href="{{ mix('/css/app.css')  }}">
</head>
<body>

<div class="container">

    <header class="py-5">
        <h1>
            <a href="/">Full Stack Test</a>
        </h1>
    </header>

    @yield('content')
</div>

@stack('scripts')
</body>
</html>
