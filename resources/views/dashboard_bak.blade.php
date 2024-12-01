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
<body class="min-h-screen">
    
    <!-- Main Content Section -->
    <div class="bg-teal-800/80 p-4 flex items-center justify-between rounded-xl">
    <div class="flex items-center">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        
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
                    <p class="w-full text-justify">Benny, S.Kom</p>
                </div>
                <div class="flex">
                    <p class="w-[140px] font-semibold">NIP</p>
                    <p class="w-[20px] font-semibold">:</p>
                    <p class="w-full">19910986543</p>                                                                                                                                     
                </div>
                <div class="flex">
                    <p class="w-[140px] font-semibold">EMAIL</p>
                    <p class="w-[20px] font-semibold">:</p>
                    <p class="w-full">benny@staff.undip.ac.id</p>
                </div>
                <div class="flex">
                    <p class="w-[140px] font-semibold">NO. TELP</p>
                    <p class="w-[20px] font-semibold">:</p>
                    <p class="w-full">085778654346</p>
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
              <div class="flex items-center">
                  <!-- Icon Align Left -->
                  <i class="far fa-envelope text-2xl"></i>
              </div>
              <div class="flex-1">
                  <!-- Teks Rata Kiri dengan Padding -->
                  <p class="text-sm text-left text-justify pl-3.5 pr-4">[21/07 - 11.31] Pengajuan IRS Anda telah berhasil disetujui. Silakan periksa kembali jadwal kuliah dan pastikan semua mata kuliah yang dipilih sudah sesuai.</p>
              </div>
              <div class="flex space-x-2">
                  <!-- Buttons -->
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
              <div class="flex items-center">
                  <!-- Icon Align Left -->
                  <i class="far fa-envelope text-2xl"></i>
              </div>
              <div class="flex-1">
                  <!-- Teks Rata Kiri dengan Padding -->
                  <p class="text-sm text-left text-justify pl-3.5 pr-4">[20/07 - 20.28] Pengajuan IRS Anda telah berhasil diproses. Mohon untuk menunggu proses verifikasi dari pihak akademik. Silahkan pantau status pengajuan Anda secara berkala melalui sistem.</p>
              </div>
              <div class="flex space-x-2">
                  <!-- Buttons -->
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
              <div class="flex items-center">
                  <!-- Icon Align Left -->
                  <i class="far fa-envelope text-2xl"></i>
              </div>
              <div class="flex-1">
                  <!-- Teks Rata Kiri dengan Padding -->
                  <p class="text-sm text-left text-justify pl-3.5 pr-4">[19/07 - 12.48] Terima kasih, pembayaran UKT Anda telah berhasil. Simpan bukti pembayaran ini untuk keperluan administrasi lebih lanjut.
                  </p>
              </div>
              <div class="flex space-x-2">
                  <!-- Buttons -->
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
        <div class="col-span-3 flex justify-center space-x-4">
            <!-- Periode Akses IRS Button -->
            <a href="{{ route('Jadwal') }}" class="bg-yellow-500 text-white px-8 py-3 rounded-lg flex items-center space-x-2 hover:bg-yellow-600">
              <i class="fas fa-hourglass-half text-3xl"></i>
              <span class="text-2xl">Jadwal</span>
            </a>

            <!-- Ruangan Button -->
            <a href="{{ route('bak_plottingruang') }}" class="bg-yellow-500 text-white px-8 py-5 rounded-lg flex items-center space-x-2 hover:bg-yellow-600">
                <i class="far fa-building text-3xl"></i>
                <span class="text-2xl">Plotting Ruang</span>
            </a>

            <!-- Ruangan Button -->
            <a href="{{ route('bak_ruangan') }}" class="bg-yellow-500 text-white px-8 py-5 rounded-lg flex items-center space-x-2 hover:bg-yellow-600">
                <i class="far fa-building text-3xl"></i>
                <span class="text-2xl">Ruangan</span>
            </a>
        </div>
      </div>
    </div>
</div>
</body>
</html>
@endsection