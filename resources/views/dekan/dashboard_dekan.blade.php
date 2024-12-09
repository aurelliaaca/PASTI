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
            <div class="grid grid-cols-1 gap-4 w-full items-center">
              <!-- pie chart -->
                <div class="col-span-1 text-white rounded-lg flex p-4 flex-row justify-center">
                    <div class="flex-col">
                    <h2 class="text-center font-semibold text-xl items-center">Persetujuan Ruangan</h2>
                    <canvas id="myPieChart1" class="text-sm p-1"></canvas>
                    </div>
                    <div class="flex-col">  
                    <h2 class="text-center font-semibold text-xl items-center">Persetujuan Jadwal</h2>
                    <canvas id="myPieChart2" class="text-xs p-1"></canvas>
                    </div>
                        
                </div>

                
          <div class="col-span-3 bg-teal-900 text-white p-4 rounded-lg">
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
          </div>
          </div>
          <!-- Container for Centered Buttons -->
          <div class="col-span-3 flex justify-center space-x-4 mt-4">
              <!-- Persetujuan Ruangan Button -->
              <a href="{{ route('persetujuanruangan') }}" class="bg-yellow-500 text-white px-8 py-5 rounded-lg flex items-center space-x-2 hover:bg-yellow-600">
                <i class="fa fa-city text-3xl"></i>
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
    
        // Data untuk pie chart pertama
        const data1 = {
            labels: ['Sudah Disetujui', 'Menunggu Persetujuan', 'Belum Disetujui'],
            datasets: [{
                data: [{{ $sudahDisetujui }}, {{ $menungguPersetujuan }}, {{ $belumDisetujui }}],
                backgroundColor: ['#14B8A6', '#FFBB1C', '#FF0000'],
                borderWidth: 0,
            }]
        };

        const config1 = {
            type: 'pie',
            data: data1,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        };

        // Create the first pie chart
        const ctx1 = document.getElementById('myPieChart1').getContext('2d');
        const myPieChart1 = new Chart(ctx1, config1);

        // Data untuk pie chart kedua
        const data2 = {
            labels: ['Sudah Disetujui', 'Menunggu Persetujuan', 'Belum Disetujui'],
            datasets: [{
                data: [{{ $sudahDisetujui1 }}, {{ $menungguPersetujuan1 }}, {{ $belumDisetujui1 }}],
                backgroundColor: ['#14B8A6', '#FFBB1C', '#FF0000'],
                borderWidth: 0,
            }]
        };

        const config2 = {
            type: 'pie',
            data: data2,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        };

        // Create the second pie chart
        const ctx2 = document.getElementById('myPieChart2').getContext('2d');
        const myPieChart2 = new Chart(ctx2, config2);
    </script>
</body>
</html>
@endsection