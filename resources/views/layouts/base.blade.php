<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-partials.head />
    </head>
    <body>
    <x-partials.header />
        <main>{{ $slot }} </main>
        <x-partials.footer />
        @livewireScripts
    </body>
</html>
