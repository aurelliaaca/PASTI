<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>PASTI - Universitas Diponegoro</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>
<body class="min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('image/bg_PASTI.png') }}'); background-size: cover; background-repeat: no-repeat;">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-24 w-auto" src="{{asset('image/LogoUNDIP.png')}}" alt="Universitas Diponegoro Logo">
            <h2 class="mt-6 text-center text-3xl font-bold text-yellow-600">PASTI</h2>
            <p class="text-center text-xl text-gray-100">Universitas Diponegoro</p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md bg-teal-600 bg-opacity-90 p-8 rounded-lg">
            <form class="space-y-6" action="#" method="POST">
                <div>
                    <label for="username" class="block text-sm font-medium text-white">Username</label>
                    <div class="mt-2">
                        <input id="username" name="username" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm focus:ring-2 focus:ring-inset focus:ring-yellow-600">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-white">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm focus:ring-2 focus:ring-inset focus:ring-yellow-600">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-yellow-500 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-600">Login</button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-white">
                <a href="#" class="font-semibold text-yellow-300 hover:text-yellow-400">forgot your password?</a>
            </p>
        </div>
    </div>
</body>
</html>