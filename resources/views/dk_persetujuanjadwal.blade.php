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
                <h1 class="text-xl font-semibold text-teal-800 mb-0">PERSETUJUAN ALOKASI JADWAL</h1>
            </div>

            <!-- Tabel -->
            <!-- Tabel -->
            <div class="border rounded-md pl-2 pr-2">
                <div class="table-container">
                    <table class="table w-full text-teal-800 font-teal-800 flex items-center font-semibold">
                        <tbody>
                        @foreach ($prodis as $prodi)
                        <tr class="border-b">
                            <td class="pb-2 pt-2">
                                <button class="toggle-button btn btn-primary bg-teal-500 text-white w-10 py-2 rounded-lg mr-2" data-id="{{ $prodi->kodeprodi }}" onclick="toggleApproveButton(this)">+</button>
                                {{ $prodi->namaprodi }} <!-- Menampilkan nama Prodi -->
                            </td>
                            <td class="pb-2 pt-2 text-right button-container">
                                <button class="btn bg-teal-500 btn-icon-text p-2 rounded-lg" id="approveBtn-{{ $prodi->kodeprodi }}" style="display: none;" onclick="approveAll({{ $prodi->kodeprodi }})">
                                    <i class="fa fa-check mr-1 ml-1 text-white"></i>
                                    <strong class="text-white">Setujui Semua</strong>
                                </button>
                            </td>
                        </tr>

                        <!-- Menampilkan Jadwal Mata Kuliah berdasarkan kodeprodi -->
                        <tr class="course-table" id="courses-{{ $prodi->kodeprodi }}" style="display: none;">
                            <td colspan="4">
                            <div class="py-2">
                                <div class="border rounded-md">
                                    <div class="table-responsive table-striped">
                                        <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse">
                                            <thead>
                                                <tr>
                                                    <th class="font-semibold" style="width: 5%;">Semester</th>
                                                    <th class="font-semibold" style="width: 20%;">Nama Mata Kuliah</th>
                                                    <th class="font-semibold" style="width: 5%;">Kelas</th>
                                                    <th class="font-semibold" style="width: 5%;">SKS</th>
                                                    <th class="font-semibold" style="width: 5%;">Hari</th>
                                                    <th class="font-semibold" style="width: 10%;">Jam</th>
                                                    <th class="font-semibold" style="width: 15%;">Dosen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($jadwals->where('kodeprodi', $prodi->kodeprodi) as $jadwal)
                                                <tr id="jadwal_{{ $jadwal->jadwalid }}" class="odd:bg-teal-800/10 even:bg-white">
                                                    <td class="py-3 font-normal">{{ $jadwal->matkul->semester }}</td>
                                                    <td class="py-3 font-normal">{{ $jadwal->matkul->nama }}</td>
                                                    <td class="py-3 font-normal">{{ $jadwal->kelas }}</td>
                                                    <td class="py-3 font-normal">{{ $jadwal->matkul->sks }} SKS</td>
                                                    <td class="py-3 font-normal">{{ $jadwal->hari }}</td>
                                                    <td class="py-3 font-normal">{{ $jadwal->jam_mulai }}</td>
                                                    <td class="py-3 font-normal pl-2">{{ $jadwal->pengampu1 }} / {{ $jadwal->pengampu2 }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </td>
                        </tr>
                        @endforeach
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
                const approveButton = document.getElementById(`approveBtn-${id}`);

                // Toggle visibility of course table and approve button
                if (table.style.display === 'none' || table.style.display === '') {
                    table.style.display = 'table-row';
                    approveButton.style.display = 'inline-block';
                    this.textContent = '-';
                } else {
                    table.style.display = 'none';
                    approveButton.style.display = 'none';
                    this.textContent = '+';
                }
            });
        });
    });

    function approveAll(id) {
        alert(`Semua jadwal di ${id === 0 ? 'INFORMATIKA' : 'BIOLOGI'} telah disetujui!`);
        // Lakukan aksi lain yang perlu dilakukan ketika tombol Setujui Semua diklik
    }
</script>

</body>
</html>
@endsection
