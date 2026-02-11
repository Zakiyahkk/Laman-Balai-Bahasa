<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Balai Bahasa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- BOOTSTRAP 5 (WAJIB) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- GOOGLE FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- ICON --}}
    <link rel="icon" type="image/png" href="{{ asset('img/gambar1.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/gambar1.png') }}">

    {{-- CSS GLOBAL USER --}}
    <link rel="stylesheet" href="{{ asset('css/user.css') }}?v={{ time() }}">

    {{-- CSS ZI-WBK --}}
    <link rel="stylesheet" href="{{ asset('css/ziwbk.css') }}?v={{ time() }}">

    {{-- CSS PER HALAMAN --}}
    @yield('css')
</head>

<body>

    {{-- HEADER --}}
    @include('user.partials.header')

    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('user.partials.footer')

    {{-- CHATBOT --}}
    @include('user.beranda.chatbot')

    {{-- JS BOOTSTRAP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- JS USER --}}
    <script src="{{ asset('js/user.js') }}"></script>

    {{-- JS PER HALAMAN --}}
    @stack('scripts')
    @yield('scripts')

</body>

</html>