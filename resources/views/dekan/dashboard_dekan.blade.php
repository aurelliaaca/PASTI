@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<body class="min-h-screen bg-cover bg-center">
  <div class="main-container">
      <!-- Main Content Section -->
      <div class="flex justify-center items-center bg-teal-800 bg-opacity-80 p-4 rounded-lg shadow-lg w-full">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
          
          <!-- Left Section (Profile) -->
          @foreach ($dekans as $dekan)
        <div class="col-span-1 bg-teal-900 text-white p-4 rounded-lg">
            <div class="flex flex-col items-center">
            <img alt="Profile Picture" class="rounded-full mb-4" src="{{ asset('image/profil.png') }}" width="100" height="100"/>
            <h2 class="text-center text-lg font-semibold mb-2">Profil</h2>
            <div class="text-left w-full">
                <div class="space-y-2">
                <div class="flex">
                    <p class="w-[140px] font-semibold">NAMA</p>
                    <p class="w-[20px] font-semibold">:</p>
                    <p class="w-full text-justify">{{  $dekan->dosen->nama }}</p>
                </div>
                <div class="flex">
                    <p class="w-[140px] font-semibold">NIP</p>
                    <p class="w-[20px] font-semibold">:</p>
                    <p class="w-full">{{ $dekan->nip }}</p>                                                                                                                                     
                </div>
                <div class="flex">
                    <p class="w-[140px] font-semibold">EMAIL</p>
                    <p class="w-[20px] font-semibold">:</p>
                    <p class="w-full">{{  $dekan->dosen->email }}</p>
                </div>
                <div class="flex">
                    <p class="w-[140px] font-semibold">NO. TELP</p>
                    <p class="w-[20px] font-semibold">:</p>
                    <p class="w-full">{{  $dekan->dosen->telp }}</p>
                </div>
                <div class="flex">
                    <p class="w-[140px] font-semibold">FAKULTAS</p>
                    <p class="w-[20px] font-semibold">:</p>
                    <p class="w-full">{{ $dekan->fakultas }}</p>
                </div>
                </div>
            </div>
            </div>
        </div>
        @endforeach
          
          <!-- Right Section (Notifications) -->
          <div class="col-span-2 bg-teal-900 text-white p-4 rounded-lg">
                <div class="space-y-2">
                    <div class="bg-teal-800 p-4 rounded-lg flex justify-between items-center">
                        <div>
                            <i class="far fa-envelope text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-left pl-3.5 pr-4">Notifikasi</p>
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
              <!-- Persetujuan Ruangan Button -->
              <a href="{{ route('persetujuanruangan') }}" class="bg-yellow-500 text-white px-8 py-5 rounded-lg flex items-center space-x-2 hover:bg-yellow-600">
                <i class="fa fa-building text-3xl"></i>
                <span class="text-2xl">Persetujuan Alokasi Ruangan</span>
            </a>

              <!-- Persetujuan Jadwal Button -->
              <a href="{{ route('persetujuanjadwal') }}" class="bg-yellow-500 text-white px-8 py-5 rounded-lg flex items-center space-x-2 hover:bg-yellow-600">
                  <i class="fa fa-book text-3xl"></i>
                  <span class="text-2xl">Persetujuan Jadwal</span>
              </a>
          </div>

      </div>
    </div>
  </div>
  <script>
    
  const data = {
            labels: ['Belum Disetujui', 'Sudah Disetujui'], // Categories
            datasets: [{
                label: 'Approval Status',
                data: [40, 60], // 40% not approved, 60% approved
                backgroundColor: ['#14B8A6', '#FFBB1C'], // Teal for not approved, Amber for approved
                hoverOffset: 4,
                borderWidth: 0, // Remove stroke/border
            }]
        };

        const config = {
            type: 'pie', // Pie chart type
            data: data,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: 'white' // Make legend labels white
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                // Make tooltip label text white
                                return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        };

        // Create the pie chart
        const ctx = document.getElementById('myPieChart').getContext('2d');
        const myPieChart = new Chart(ctx, config);
    </script>
</body>
</html>
@endsection