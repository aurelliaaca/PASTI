@extends('layouts.app')

@section('title', 'PengisianIRS')

@section('content')
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
    <button class="btn flex-1 bg-amber-400 text-white p-2 rounded-tl-xl rounded-bl-xl border-r border-teal-500 shadow-sm hover:bg-orange-400" data-filter="BuatIRS">
        <span class="font-semibold italic text-center">Buat IRS</span>
    </button>
    <button class="btn flex-1 bg-teal-700 text-white p-2 shadow-sm hover:bg-orange-400" data-filter="IRS">
        <span class="font-semibold italic text-center">IRS</span>
    </button>
    <button class="btn flex-1 bg-teal-700 text-white p-2 rounded-tr-xl border-l border-teal-500 rounded-br-xl shadow-sm hover:bg-orange-400" data-filter="HistoriIRS">
        <span class="font-semibold italic text-center">Histori IRS</span>
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
                    <p class="text-sm align-middle text-justify w-full">{{ $mahasiswa->nama }}</p>
                </div>
                <div class="flex">
                    <p class="text-sm align-top w-[100px] font-semibold">NIM</p>
                    <p class="text-sm align-top w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">{{ $mahasiswa->nim }}</p>
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
                        <p class="text-sm align-middle w-full">
                            @if($mahasiswa->smt % 2 == 1)
                                Ganjil
                            @else
                                Genap
                            @endif
                        </p>
                    </div>
                <div class="flex">
                    <p class="text-sm align-top w-[300px] font-semibold">SEMESTER</p>
                    <p class="text-sm align-top  w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">{{ $mahasiswa->smt }}</p>
                </div>
                <div class="flex">
                    <p class="text-sm align-top  w-[300px] font-semibold">IPK</p>
                    <p class="text-sm align-top  w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">{{ $mahasiswa->IPK }}</p>
                </div>
                <div class="flex">
                    <p class="text-sm align-top w-[300px] font-semibold">IPS</p>
                    <p class="text-sm align-top w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">{{ $mahasiswa->IPS_Sebelumnya }}</p>
                </div>
                <div class="flex">
                    <p class="text-sm align-top w-[300px] font-semibold">MAX BEBAN SKS</p>
                    <p class="text-sm align-top w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">{{ $sksMax }}</p>
                </div>
                <div class="flex">
                    <p class="text-sm align-top w-[300px] font-semibold">SKS TERPILIH</p>
                    <p class="text-sm align-top w-[20px] font-semibold">:</p>
                    <p id="sksTerpilih" class="text-sm align-middle w-full">{{ $sksTerpilih }}</p>
                </div>
                <div class="flex justify-between text-center items-center pt-2">
                    <h1 class="text-xl font-semibold text-white mb-0 bg-teal-500 rounded p-2 w-full">{{ $periodeAktif }}</h1>
                </div>
                </div>
            </div>

            <!-- <div class="w-full mt-4">
                <select id="matkul-dropdown" class="w-full p-4 rounded bg-white text-teal-800 text-xs">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matkul as $mk)
                        <option value="{{ $mk->kode }}" data-name="{{ $mk->nama }}" data-sks="{{ $mk->sks }}">{{ $mk->nama }}</option>
                    @endforeach
                </select>
            </div> -->

            <!-- <div id="selected-matkul" class="w-full mt-4"> -->
                <!-- Info for selected courses will be added dynamically here -->
            <!-- </div> -->
        </div>
        </div>
    
    
        <!-- Tabel Jadwal -->
        <!-- <div class="col-span-6">
            <div class="bg-teal-800/80 text-teal-900 p-4 rounded-lg">
                <div class="overflow-x-auto rounded-lg">
                    <table class="table-auto w-full text-center rounded-lg border-collapse">
                        <thead>
                            <tr class="bg-teal-100/80">
                            <th class="px-4 py-2 border-r border-teal-500"style="width: 5%;">Jam</th>
                            <th class="px-4 py-2 border-r border-teal-500"style="width: 15.8%;">Senin</th>
                                <th class="px-4 py-2 border-r border-teal-500"style="width: 15.8%;">Selasa</th>
                                <th class="px-4 py-2 border-r border-teal-500"style="width: 15.8%;">Rabu</th>
                                <th class="px-4 py-2 border-r border-teal-500"style="width: 15.8%;">Kamis</th>
                                <th class="px-4 py-2 border-r border-teal-500"style="width: 15.8%;">Jumat</th>
                                <th class="px-4 py-2"style="width: 15.8%;">Sabtu</th>
                            </tr>
                        </thead>
                        <tbody id="jadwalTableBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->
        <div class="col-span-6">
            <div class="bg-teal-800/80 text-teal-900 p-4 rounded-lg">
                <div class="overflow-x-auto rounded-lg">
                    @if(!$isPeriodePengisian)
                        <p class="text-center text-white">Akses pengisian IRS saat ini tidak tersedia.</p>
                    @else
                        <table class="table-auto w-full text-center rounded-lg border-collapse">
                            <thead>
                                <tr class="bg-teal-100/80">
                                    <th class="px-4 py-2 border-r border-teal-500" style="width: 5%;">Jam</th>
                                    <th class="px-4 py-2 border-r border-teal-500" style="width: 15.8%;">Senin</th>
                                    <th class="px-4 py-2 border-r border-teal-500" style="width: 15.8%;">Selasa</th>
                                    <th class="px-4 py-2 border-r border-teal-500" style="width: 15.8%;">Rabu</th>
                                    <th class="px-4 py-2 border-r border-teal-500" style="width: 15.8%;">Kamis</th>
                                    <th class="px-4 py-2 border-r border-teal-500" style="width: 15.8%;">Jumat</th>
                                    <th class="px-4 py-2" style="width: 15.8%;">Sabtu</th>
                                </tr>
                            </thead>
                            <tbody id="jadwalTableBody">
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- IRS Content -->
  <div class="IRS" style="display: none;">
    <div class="bg-white shadow-lg rounded-lg">
        <div id="content-jadwal" class="p-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-semibold text-teal-800 mb-0">ISIAN RENCANA MAHASISWA</h1>
                    <div class="flex items-center gap-2">
                        <button id="reset-btn" class="bg-amber-400 text-white p-2 px-4 rounded-lg">
                            <span class="text-base font-semibold italic">RESET</span>
                        </button>
                        <button id="ajukan-btn" class="bg-teal-600 text-white p-2 px-4 rounded-lg">
                            <span class="text-base font-semibold italic">AJUKAN</span>
                        </button>
                        <button id="perubahan-btn" class="bg-teal-600 text-white p-2 px-4 rounded-lg">
                            <span class="text-base font-semibold italic">AJUKAN PERUBAHAN</span>
                        </button>
                    </div>
                </div>
            <div class="border rounded-md">
                <div class="table-responsive p-2 table-striped">
                <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse">
                    <thead>
                        <tr>
                        <th class="font-bold px-4 py-2" style="width: 10%;">Hari</th>
                        <th class="font-bold px-4 py-2" style="width: 20%;">Nama Mata Kuliah</th>
                        <th class="font-bold px-4 py-2" style="width: 10%;">Kode</th>
                        <th class="font-bold px-4 py-2" style="width: 7%;">SMT</th>
                        <th class="font-bold px-4 py-2" style="width: 7%;">SKS</th>
                        <th class="font-bold px-4 py-2" style="width: 10%;">Jam</th>
                        <th class="font-bold px-4 py-2" style="width: 7%;">Kelas</th>
                        <th class="font-bold px-4 py-2" style="width: 10%;">Ruangan</th>
                        <th class="font-bold px-4 py-2" style="width: 10%;">Status</th>
                        <th class="font-bold px-4 py-2" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="irsTableBody">
                            @php
                                // Array urutan hari dari Senin hingga Sabtu
                                $hariUrutan = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

                                // Grouping irsTable by 'hari'
                                $groupedByHari = $irsTable->groupBy('hari');

                                // Urutkan grup berdasarkan hari sesuai urutan yang diinginkan
                                $groupedByHari = $groupedByHari->sortBy(function ($value, $key) use ($hariUrutan) {
                                    return array_search($key, $hariUrutan);
                                });
                            @endphp

                            @foreach ($groupedByHari as $hari => $irsList)
                                @foreach ($irsList as $index => $irs)
                                    <tr class="bg-white">
                                        @if ($index == 0)
                                            <!-- Rowspan untuk Hari -->
                                            <td rowspan="{{ count($irsList) }}" class="border px-4 py-2">{{ $hari }}</td>
                                        @endif
                                        <!-- Data untuk mata kuliah -->
                                        <td class="border px-4 py-2">{{ $irs->nama }}</td>
                                        <td class="border px-4 py-2">{{ $irs->kodemk }}</td>
                                        <td class="border px-4 py-2">{{ $irs->smt }}</td>
                                        <td class="border px-4 py-2">{{ $irs->sks }}</td>
                                        <td class="border px-4 py-2">{{ $irs->jam_mulai }}</td>
                                        <td class="border px-4 py-2">{{ $irs->kelas }}</td>
                                        <td class="border px-4 py-2">{{ $irs->namaruang }}</td>
                                        <td class="border px-4 py-2">{{ $irs->status_verifikasi }}</td>
                                        <td class="border px-4 py-2">
                                        <button class="hapus-btn bg-teal-600 text-white p-2 px-4 rounded-lg" data-jadwalid="{{ $irs->jadwalid }}">
                                            <span class="text-base font-semibold italic">Hapus</span>
                                        </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="HistoriIRS" style="display: none;">
  <div class="bg-white shadow-lg rounded-lg">
        <div class="p-4">

            <!-- Header dan Tombol -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-semibold text-teal-800 mb-0">Histori IRS</h1>
            </div>

            <!-- Tabel -->
            <div class="border rounded-md p-2">
                <div class="table-responsive">
                    <table class="table table-striped w-full text-teal-800 font-black">
                        <tbody>
                            @php
                                // Mengurutkan irsBySemester berdasarkan kunci semester (smt) sebagai integer
                                $sortedIrsBySemester = $irsBySemester->sortKeysUsing(function($key1, $key2) {
                                    return intval($key1) <=> intval($key2);
                                });
                            @endphp

                            @foreach($sortedIrsBySemester as $smt => $irs)
                        <tr>
                            <td class="pb-0 pt-0">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <button class="toggle-button bg-teal-500 text-white w-10 py-2 mb-2 rounded-lg mr-1" data-id="{{ $smt }}" onclick="toggleSetujui('{{ $smt }}')">+</button>
                                        Semester {{ ucfirst($smt) }}
                                    </div>
                                    <button id="cetak-btn" class="items-center bg-amber-400 text-white p-2 px-4 rounded-lg" data-id="{{ $smt }}" style="display: none;">
                                        <span class="text-base font-semibold italic">CETAK IRS</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="irs-table" id="irs-{{ $smt }}" style="display: none;">
                            <td colspan="4">
                                <div class="py-2">
                                    <div class="border rounded-md">
                                        <div class="table-responsive table-striped">
                                            <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse ">
                                            <thead>
                                                <tr>
                                                <th class="font-bold px-4 py-2" style="width: 15%;">Hari</th>
                                                <th class="font-bold px-4 py-2" style="width: 25%;">Nama Mata Kuliah</th>
                                                <th class="font-bold px-4 py-2" style="width: 10%;">Kode</th>
                                                <th class="font-bold px-4 py-2" style="width: 7%;">SMT</th>
                                                <th class="font-bold px-4 py-2" style="width: 7%;">SKS</th>
                                                <th class="font-bold px-4 py-2" style="width: 10%;">Jam</th>
                                                <th class="font-bold px-4 py-2" style="width: 7%;">Kelas</th>
                                                <th class="font-bold px-4 py-2" style="width: 15%;">Ruangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    // Array urutan hari dari Senin hingga Sabtu
                                                    $hariUrutan = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

                                                    // Grouping irsTable by 'hari'
                                                    $groupedByHari = $irs->groupBy('hari');

                                                    // Urutkan grup berdasarkan hari sesuai urutan yang diinginkan
                                                    $groupedByHari = $groupedByHari->sortBy(function ($value, $key) use ($hariUrutan) {
                                                        return array_search($key, $hariUrutan);
                                                    });
                                                @endphp

                                                @foreach ($groupedByHari as $hari => $irsList)
                                                    @foreach ($irsList as $index => $myirs)
                                                        <tr class="bg-white">
                                                            @if ($index == 0)
                                                                <!-- Rowspan untuk Hari -->
                                                                <td rowspan="{{ count($irsList) }}" class="border px-4 py-2">{{ $hari }}</td>
                                                            @endif    
                                                            <td class="py-3 border font-normal text-left pl-2 justify-center">{{ $myirs->nama }}</td>
                                                            <td class="py-3 border font-normal">{{ $myirs->kodemk }}</td>
                                                            <td class="py-3 border font-normal">{{ $myirs->smt }}</td>
                                                            <td class="py-3 border font-normal">{{ $myirs->sks }}</td>
                                                            <td class="py-3 border font-normal">{{ $myirs->jam_mulai }}</td>
                                                            <td class="py-3 border font-normal">{{ $myirs->kelas }}</td>
                                                            <td class="py-3 border font-normal">{{ $myirs->namaruang }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
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
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.btn');
    const buatirsContent = document.querySelector('.BuatIRS');
    const irsContent = document.querySelector('.IRS');
    const historiirsContent = document.querySelector('.HistoriIRS');

    // Fungsi untuk mengatur tampilan konten
    function toggleContent(filter) {
      buatirsContent.style.display = 'none';
      irsContent.style.display = 'none';
      historiirsContent.style.display = 'none';

      if (filter === 'BuatIRS') {
        buatirsContent.style.display = 'block';
      } else if (filter === 'IRS') {
        irsContent.style.display = 'block';
      } else if (filter === 'HistoriIRS') {
        historiirsContent.style.display = 'block';
      }
    }

    buttons.forEach(button => {
      button.addEventListener('click', function() {
        const filter = this.getAttribute('data-filter');
        
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

    // Set tampilan default (BuatIRS)
    toggleContent('BuatIRS');
});

document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.toggle-button');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const table = document.getElementById(`irs-${id}`);
            const cetakButton = document.querySelector(`#cetak-btn[data-id="${id}"]`);

            // Toggle visibility of ruangan table and cetak button
            if (table.style.display === 'none' || table.style.display === '') {
                table.style.display = 'table-row';
                cetakButton.style.display = 'block'; // Tampilkan tombol cetak
                this.textContent = '-';
            } else {
                table.style.display = 'none';
                cetakButton.style.display = 'none'; // Sembunyikan tombol cetak
                this.textContent = '+';
            }
        });
    });

    // Event listener untuk tombol cetak
    const cetakButtons = document.querySelectorAll('#cetak-btn');
    cetakButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const contentToPrint = document.getElementById(`irs-${id}`).innerHTML;
            printContent(contentToPrint);
        });
    });
});

