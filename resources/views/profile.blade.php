@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: linear-gradient(to right, #02979D, #FFBB1C);
            background-size: cover;
            background-repeat: repeat;
            height: max-content;
            margin: 0;
        }    </style>
</head>
<body class="min-h-screen">
<div class="grid grid-cols-5 gap-4">
    <div class="col-span-1 bg-teal-900 text-white p-4 rounded-lg">
        <div class="flex justify-center items-center">
            <img alt="Profile Picture" class="border rounded-lg" src="{{ asset('image/foto.jpg') }}" width="80%" height="80%"/>
        </div>
        <div class="items-center p-0">
            <p class="text-center text-lg font-semibold mt-1">Diana Putri Anggraeni</p>
            <p class="text-center text-sm mt-0">24060122140123</p>
        </div>
    </div>
    <div class="col-span-2 bg-teal-900 text-white p-4 rounded-lg">
    <div class="items-center">
        <p class="text-center font-semibold text-xl">IDENTITAS PRIBADI</p>
    </div>
    <div class="space-y-2"> <!-- Menambahkan space antar baris -->
        <div class="flex">
            <p class="w-[180px] font-semibold">Nama Lengkap</p>
            <p class="font-semibold">:</p>
            <p class="flex-1 text-justify ml-1">Diana Putri Anggraeni</p>
        </div>
        <div class="flex">
            <p class="w-[180px] font-semibold">NIM</p>
            <p class="font-semibold">:</p>
            <p class="flex-1 text-justify ml-1">24060122140123</p>
        </div>
        <div class="flex">
            <p class="w-[180px] font-semibold">Tanggal Lahir</p>
            <p class="font-semibold">:</p>
            <p class="flex-1 text-justify ml-1">10 Juli 2003</p>
        </div>
        <div class="flex">
            <p class="w-[180px] font-semibold">NIK</p>
            <p class="font-semibold">:</p>
            <p class="flex-1 text-justify ml-1">3276011007030002</p>
        </div>
        <div class="flex">
            <p class="w-[180px] font-semibold">Nama Ibu</p>
            <p class="font-semibold">:</p>
            <p class="flex-1 text-justify ml-1">Rina Hartati</p>
        </div>
        <div class="flex">
            <p class="w-[180px] font-semibold">Kode Kewarganegaraan</p>
            <p class="font-semibold">:</p>
            <p class="flex-1 text-justify ml-1">ID</p>
        </div>
    </div>
</div>

    <div class="col-span-2 bg-teal-900 text-white p-4 rounded-lg">
    <div class="items-center">
        <p class="text-center font-semibold text-xl">KONTAK DAN PENDIDIKAN</p>
    </div>
    <div class="space-y-2"> <!-- Menambahkan space antar baris -->
        <div class="flex">
            <p class="w-[180px] font-semibold">Nomor HP</p>
            <p class="font-semibold">:</p>
            <p class="flex-1 text-justify ml-1">085712345678</p>
        </div>
        <div class="flex">
            <p class="w-[180px] font-semibold">Email SSO</p>
            <p class="font-semibold">:</p>
            <p class="flex-1 text-justify ml-1 break-words">diana@students.undip.ac.id</p>
        </div>
        <div class="flex">
            <p class="w-[180px] font-semibold">Email Pribadi</p>
            <p class="font-semibold">:</p>
            <p class="flex-1 text-justify ml-1">dianaputra@gmail.com</p>
        </div>
        <div class="flex">
            <p class="w-[180px] font-semibold">Fakultas</p>
            <p class="font-semibold">:</p>
            <p class="flex-1 text-justify ml-1">Sains dan Matematika</p>
        </div>
        <div class="flex">
            <p class="w-[180px] font-semibold">Prodi</p>
            <p class="font-semibold">:</p>
            <p class="flex-1 text-justify ml-1">Informatika S1</p>
        </div>
        <div class="flex">
            <p class="w-[180px] font-semibold">Angkatan</p>
            <p class="font-semibold">:</p>
            <p class="flex-1 text-justify ml-1">2022</p>
        </div>
    </div>
    </div>
</div>

</body>
</html>
@endsection
