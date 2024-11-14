<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
  <title>@yield('title')</title>
</head>
<body class="font-roboto">

  <!-- Include Header -->
  @include('layouts.header')

  <!-- Main Content -->
  <main class="p-4">
    @yield('content')
  </main>

</body>
</html>