function printContent(content) {
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Cetak IRS</title>');
    printWindow.document.write('<style>');
    printWindow.document.write('body{font-family: Arial, sans-serif; margin: 5px;}');
    printWindow.document.write('table {width: 100%; border-collapse: collapse; margin-top: 20px;}');
    printWindow.document.write('th, td {font-size: 8px; border: 1px solid black; padding: 10px; text-align: center; font-size: 12px;}');
    printWindow.document.write('h1 {text-align: center; margin-bottom: 30px; font-size: 16px;}');
    printWindow.document.write('h2 {font-weight: normal; text-align: center; margin-bottom: 0px; font-size: 16px;}');
    printWindow.document.write('h3 {font-weight: normal; text-align: center; margin-top: 0px; font-size: 16px;}');
    printWindow.document.write('p {margin: 5px 0; font-size: 12px;}');
    printWindow.document.write('</style>');
    printWindow.document.write('</head><body>');
    
    // Tambahkan judul dan informasi mahasiswa
    printWindow.document.write('<h2>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</h2>');
    printWindow.document.write('<h3>FAKULTAS SAINS DAN MATEMATIKA UNIVERSITAS DIPONEGORO</h3>');
    printWindow.document.write('<h1>ISIAN RENCANA MAHASISWA</h1>');
    printWindow.document.write('<p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>');
    printWindow.document.write('<p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>');
    printWindow.document.write('<p><strong>Program Studi:</strong> {{ $mahasiswa->prodi }}</p>');
    
    // Tambahkan konten tabel
    printWindow.document.write(content);
    
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}

