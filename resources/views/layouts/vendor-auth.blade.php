<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vendor Portal | PAK TRAVEL')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/paktravels-favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .enterprise-shadow { box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body class="bg-slate-50 antialiased overflow-x-hidden min-h-screen">
    
    @yield('content')

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
