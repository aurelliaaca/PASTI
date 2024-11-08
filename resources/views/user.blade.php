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
    <p class="text-white text-lg text-center mb-6">
    Login sebagai :
    </p>
    <div class="flex justify-center space-x-10">
    <div class="text-center">
        <div class="bg-white w-16 h-16 flex items-center justify-center rounded-full mb-2 ml-9">
            <i class="fas fa-user text-4xl text-teal-700"></i>
        </div>
        <button class="bg-yellow-500 text-white px-11 py-2 rounded-full">
            Dosen
        </button>
    </div>
    <div class="text-center">
        <div class="bg-white w-16 h-16 flex items-center justify-center rounded-full mb-2 ml-12">  
            <i class="fas fa-user text-4xl text-teal-700"></i>
        </div>
        <button class="bg-yellow-500 text-white px-6 py-2 rounded-full ml-4">
            Ketua Prodi
        </button>
    </div>
    </div>
</body>
</html>