function updateIRSTable() {
    const nim = '{{ $mahasiswa->nim }}';
    fetch(`/get-irs-data/${nim}`)
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('irsTableBody');
            tbody.innerHTML = ''; // Bersihkan tabel

            // Kelompokkan data berdasarkan hari
            const groupedByHari = {};
            data.forEach(item => {
                if (!groupedByHari[item.hari]) {
                    groupedByHari[item.hari] = [];
                }
                groupedByHari[item.hari].push(item);
            });

            // Render data ke tabel
            Object.entries(groupedByHari).forEach(([hari, irsList]) => {
                irsList.forEach((irs, index) => {
                    const row = document.createElement('tr');
                    row.className = 'bg-white';
                    
                    let html = '';
                    if (index === 0) {
                        html += `<td rowspan="${irsList.length}" class="border px-4 py-2">${hari}</td>`;
                    }
                    
                    html += `
                        <td class="border px-4 py-2">${irs.nama}</td>
                        <td class="border px-4 py-2">${irs.kodemk}</td>
                        <td class="border px-4 py-2">${irs.sks}</td>
                        <td class="border px-4 py-2">${irs.jam_mulai}</td>
                        <td class="border px-4 py-2">${irs.kelas}</td>
                        <td class="border px-4 py-2">${irs.status_verifikasi}</td>
                    `;
                    
                    row.innerHTML = html;
                    tbody.appendChild(row);
                });
            });
        })
        .catch(error => console.error('Error:', error));
}

