<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css'])

</head>
<body class="bg-gray-100 justify-center h-screen">
<main class="text-center h-full flex justify-center items-center">
    <section class="h-fit">
        <h1 class="text-4xl font-bold text-gray-800 mb-6">Welcome to Awesome Blog</h1>
        <p class="text-gray-600 mb-8">Join our community and share your thoughts with the world.</p>
        <div class="flex justify-center space-x-4">
            @if (Route::has('login'))
                <a href="{{ route('login') }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login</a>
            @endif
            @if (Route::has('register'))

                <a href="{{ route('register') }}"
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Register</a>
            @endif
        </div>
    </section>
</main>
<footer class="absolute bottom-0 left-0 w-full p-10">
    <p class="text-center text-gray-600 mt-8">Made with ❤️ by Maciej Chmura</p>

</footer>
</body>
</html>
