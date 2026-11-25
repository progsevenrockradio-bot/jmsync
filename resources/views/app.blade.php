<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="cmsmasters_html">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title inertia>{{ config('app.name', 'JMSync') }}</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    {{-- Theme boldest fonts (embedded locally) --}}
    {{-- <link rel="stylesheet" href="{{ asset('boldest.css') }}" /> --}}

    {{-- Vite assets (theme CSS + app CSS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Inertia Head component --}}
    @inertiaHead

    {{-- Custom head scripts from admin --}}
    @if($page['props']['site']['analytics']['head_scripts'] ?? false)
        {!! $page['props']['site']['analytics']['head_scripts'] !!}
    @endif
</head>
<body>
    {{-- Custom body scripts from admin --}}
    @if($page['props']['site']['analytics']['body_scripts'] ?? false)
        {!! $page['props']['site']['analytics']['body_scripts'] !!}
    @endif

    @inertia

</body>
</html>
