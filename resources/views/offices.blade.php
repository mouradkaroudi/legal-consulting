<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>مشروع المحامي</title>


    {{-- ... --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="">
    <x-navbar />
    <div class="container mx-auto">
        @foreach ($offices as $office)
        <x-legal-office-card />
        @endforeach
    </div>
</body>

</html>