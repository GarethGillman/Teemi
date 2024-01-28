@php
$page = request()->path();
$page = explode('/', $page);
$page = $page[0];
if( $page == 'dashboard' ) {
    $page = $page;
} else {
    $page = 'frontend';
}
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- CSS / Scripts -->
        @if( $page == 'dashboard' )
            @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
        @else
            @vite(['resources/css/frontend.css', 'resources/js/app.js'])
        @endif
        
    </head>
    <body class="{{ $page }}">

        @if( $page == 'dashboard' )

            @include('partials.dashboard-navigation')

            <!-- Page Content -->
            <main id="content-wrapper">
                {{ $slot }}
            </main>
        @else
            {{ $slot }}
        @endif

    </body>
</html>
