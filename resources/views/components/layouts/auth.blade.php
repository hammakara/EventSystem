<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Event Management System')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-black dark:bg-black dark:text-white ">
    <x-header/>
    <div class="mt-10 max-w-[27rem]  mx-auto bg-white border border-gray-200 rounded-xl shadow-2xs dark:bg-neutral-900 dark:border-neutral-700">
        <div class="p-4 sm:p-7">
           {{$slot}}
        </div>
    </div>
</body>

</html>
