@extends('layouts.app')

@section('title', 'PengisianIRS')

@section('content')
<!-- Belum selesai -->
<html>
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: linear-gradient(to right, #02979D, #FFBB1C); /* gradien dari teal ke amber */
            background-size: cover;
            background-repeat: repeat;
            height: max-content; /* membuat tinggi halaman 100% dari viewport */
            margin: 0; /* menghapus margin default dari body */
        }
  </style>
</head>
<!-- Background -->
<body class="min-h-screen bg-gradient-to-r from-teal-600 to-amber-500">
  <div class="max-w-7xl mx-auto min-h-screen">
  

  <!-- header -->
  <div class="flex w-full mb-4">
    <!-- Back Button -->
    <a href="{{ url()->previous()}}" class="absolute top-15 left-7 bg-teal-800 text-white p-2 rounded-full hover:bg-teal-700">
      <i class="fas fa-arrow-left text-xl"></i>
    </a>
    
    <div class="flex w-full">
        <button class="a flex-1 bg-amber-400 text-teal-800 p-2 rounded-tl-xl rounded-bl-xl shadow-sm hover:bg-orange-400 whitespace-nowrap flex justify-center items-center" data-filter=".IRS">
            <span class="text-white font-semibold italic text-center">PENGISIAN IRS</span>
        </button>
        <button class="a flex-1 bg-teal-700 text-teal-800 p-2 rounded-tr-xl rounded-br-xl shadow-sm hover:bg-orange-400 whitespace-nowrap flex justify-center items-center" data-filter=".KRS">
            <span class="text-white font-semibold italic text-center">KRS</span>
        </button>
    </div>
  </div>

    <!-- Main Content Section -->
  <div class="grid grid-cols-8 gap-4 w-full">
  
    <!-- Left Section (Profile) -->
    <div class="col-span-2 bg-teal-700 text-white p-4 rounded-lg">
      <div class="flex flex-col items-center space-y-2">

            <div class="text-left w-full">
                <div class="space-y-0">
                <div class="flex">
                    <p class="text-sm align-top w-[100px] font-semibold">NAMA</p>
                    <p class="text-sm align-top w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle text-justify w-full">Muhammad Faiq As-sajad</p>
                </div>

                <div class="flex">
                    <p class="text-sm align-top w-[100px] font-semibold">NIM</p>
                    <p class="text-sm align-top w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">14050122120168</p>
                </div>
                </div>
            </div>

            <div class="w-full h-px bg-white rounded-lg">
            </div>

            <div class="text-left w-full">
                <div class="space-y-0">
                <div class="flex">
                    <p class="text-sm align-top w-[300px] font-semibold">TAHUN AJARAN</p>
                    <p class="text-sm align-top w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">2024/2025</p>
                </div>

                <div class="flex">
                    <p class="text-sm align-top  w-[300px] font-semibold">GANJIL/GENAP</p>
                    <p class="text-sm align-top  w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">Ganjil</p>
                </div>

                <div class="flex">
                    <p class="text-sm align-top w-[300px] font-semibold">SEMESTER</p>
                    <p class="text-sm align-top  w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">5</p>
                </div>
                
                <div class="flex">
                    <p class="text-sm align-top  w-[300px] font-semibold">IPK</p>
                    <p class="text-sm align-top  w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">3,67</p>
                </div>
                
                <div class="flex">
                    <p class="text-sm align-top w-[300px] font-semibold">IPS</p>
                    <p class="text-sm align-top w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">3,75</p>
                </div>

                <div class="flex">
                    <p class="text-sm align-top w-[300px] font-semibold">MAX BEBAN SKS</p>
                    <p class="text-sm align-top w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">24</p>
                </div>
                </div>
            </div>

                <!-- Dropdown Pilihan Mata Kuliah -->
            <div class="w-full mt-4">
                <select id="matkul-dropdown" class="w-full p-4 rounded bg-white text-teal-800 text-xs">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    <option value="1">Pengembangan Berbasis Platform</option>
                    <option value="2">Komputasi Tersebar Paralel</option>
                    <option value="3">Sistem Informasi</option>
                    <option value="4">Algoritma dan Struktur Data</option>
                    <option value="5">Jaringan Komputer</option>
                    <option value="6">Database</option>
                </select>
            </div>

            <div class="grid grid-cols-1 w-full flex space-x-2">
                <button class="bg-white text-teal-700 w-full p-2 rounded items-center space-x-2">
                    <span class="text-base font-semibold">PILIHAN MATA KULIAH</span>
                    <i class="fas fa-chevron-down text-base"></i>
                </button>
            </div>

            <div class="grid grid-cols-1 text-left w-full flex space-x-2">
                <button class="bg-teal-100/90 text-teal-700 w-full p-1 rounded space-x-2">
                  <div class="flex items-center justify-center">
                    <p class="leading-tight text-[11px] items-center w-full pl-1 text-justify">Pengembangan Berbasis Platform</p>
                    <p class="text-[10px] text-right w-40 pl-1 pr-1 font-semibold align-middle	">WAJIB (501 3 SKS)</p>
                  </div>
                </button>
            </div>

            <div class="grid grid-cols-1 text-left w-full flex space-x-2">
                <button class="bg-orange-200 text-teal-700 w-full p-1 rounded items-center space-x-2">
                  <div class="flex items-center justify-center">
                    <p class="leading-tight text-[11px] items-center w-full pl-1 text-justify">Komputasi tersebar Paralel</p>
                    <p class="text-[10px] text-right w-40 pl-1 pr-1 font-semibold">WAJIB (502 3 SKS)</p>
                  </div>
                </button>
            </div>

            <div class="grid grid-cols-1 text-left w-full flex space-x-2">
                <button class="bg-teal-100/90 to-white text-teal-700 w-full p-1 rounded items-center space-x-2">
                  <div class="flex items-center justify-center">
                    <p class="leading-tight text-[11px] items-center w-full pl-1 text-justify">Sistem Informasi</p>
                    <p class="text-[10px] text-right w-40 pl-1 pr-1 font-semibold">WAJIB (503 3 SKS)</p>
                  </div>
                </button>
            </div>

            <div class="grid grid-cols-2 w-full flex-grow space-x-2">
                <button class="bg-white text-teal-700 p-2 rounded-lg items-center space-x-2">
                    <span class="text-base font-semibold italic">RESET</span>
                </button>
                <button class="bg-amber-400 text-white p-2 rounded-lg items-center space-x-2">
                    <span class="text-base font-semibold italic">AJUKAN</span>
                </button>
            </div>
            
        </div>
    </div>
    
    <!-- Right Section (Notifications) -->