// Panggil fungsi update setiap kali ada perubahan
document.addEventListener('DOMContentLoaded', function() {
    // Update pertama kali saat halaman dimuat
    updateIRSTable();
    
    // Update setelah tombol reset diklik
    document.getElementById('reset-btn').addEventListener('click', function() {
        // ... kode reset yang sudah ada ...
        setTimeout(updateIRSTable, 500); // Update setelah reset
    });
    
    // Update setelah memilih jadwal baru
    const pilihButtons = document.querySelectorAll('.pilih-jadwal');
    pilihButtons.forEach(button => {
        button.addEventListener('click', function() {
            setTimeout(updateIRSTable, 500); // Update setelah memilih jadwal
        });
    });
});

document.getElementById('ajukan-btn').addEventListener('click', function () {
    if (confirm('Apakah Anda yakin ingin mengajukan irs?')) {
    const nim = '{{ $mahasiswa->nim }}'; // Pastikan ini digantikan dengan nilai NIM yang benar dari server

    // Mengirimkan permintaan AJAX menggunakan Fetch API
    fetch('/ajukan-semua-IRS', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Token CSRF untuk keamanan
        },
        body: JSON.stringify({ nim: nim })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Berhasil mengajukan IRS.');
            window.location.reload();
        } else {
            alert(data.message || 'Terjadi kesalahan.');
        }
    })
    .catch(error => {
        alert('Terjadi kesalahan saat mengajukan IRS: ' + error);
    });
}
});



