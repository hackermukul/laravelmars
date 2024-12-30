<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-partials.head />
    </head>
    <body>
    <x-partials.header :companyProfile="$companyProfile" />
        <main>{{ $slot }} </main>
         <x-partials.footer :companyProfile="$companyProfile" />

        @livewireScripts
    </body>
</html>
