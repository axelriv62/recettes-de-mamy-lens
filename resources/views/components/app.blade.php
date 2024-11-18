<!-- resources/views/components/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<x-menu />
<main>
    {{ $slot }}
</main>
<x-footer />
</body>
</html>
