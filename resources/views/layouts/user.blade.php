<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Balai Bahasa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- FONT AWESOME (ICON RESMI) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    {{-- ICONS/LOGO --}}
    <link rel="icon" type="image/png" href="{{ asset('img/gambar1.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/gambar1.png') }}">

    {{-- CSS USER --}}
    <link rel="stylesheet" href="{{ asset('css/user.css') }}?v={{ time() }}">

    <link rel="stylesheet" href="{{ asset('css/ziwbk.css') }}">

    <!-- CSS Halaman Spesifik -->
    @yield('css')
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
    {{-- JS HALAMAN (PREVIEW, DLL) --}}
    @stack('scripts')
    @yield('js')

</body>

</html>
