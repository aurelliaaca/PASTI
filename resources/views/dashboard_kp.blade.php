@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<html>
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-image: url('{{ asset('image/bg_PASTI.png') }}');
      background-size: cover;
      background-repeat: no-repeat;
    }
  </style>
</head>
<body class="min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('image/bg_PASTI.png') }}'); background-size: cover; background-repeat: no-repeat;">
    
    <!-- Main Content Section -->
    <div class="bg-teal-800/80 p-4 flex items-center justify-between rounded-xl">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
        
        <!-- Left Section (Profile) -->
        <div class="col-span-1 bg-teal-900 text-white p-4 rounded-lg">
            <div class="flex flex-col items-center">
            <img alt="Profile Picture" class="rounded-full mb-4" src="{{ asset('image/profil.png') }}" width="100" height="100"/>
            <h2 class="text-center text-lg font-semibold mb-2">Profil</h2>
            <div class="text-left w-full">
                <div class="space-y-2">
                <div class="flex">
                    <p class="w-[140px] font-semibold">NAMA</p>
                    <p class="w-[20px] font-semibold">:</p>
                    <p class="w-full text-justify">Saddam Dharmawan, S.Kom, M.Kom</p>
                </div>
                <div class="flex">
                    <p class="w-[140px] font-semibold">NIP</p>
                    <p class="w-[20px] font-semibold">:</p>
                    <p class="w-full">199108130090</p>                                                                                                                                     
                </div>
                <div class="flex">
                    <p class="w-[140px] font-semibold">EMAIL</p>
                    <p class="w-[20px] font-semibold">:</p>
                    <p class="w-full">saddam@lecture.undip.ac.id</p>
                </div>
                <div class="flex">
                    <p class="w-[140px] font-semibold">NO. TELP</p>
                    <p class="w-[20px] font-semibold">:</p>
                    <p class="w-full">085778323467</p>
                </div>
                <div class="flex">
                    <p class="w-[140px] font-semibold">PRODI</p>
                    <p class="w-[20px] font-semibold">:</p>
                    <p class="w-full">S1 Informatika</p>
                </div>
                </div>
            </div>
            </div>
        </div>
        
        <!-- Right Section (Notifications) -->
        <div class="col-span-2 bg-teal-900 text-white p-4 rounded-lg">
          <div class="space-y-4">
            <div class="bg-teal-800 p-4 rounded-lg flex justify-between items-center">
              <div>
                  <i class="far fa-envelope text-2xl"></i>
              </div>
              <div class="flex-1 pl-3.5 pr-4 text-left">
                <p class="text-sm">[29/06 - 11.00] Dekan - Menyetujui Jadwal Perkuliahan.</p>
              </div>
              <div class="flex space-x-2">
                <button class="bg-white text-teal-800 p-2 rounded flex items-center space-x-2">
                  <span class="text-sm">Hapus</span>
                  <i class="far fa-trash-alt"></i>
                </button>
                <button class="bg-white text-teal-800 p-2 rounded flex items-center space-x-2">
                  <span class="text-sm">Tinjau</span>
                  <i class="far fa-paper-plane"></i>
                </button>
              </div>
            </div>
            
            <div class="bg-teal-800 p-4 rounded-lg flex justify-between items-center">
              <div>
                <i class="far fa-envelope text-2xl"></i>
              </div>
              <div class="flex-1 pl-3.5 pr-4 text-left">
                <p class="text-sm">[25/06 - 09.30] Dekan - Menolak Jadwal Perkuliahan.</p>
              </div>
              <div class="flex space-x-2">
                <button class="bg-white text-teal-800 p-2 rounded flex items-center space-x-2">
                  <span class="text-sm">Hapus</span>
                  <i class="far fa-trash-alt"></i>
                </button>
                <button class="bg-white text-teal-800 p-2 rounded flex items-center space-x-2">
                  <span class="text-sm">Tinjau</span>
                  <i class="far fa-paper-plane"></i>
                </button>
              </div>
            </div>
            
          </div>
        </div>

        <!-- Container for Centered Buttons -->
        <div class="col-span-3 flex justify-center space-x-4 mt-4">
            <!-- Penjadwalan Button -->
            <a href="{{ route('kp_penjadwalan') }}" class="bg-yellow-500 text-white px-16 py-5 rounded-lg flex items-center space-x-2 hover:bg-yellow-600">
                <i class="far fa-calendar text-3xl"></i>
                <span class="text-2xl">Penjadwalan</span>
            </a>

            <!-- Mata kuliah Button -->
            <button class="bg-yellow-500 text-white px-8 py-5 rounded-lg flex items-center space-x-2">
                <i class="fas fa-book text-3xl"></i>
                <span class="text-2xl">Mata Kuliah</span>
            </button>

            <!-- Monitoring IRS Button -->
            <a href="{{ route('dk_monitoring') }}" class="bg-yellow-500 text-white px-8 py-5 rounded-lg flex items-center space-x-2 hover:bg-yellow-600">
                <i class="fa fa-users text-3xl"></i>
                <span class="text-2xl">Monitoring Jadwal Kuliah</span>
            </a>
        </div>
        </div>

      </div>
    </div>
  </div>
</body>
</html>
@endsection