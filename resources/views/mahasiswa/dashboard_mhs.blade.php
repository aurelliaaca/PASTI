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
    <!-- Menambahkan alert sukses -->
    @if(session('success'))
        <div id="alert" class="alert alert-success bg-green-500 text-white p-4 rounded-lg mb-4">
            <strong>Success!</strong> {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('alert').style.display = 'none';
            }, 3000);
        </script>
    @endif
<!-- Main Content Section -->
<div class="bg-teal-800/80 p-4 flex items-center justify-between rounded-xl">
    <div class="flex items-center w-full">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
        
            <!-- Left Section (Profile) -->
            @foreach ($mahasiswas as $mhs)
            <div class="col-span-1 bg-teal-900 text-white p-4 rounded-lg">
                <div class="flex flex-col items-center">
                    <img alt="Profile Picture" class="rounded-full mb-4" src="{{ asset('image/profil.png') }}" width="100" height="100"/>
                    <h2 class="text-center text-lg font-semibold mb-2">Profil</h2>
                    <div class="text-left w-full">
                        <div class="space-y-2">
                            <div class="flex">
                                <p class="w-[140px] font-semibold">NAMA</p>
                                <p class="w-[20px] font-semibold">:</p>
                                <p class="w-full text-justify">{{ $mhs->nama }}</p>
                            </div>
                            <div class="flex">
                                <p class="w-[140px] font-semibold">NIM</p>
                                <p class="w-[20px] font-semibold">:</p>
                                <p class="w-full">{{ $mhs->nim }}</p>                                                                                                                                     
                            </div>
                            <div class="flex">
                                <p class="w-[140px] font-semibold">EMAIL</p>
                                <p class="w-[20px] font-semibold">:</p>
                                <p class="w-full">{{ $mhs->email }}</p>
                            </div>
                            <div class="flex">
                                <p class="w-[140px] font-semibold">NO. TELP</p>
                                <p class="w-[20px] font-semibold">:</p>
                                <p class="w-full">{{ $mhs->telp }}</p>
                            </div>
                            <div class="flex">
                                <p class="w-[140px] font-semibold">PRODI</p>
                                <p class="w-[20px] font-semibold">:</p>
                                <p class="w-full">{{ $mhs->prodi }}</p>
                            </div>
                            <div class="col-span-1 bg-white p-[0.5px] rounded-lg"></div>
                            <div class="col-span-2 text-white flex items-center p-0 pt-1 w-full rounded-lg">
                                <div class="flex flex-grow justify-center items-center flex-col">
                                    <p class="font-semibold text-center">IPK</p>
                                    <p class="font-semibold text-center text-2xl">{{ $mhs->IPK }}</p>
                                </div>
                                <div class="flex flex-grow justify-center items-center flex-col">
                                    <p class="font-semibold text-center">SKS</p>
                                    <p class="font-semibold text-center text-2xl">{{ $currentSKS }}</p>
                                </div>
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
                <!-- IRS Button -->
                <a href="{{ route('Pengisian_IRS') }}" class="bg-yellow-500 text-white px-16 py-5 rounded-lg flex items-center space-x-2">
                    <i class="far fa-file-alt text-3xl"></i>
                    <span class="text-2xl">IRS</span>
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
@endsection