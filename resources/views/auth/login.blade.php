<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>
    Login Page
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
    body {
                background: linear-gradient(to right, #f6d365, #fda085);
                background-size: cover;
                font-family: 'Arial', sans-serif;
            }
            .bg-pattern {
                background-image: url('bg_PASTI.PNG');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
            }
    </style>
</head>
<body class="min-h-screen bg-pattern flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('image/bg_PASTI.png') }}'); background-size: cover; background-repeat: no-repeat;">
    <div class="bg-teal-700 bg-opacity-90 p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="flex justify-center mb-6">
            <img alt="University logo" class="h-24" height="120" src="{{ asset('image/LogoUNDIP.png') }}" width="80"/>
        </div>
        <h1 class="text-3xl font-bold text-yellow-500 text-center mb-2">
            PASTI
        </h1>
        <p class="text-white text-center mb-6">
            Universitas Diponegoro
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <input id="email" type="email" name="email" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Email" required :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <input id="password" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Password" required
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-primary-button class="w-full bg-yellow-500 text-white p-3 rounded-lg font-semibold hover:bg-yellow-600 transition duration-300 flex justify-center items-center">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

            </form>
        
    </div>
    
</body>