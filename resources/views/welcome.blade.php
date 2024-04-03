<!DOCTYPE html>
<html lang="en">
<head>
    <title>GloBlog</title>
    @livewireScripts
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-200">
    <div class="flex justify-center items-center min-h-screen">
        <h1 class="text-4xl font-bold text-center underline">Welcome to GloBlog</h1>
    </div>
    <div class="relative flex justify-center items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="max-w-md mx-auto p-6 lg:p-8">
            <div class="flex flex-col gap-4 items-center">
                <a href="{{ route('login') }}" class="w-full p-4 bg-white text-center rounded-lg text-gray-900 dark:text-white dark:bg-gray-800 hover:bg-green-300 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-red-500 transition-colors duration-300">Login</a>
                <a href="{{ route('register') }}" class="w-full p-4 bg-white text-center rounded-lg text-gray-900 dark:text-white dark:bg-gray-800 hover:bg-green-300 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-red-500 transition-colors duration-300">Register</a>
                <a href="{{ route('posts.index') }}" class="w-full p-4 bg-white text-center rounded-lg text-gray-900 dark:text-white dark:bg-gray-800 hover:bg-orange-300 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-red-500 transition-colors duration-300">Guest</a>
            </div>
        </div>
    </div>
</body>
</html>