<div class="col-span-6">
    <!-- IRS Content -->
    <div class="IRS">
        <div class="bg-teal-800/80 text-teal-900 p-4 rounded-lg">
            <div class="space-y-0">
                <!-- Main Content -->
            <div class="overflow-x-auto rounded-lg">
                <table class="table-auto w-full text-center rounded-lg border-collapse">
                    <thead>
                        <tr class="bg-teal-100/80">
                            <th class="px-4 py-2 border-r border-teal-500">Nama Mata Kuliah</th>
                            <th class="px-4 py-2 border-r border-teal-500">Kode</th>
                            <th class="px-4 py-2 border-r border-teal-500">SKS</th>                            <th class="px-4 py-2 border-r border-teal-500">SKS</th>
                            <th class="px-4 py-2 border-r border-teal-500">Hari</th>
                            <th class="px-4 py-2 border-r border-teal-500">Jam</th>
                            <th class="px-4 py-2 border-r border-teal-500">Kelas</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="jadwalTableBody">
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- KRS Content -->
    <div class="KRS" style="display: none;">
        <div class="bg-white text-teal-900 p-4 rounded-lg">
            <div class="space-y-4">
                <h2 class="text-xl font-bold text-teal-800">Kartu Rencana Studi</h2>
                <div class="grid grid-cols-1 gap-4">
                    <div class="border p-4 rounded-lg">
                        <h3 class="font-semibold">Mata Kuliah yang Diambil</h3>
                        <ul class="mt-2 space-y-2">
                            <li>Pengembangan Berbasis Platform - 3 SKS</li>
                            <li>Komputasi tersebar Paralel - 3 SKS</li>
                            <li>Sistem Informasi - 3 SKS</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
      </div>
        </main>
    </div>
    </div>
</div>


  </div>
</div>


    </div>
    </div>

</body>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.a');
    const irsContent = document.querySelector('.IRS');
    const krsContent = document.querySelector('.KRS');

    // Fungsi untuk mengatur tampilan konten
    function toggleContent(filter) {
      if (filter === 'IRS') {
        irsContent.style.display = 'block';
        krsContent.style.display = 'none';
      } else if (filter === 'KRS') {
        irsContent.style.display = 'none';
        krsContent.style.display = 'block';
      }
    }

    buttons.forEach(button => {
      button.addEventListener('click', function() {
        // Menghapus titik dari data-filter
        const filter = this.getAttribute('data-filter').substring(1);
        
        // Mengatur warna background button
        buttons.forEach(btn => {
          btn.classList.remove('bg-amber-400');
          btn.classList.add('bg-teal-700');
        });
        this.classList.remove('bg-teal-700');
        this.classList.add('bg-amber-400');

        // Menampilkan konten yang sesuai
        toggleContent(filter);
      });
    });

    // Set tampilan default (IRS)
    const defaultButton = document.querySelector('.a[data-filter=".IRS"]');
    defaultButton.classList.add('bg-amber-400');
    toggleContent('IRS');
  });
</script>

</html>
@endsection