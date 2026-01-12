<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Balai Bahasa')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    @include('user.partials.header')
    <main>
        @yield('content')
    </main>

    @include('user.partials.footer')

    <script src="{{ asset('js/user.js') }}"></script>
</body>


</html>
