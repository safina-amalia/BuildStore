<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles
</head>

<body>
    {{-- Cek apakah halaman saat ini edit profil admin --}}
    @if (!request()->routeIs('admin.edit-admin-profile'))
        <livewire:header />
    @endif

    {{ $slot }}

    <livewire:footer />
    
    @livewireScripts

    {{-- Tambahkan ini agar file lain bisa menyisipkan script tambahan seperti grafik --}}
    @stack('scripts')
</body>

</html>