document.getElementById('perubahan-btn').addEventListener('click', function () {
    if (confirm('Apakah Anda yakin ingin mengajukan perubahan irs?')) {
    const nim = '{{ $mahasiswa->nim }}'; // Pastikan ini digantikan dengan nilai NIM yang benar dari server

    // Mengirimkan permintaan AJAX menggunakan Fetch API
    fetch('/perubahan-semua-IRS', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Token CSRF untuk keamanan
        },
        body: JSON.stringify({ nim: nim })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Berhasil mengajukan perubahan IRS.');
            window.location.reload();
        } else {
            alert(data.message || 'Terjadi kesalahan.');
        }
    })
    .catch(error => {
        alert('Terjadi kesalahan saat mengajukan perubahan IRS: ' + error);
    });
}
});

document.getElementById('reset-btn').addEventListener('click', function () {
    if (confirm('Apakah Anda yakin ingin mengreset irs?')) {
    const nim = '{{ $mahasiswa->nim }}'; // Gantikan dengan NIM mahasiswa yang benar
    const smt = '{{ $mahasiswa->smt }}'; // Gantikan dengan semester mahasiswa yang benar

    // Mengirimkan permintaan AJAX menggunakan Fetch API untuk reset data IRS
    fetch('/reset-irs', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Token CSRF untuk keamanan
        },
        body: JSON.stringify({ nim: nim, smt: smt })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Berhasil mereset IRS.');
            window.location.reload();
        } else {
            alert(data.message || 'Terjadi kesalahan saat mereset data.');
        }
    })
    .catch(error => {
        alert('Terjadi kesalahan saat mereset data IRS: ' + error);
    });
}
});

