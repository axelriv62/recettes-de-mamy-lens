<!-- resources/views/components/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Les recettes de Mamy Lens</title>
    @vite(['resources/css/app.css'])
</head>
<body>
<x-menu />
<main>
    {{ $slot }}
</main>
</body>
<x-aside />
<x-footer />
</html>
