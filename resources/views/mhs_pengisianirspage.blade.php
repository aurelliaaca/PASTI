@extends('layouts.app')

@section('title', 'PengisianIRS')

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
    <!-- Existing header and navigation remains the same -->
    <!-- Header dengan Tombol -->
    <div class="flex w-full mb-4">
      <button class="btn flex-1 bg-amber-400 text-white p-2 rounded-tl-xl rounded-bl-xl shadow-sm hover:bg-orange-400 whitespace-nowrap flex justify-center items-center" data-filter=".BuatIRS">
        <span class="font-semibold italic text-center">Buat IRS</span>
      </button>
      <button class="btn flex-1 bg-teal-700 text-white p-2 rounded-tr-xl rounded-br-xl shadow-sm hover:bg-orange-400 whitespace-nowrap flex justify-center items-center" data-filter=".IRS">
        <span class="font-semibold italic text-center">IRS</span>
      </button>
    </div>
    
    <div class="BuatIRS">
    <!-- Main Content Section -->
    <div class="flex justify-center grid grid-cols-8 gap-4 w-full">
        <!-- Left Section (Profile) -->
        <div class="col-span-2 bg-teal-800/0">
        <div class="col-span-2 bg-teal-800/80 text-white p-4 rounded-lg flex flex-col space-y-4">
            <!-- Existing profile information remains the same -->
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

            <div class="w-full h-px bg-white rounded-lg"></div>

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

            <div class="w-full mt-4">
                <select id="matkul-dropdown" class="w-full p-4 rounded bg-white text-teal-800 text-xs">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matkul as $mk)
                        <option value="{{ $mk->kode }}" data-name="{{ $mk->nama }}" data-sks="{{ $mk->sks }}">{{ $mk->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div id="selected-matkul" class="w-full mt-4">
                <!-- Info for selected courses will be added dynamically here -->
            </div>

            <div class="grid grid-cols-2 w-full flex space-x-2">
                <button id="reset-btn" class="bg-white text-teal-700 p-2 rounded-lg items-center space-x-2">
                    <span class="text-base font-semibold italic">RESET</span>
                </button>
                <button id="ajukan-btn" class="bg-amber-400 text-white p-2 rounded-lg items-center space-x-2">
                    <span class="text-base font-semibold italic">AJUKAN</span>
                </button>
            </div>
        </div>
        </div>
        
    
        <!-- Tabel Jadwal -->
        <div class="col-span-6">
            <div class="bg-teal-800/80 text-teal-900 p-4 rounded-lg">
                <div class="overflow-x-auto rounded-lg">
                    <table class="table-auto w-full text-center rounded-lg border-collapse">
                        <thead>
                            <tr class="bg-teal-100/80">
                                <th class="px-4 py-2 border-r border-teal-500">Nama Mata Kuliah</th>
                                <th class="px-4 py-2 border-r border-teal-500">Kode</th>
                                <th class="px-4 py-2 border-r border-teal-500">SKS</th>
                                <th class="px-4 py-2 border-r border-teal-500">Hari</th>
                                <th class="px-4 py-2 border-r border-teal-500">Jam</th>
                                <th class="px-4 py-2 border-r border-teal-500">Kelas</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="jadwalTableBody">
                        <!-- Jadwal akan ditampilkan di sini setelah pemilihan mata kuliah -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    </div>

    <div class="IRS">
    <div class="flex justify-center grid grid-cols-8 gap-4 w-full">
        <!-- Left Section (Profile) -->
        <div class="col-span-2 bg-teal-800/0"></div>
    </div>
    </div>

  <script>

document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.btn');
            const sections = document.querySelectorAll('.buatIRS, .IRS');

            function toggleContent(filter) {
                sections.forEach(section => {
                    section.style.display = 'none';
                });

                const activeSection = document.querySelector(filter);
                if (activeSection) {
                    activeSection.style.display = 'block';
                }
            }

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    const filter = this.getAttribute('data-filter');

                    buttons.forEach(btn => {
                        btn.classList.remove('bg-amber-400');
                        btn.classList.add('bg-teal-700');
                    });

                    this.classList.remove('bg-teal-700');
                    this.classList.add('bg-amber-400');

                    toggleContent(filter);
                });
            });

            const defaultButton = document.querySelector('.btn[data-filter=".buatIRS"]');
            if (defaultButton) {
                defaultButton.classList.add('bg-amber-400');
                toggleContent('.buatIRS');
            }
        });
        
  document.getElementById('matkul-dropdown').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const courseId = this.value;
    const courseName = selectedOption.getAttribute('data-name');
    const courseSks = selectedOption.getAttribute('data-sks');
    const jadwalTableBody = document.getElementById('jadwalTableBody');

    // Periksa jika nilai kursus tidak kosong (berarti kursus dipilih)
    if (courseId && courseName) {
        const selectedMatkulDiv = document.createElement('div');
        selectedMatkulDiv.classList.add('flex', 'items-center', 'bg-teal-500', 'p-2', 'rounded', 'mb-2');
        selectedMatkulDiv.id = `course-${courseId}`;

        selectedMatkulDiv.innerHTML = `
            <div class="flex-grow overflow-hidden break-words">
                <p class="text-[12px] text-justify">${courseName}</p>
            </div>
            <div class="flex items-center justify-end min-w-[120px] max-w-[120px]">
                <p class="text-[12px] text-right font-semibold pr-2">${courseId} (${courseSks} SKS)</p>
            </div>
        `;
        document.getElementById('selected-matkul').appendChild(selectedMatkulDiv);

        // Cek apakah jadwal untuk mata kuliah yang dipilih sudah ada di tabel
        const existingRow = document.querySelector(`#jadwalTableBody .row-${courseId}`);

        // Jika sudah ada, jangan tambah lagi (untuk menghindari duplikasi)
        if (!existingRow) {
            // Filter jadwal yang sesuai dengan kode mata kuliah
            fetch(`/get-jadwal-mk/${courseId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        // Iterasi data jadwal dan tambahkan ke dalam tabel
                        data.forEach(jadwal => {
                            // Buat elemen row baru
                            const row = document.createElement('tr');
                            row.classList.add('bg-white', `row-${courseId}`);  // Menambahkan kelas unik untuk setiap mata kuliah

                            row.innerHTML = `
                                <td class="border px-4 py-2">${jadwal.matkul.nama}</td>
                                <td class="border px-4 py-2">${jadwal.kodemk}</td>
                                <td class="border px-4 py-2">${jadwal.matkul.sks}</td>
                                <td class="border px-4 py-2">${jadwal.hari}</td>
                                <td class="border px-4 py-2">${jadwal.jam_mulai}</td>
                                <td class="border px-4 py-2">${jadwal.kelas}</td>
                                <td class="border px-4 py-2">
                                    <button class="bg-teal-500 text-white px-4 py-1 rounded">Pilih</button>
                                </td>
                            `;
                            // Tambahkan baris ke tabel
                            jadwalTableBody.appendChild(row);
                        });
                    } else {
                        // Tampilkan pesan jika tidak ada jadwal
                        const row = document.createElement('tr');
                        row.classList.add(`row-${courseId}`);
                        row.innerHTML = '<td colspan="7">Jadwal tidak ditemukan</td>';
                        jadwalTableBody.appendChild(row);
                    }
                })
                .catch(error => {
                    console.error('Error fetching jadwal:', error);
                    // Tampilkan pesan error jika ada masalah saat mengambil data jadwal
                    const row = document.createElement('tr');
                    row.classList.add(`row-${courseId}`);
                    row.innerHTML = '<td colspan="7">Terjadi kesalahan saat mengambil data jadwal.</td>';
                    jadwalTableBody.appendChild(row);
                });
        }
    }
});
        </script> 
</body>
</html>
@endsection