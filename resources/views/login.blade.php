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
   <form>
    <div class="mb-4">
     <input class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Username" type="text"/>
    </div>
    <div class="mb-6">
     <input class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Password" type="password"/>
    </div>
    <button class="w-full bg-yellow-500 text-white p-3 rounded-lg font-semibold hover:bg-yellow-600 transition duration-300" type="submit">
     Login
    </button>
   </form>
   <div class="text-center mt-4">
    <a class="text-white underline" href="#">
     forgot your password?
    </a>
   </div>
  </div>
 </body>
</html>