document.addEventListener('DOMContentLoaded', function() {
    // Ambil data jadwal yang sudah ada dari controller
    const jadwal = {!! json_encode($jadwal) !!}; // Data jadwal dengan kode_mk yang sama
    let sksTerpilih = parseInt('{{ $sksTerpilih }}'); // Inisialisasi SKS terpilih

    const jamRange = [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
    const hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    // Inisialisasi struktur tabel kosong
    jamRange.forEach(jam => {
        let row = document.createElement('tr');
        row.classList.add(`row-${jam}`);

        // Buat cell untuk jam
        const jamCell = document.createElement('td');
        jamCell.classList.add('border', 'px-2', 'py-2', 'text-xs', 'bg-white');
        jamCell.textContent = `${String(jam).padStart(2, '0')}:00`;
        row.appendChild(jamCell);

        // Buat cell untuk setiap hari
        hariList.forEach(hari => {
            const hariCell = document.createElement('td');
            hariCell.classList.add('border', 'px-2', 'pt-0', 'pb-2', 'bg-white', `cell-${hari}`);
            row.appendChild(hariCell);
        });

        document.getElementById('jadwalTableBody').appendChild(row);
    });

    // Menambahkan data jadwal ke dalam tabel
    jadwal.forEach(jadwal => {
        const jamMulai = jadwal.jam_mulai.substr(0, 2);
        const row = document.querySelector(`.row-${parseInt(jamMulai)}`);
        if (row) {
            const cell = row.querySelector(`.cell-${jadwal.hari}`);
            if (cell) {
                const jadwalButton = document.createElement('button');
                
                // Cek status jadwal di IRS
                const jadwalTerpilih = {!! json_encode($irsTable->pluck('jadwalid')->toArray()) !!};
                const kodeMKTerpilih = {!! json_encode($irsTable->pluck('kodemk')->toArray()) !!};
                
                // Set warna awal button
                if (jadwalTerpilih.includes(jadwal.jadwalid)) {
                    jadwalButton.classList.add('w-full', 'bg-amber-100/80', 'text-teal-800', 'rounded-lg', 'p-2', 'mt-2', 'mb-0');
                } else if (kodeMKTerpilih.includes(jadwal.kodemk)) {
                    jadwalButton.classList.add('w-full', 'bg-red-100/80', 'text-red-700', 'rounded-lg', 'p-2', 'mt-2', 'mb-0');
                } else {
                    jadwalButton.classList.add('w-full', 'bg-teal-100/80', 'text-teal-800', 'rounded-lg', 'p-2', 'mt-2', 'mb-0');
                }

                jadwalButton.style.fontSize = '13px';
                jadwalButton.innerHTML = `
                    <p class="text-center font-semibold">${jadwal.nama}</p>
                    <div class="flex justify-center gap-1" style="font-size: 10px;">
                        <p class="text-center text-amber-600 uppercase italic font-semibold" style="width: 30%;">${jadwal.status}</p>
                        <p class="text-center" style="width: 30%;">(SMT ${jadwal.semester})</p>
                        <p class="text-center" style="width: 30%;">(${jadwal.sks} SKS)</p>
                    </div>
                    <div class="flex justify-center gap-1" style="font-size: 10px;">
                        <p class="text-center" style="width: 30%;">Kelas ${jadwal.kelas}</p>
                        <p class="text-center" style="width: 30%;">Kuota: ${jadwal.kuota}</p>
                    </div> 
                    <div class="flex justify-center gap-1" style="font-size: 10px;">
                        <p class="text-center" style="width: 100%;">${jadwal.jam_mulai}-${jadwal.jam_selesai}</p>
                    </div>
                `;
                
                // Event listener untuk tombol
                jadwalButton.addEventListener('click', function() {
                    const nim = '{{ $mahasiswa->nim }}';
                    const smt = '{{ $mahasiswa->smt }}';
                    
                    // Jika tombol merah (mata kuliah sudah dipilih)
                    if (jadwalButton.classList.contains('bg-red-100/80')) {
                        alert('Anda sudah memilih mata kuliah ini.');
                        return;
                    }
                    
                    // Jika tombol amber (jadwal sudah dipilih - fungsi batalkan)
                    if (jadwalButton.classList.contains('bg-amber-100/80')) {
                        if (confirm('Apakah Anda yakin ingin membatalkan jadwal ini?')) {
                            $.ajax({
                                url: '/batal-jadwal',
                                method: 'POST',
                                data: {
                                    nim: nim,
                                    smt: smt,
                                    jadwalid: jadwal.jadwalid,
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                },
                                success: function(response) {
                                    if (response.status === 'success') {
                                        alert('Jadwal berhasil dibatalkan!');
                                        // Ubah warna button kembali ke teal
                                        jadwalButton.classList.remove('bg-amber-100/80');
                                        jadwalButton.classList.add('bg-teal-100/80');
                                        // Update tampilan jadwal lain dengan kode MK yang sama
                                        updateRelatedJadwalButtons(jadwal.kodemk, 'teal');
                                        // Kurangi SKS terpilih
                                        sksTerpilih -= jadwal.sks;
                                        updateSksTerpilih();
                                        window.location.reload();
                                    } else {
                                        alert(response.message);
                                    }
                                },
                                error: function() {
                                    alert('Terjadi kesalahan saat membatalkan jadwal.');
                                }
                            });
                        }
                        return;
                    }
                    
                    // Jika tombol teal (jadwal belum dipilih - fungsi pilih)
                    if (confirm('Apakah Anda yakin ingin memilih jadwal ini?')) {
                        $.ajax({
                            url: '/cek-jadwal',
                            method: 'POST',
                            data: {
                                nim: nim,
                                jadwalid: jadwal.jadwalid,
                                _token: $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(response) {
                                if (response.exists) {
                                    alert('Anda sudah memilih mata kuliah ini.');
                                } else if (response.jadwal_bentrok) {
                                    alert('Jadwal ini tidak dapat dipilih karena terjadi bentrok dengan jadwal lain.');
                                } else if (response.kuota_habis) {
                                    alert(response.error);
                                } else if (response.sks_over_limit) {
                                    alert(response.error);
                                } else {
                                    // Simpan jadwal jika semua pengecekan berhasil
                                    $.ajax({
                                        url: '/store-jadwal',
                                        method: 'POST',
                                        data: {
                                            nim: nim,
                                            smt: smt,
                                            jadwalid: jadwal.jadwalid,
                                            _token: $('meta[name="csrf-token"]').attr('content'),
                                        },
                                        success: function(response) {
                                            if (response.success) {
                                                alert('Jadwal berhasil dipilih!');
                                                // Ubah warna button menjadi amber
                                                jadwalButton.classList.remove('bg-teal-100/80');
                                                jadwalButton.classList.add('bg-amber-100/80');
                                                // Update tampilan jadwal lain dengan kode MK yang sama
                                                updateRelatedJadwalButtons(jadwal.kodemk, 'red');
                                                // Tambah SKS terpilih
                                                sksTerpilih += jadwal.sks;
                                                updateSksTerpilih();
                                                window.location.reload();
                                            } else {
                                                alert('Terjadi kesalahan saat memilih jadwal.');
                                            }
                                        },
                                        error: function() {
                                            alert('Tidak dapat memilih jadwal karena Anda sudah memiliki IRS yang disetujui atau sedang diproses.');
                                        }
                                    });
                                }
                            },
                            error: function(xhr) {
                                const response = xhr.responseJSON;
                                alert(response.error || 'Terjadi kesalahan saat memeriksa jadwal.');
                            }
                        });
                    }
                });

                // Tambahkan tombol ke dalam sel, tanpa menghapus yang sudah ada
                cell.appendChild(jadwalButton);
            }
        }
    });

    // Fungsi untuk memperbarui tampilan SKS terpilih
    function updateSksTerpilih() {
        document.getElementById('sksTerpilih').textContent = sksTerpilih;
    }

    // Inisialisasi tampilan SKS terpilih
    updateSksTerpilih();
});

// Fungsi untuk mengupdate warna button jadwal yang terkait
function updateRelatedJadwalButtons(kodeMK, color) {
    const allButtons = document.querySelectorAll('.jadwal-button');
    allButtons.forEach(button => {
        if (button.getAttribute('data-kodemk') === kodeMK) {
            button.classList.remove('bg-teal-100/80', 'bg-amber-100/80', 'bg-red-100/80');
            button.classList.add(`bg-${color}-100/80`);
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Event listener untuk tombol hapus
    const hapusButtons = document.querySelectorAll('.hapus-btn');
    hapusButtons.forEach(button => {
        button.addEventListener('click', function() {
            const jadwalid = this.getAttribute('data-jadwalid');
            deleteJadwal(this, jadwalid);
        });
    });
});

function deleteJadwal(btn, id) {
    if (confirm('Apakah Anda yakin ingin menghapus jadwal ini?')) {
        const nim = '{{ $mahasiswa->nim }}';  // Gantikan dengan NIM mahasiswa yang benar
        const smt = '{{ $mahasiswa->smt }}';  // Gantikan dengan semester mahasiswa yang benar

        fetch(`/batal-jadwal`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Token CSRF untuk keamanan
            },
            body: JSON.stringify({
                nim: nim,
                smt: smt,
                jadwalid: id
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Jadwal berhasil dibatalkan!');
                $(btn).closest('tr').remove();
                window.location.reload();
            } else {
                alert(data.message || 'Terjadi kesalahan saat membatalkan jadwal.');
            }
        })
        .catch(error => {
            alert('Terjadi kesalahan saat membatalkan jadwal: ' + error);
        });
    }
}

</script> 
</body>
</html>
@endsection