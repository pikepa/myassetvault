<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Asset Vault | {{ $title ?? 'Page Title' }}</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}?v={{ date('YmdHis') }}">
    
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/@tailwindcss/forms@0.2.1/dist/forms.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="//cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/@alpinejs/ui@3.13.7-beta.0/dist/cdn.min.js"></script>
    <!-- @vite('resources/css/app.css') -->

    <!-- Styles -->

</head>

<body class="flex ">

    <div class="p-4">
        {{ $slot }}
    </div>
</body>

</html>