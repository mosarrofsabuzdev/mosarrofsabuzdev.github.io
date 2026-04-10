<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'UPNEZ Agency OS') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 antialiased bg-gradient-to-br from-blue-100 via-slate-100 to-slate-200">
        <div class="min-h-screen flex flex-col sm:justify-center items-center px-6">
            <div class="mb-6 text-3xl font-extrabold"><span class="text-[#2563EB]">UP</span><span class="text-[#0F172A]">NEZ</span></div>
            <div class="w-full sm:max-w-md p-8 bg-white/95 shadow-xl rounded-2xl border border-slate-200">
                <h1 class="text-xl font-semibold mb-1">Sign in to Agency OS</h1>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
