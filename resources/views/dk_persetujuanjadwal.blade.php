@extends('layouts.app')

@section('title', 'Persetujuan Jadwal')

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
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="bg-white shadow-lg rounded-lg">
        <div id="content-jadwal" class="p-4">
            <!-- Header dan Tombol -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-semibold text-teal-800 mb-0">JADWAL</h1>
                <div class="flex items-center">
                    <button class="btn bg-teal-500 btn-icon-text p-2 rounded-lg" onclick="addRow()">
                        <i class="fa fa-check mr-1 ml-1 text-white"></i>
                        <strong class="text-white">Setujui Semua</strong>
                    </button>
                </div>
            </div>

            <!-- Tabel -->
            <div class="border rounded-md p-2">
                <div class="table-responsive">
                    <table class="table table-striped w-full text-teal-800 font-black">
                        <tbody>
                            <tr>
                                <td class="pb-2 pt-0">
                                    <button class="toggle-button btn btn-primary bg-teal-500 text-white w-10 py-2 rounded-lg mr-1" data-id="0">+</button>
                                    INFORMATIKA
                                </td>
                            </tr>
                            <tr class="course-table" id="courses-0" style="display: none;">
                                <td colspan="4">
                                    <div class="border rounded-md">
                                        <div class="table-responsive p-2 table-striped">
                                            <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse">
                                                <thead>
                                                    <tr>
                                                        <th class="font-normal" style="width: 5%;">Semester</th>
                                                        <th class="font-normal" style="width: 20%;">Nama Mata Kuliah</th>
                                                        <th class="font-normal" style="width: 10%;">Kelas</th>
                                                        <th class="font-normal" style="width: 10%;">SKS</th>
                                                        <th class="font-normal" style="width: 10%;">Hari</th>
                                                        <th class="font-normal" style="width: 10%;">Jam</th>
                                                        <th class="font-normal items-center" style="width: 5%;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="jadwalTableBody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="pb-2 pt-2">
                                    <button class="toggle-button btn btn-primary bg-teal-500 text-white w-10 py-2 rounded-lg mr-1" data-id="1">+</button>
                                    BIOLOGI
                                </td>
                            </tr>
                            <tr class="course-table" id="courses-1" style="display: none;">
                                <td colspan="4">
                                    <div class="border rounded-md">
                                        <div class="table-responsive p-2 table-striped">
                                            <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse">
                                                <thead>
                                                    <tr>
                                                        <th class="font-normal" style="width: 5%;">Semester</th>
                                                        <th class="font-normal" style="width: 20%;">Nama Mata Kuliah</th>
                                                        <th class="font-normal" style="width: 10%;">Kelas</th>
                                                        <th class="font-normal" style="width: 10%;">SKS</th>
                                                        <th class="font-normal" style="width: 10%;">Hari</th>
                                                        <th class="font-normal" style="width: 10%;">Jam</th>
                                                        <th class="font-normal items-center" style="width: 5%;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="jadwalTableBody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.toggle-button');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const table = document.getElementById(`courses-${id}`);

                if (table.style.display === 'none' || table.style.display === '') {
                    table.style.display = 'table-row';
                    this.textContent = '-';
                } else {
                    table.style.display = 'none';
                    this.textContent = '+';
                }
            });
        });
    });
</script>
</body>
</html>
@endsection
