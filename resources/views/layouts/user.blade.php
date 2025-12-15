<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Balai Bahasa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- FONT AWESOME (ICON RESMI) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- CSS USER --}}
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

</head>

<body>

    {{-- HEADER LENGKAP (TOPBAR + LOGO + NAVBAR) --}}
    @include('user.partials.header')

    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('user.partials.footer')

    {{-- JS USER --}}
    <script src="{{ asset('js/user.js') }}"></script>

</body>

</html>
