@extends('layouts.app')

@section('title', 'Persetujuan')

@section('content')
<html>
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-image: url('{{ asset('image/bg_PASTI1.png') }}');
      background-size: cover;
      background-repeat: no-repeat;
    }
  </style>
</head>

<body class="relative">
    <!-- Back Button -->
    <a href="{{ url()->previous() }}" class="absolute top-15 left-7 bg-teal-800 text-white p-2 rounded-full hover:bg-teal-700">
      <i class="fas fa-arrow-left text-xl"></i>
    </a>

    <div class="container bg-white shadow-lg rounded-lg mx-auto max-w-7xl p-6 mt-2 min-h-[600px]">
        <!-- Header Section -->
        <h1 class="text-2xl font-semibold text-teal-800 mb-6 text-center flex items-center justify-center space-x-3">
            <i class="fa fa-users text-teal-800 text-4xl"></i>
            <span>MONITORING JADWAL KULIAH</span>
        </h1>

        <!-- Monitoring Progress -->
        <div class="h-full flex items-center justify-center mt-20">
            <div class="space-y-24 w-full max-w-3xl">
                <!-- Jadwal Kuliah Sudah Disetujui -->
                <div class="flex items-center space-x-6">
                    <i class="fas fa-calendar-check text-teal-800 text-6xl"></i>
                    <div class="w-full">
                        <p class="text-2xl font-semibold text-gray-800 mb-3">Jadwal Kuliah Sudah Disetujui</p>
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
                                aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%; font-size: 1.2rem;">
                                72%
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Kuliah Belum Disetujui -->
                <div class="flex items-center space-x-6">
                    <i class="fas fa-calendar-times text-teal-800 text-6xl"></i>
                    <div class="w-full">
                        <p class="text-2xl font-semibold text-gray-800 mb-3">Jadwal Kuliah Belum Disetujui</p>
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar"
                                aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%; font-size: 1.2rem;">
                                55%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
