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
    <button class="btn flex-1 bg-amber-400 text-white p-2 rounded-tl-xl rounded-bl-xl shadow-sm hover:bg-orange-400" data-filter="BuatIRS">
        <span class="font-semibold italic text-center">Buat IRS</span>
    </button>
        <button class="btn flex-1 bg-teal-700 text-white p-2 rounded-tr-xl rounded-br-xl shadow-sm hover:bg-orange-400" data-filter="IRS">
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
                    <p class="text-sm align-middle w-full">{{ $sksTerpilih }}</p>
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
                            <th class="px-4 py-2 border-r border-teal-500">Hari</th>
                                <th class="px-4 py-2 border-r border-teal-500">Nama Mata Kuliah</th>
                                <th class="px-4 py-2 border-r border-teal-500">Kode</th>
                                <th class="px-4 py-2 border-r border-teal-500">SKS</th>
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
                    </div>
                </div>
            <div class="border rounded-md">
                <div class="table-responsive p-2 table-striped">
                <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse">
                    <thead>
                        <tr>
                            <th class="font-bold px-4 py-2" style="width: 15%;">Hari</th>
                            <th class="font-bold px-4 py-2" style="width: 20%;">Nama Mata Kuliah</th>
                            <th class="font-bold px-4 py-2" style="width: 10%;">Kode</th>
                            <th class="font-bold px-4 py-2" style="width: 10%;">SKS</th>
                            <th class="font-bold px-4 py-2" style="width: 15%;">Jam</th>
                            <th class="font-bold px-4 py-2" style="width: 15%;">Kelas</th>
                            <th class="font-bold px-4 py-2" style="width: 15%;">Status</th>
                        </tr>
                    </thead>
                        <tbody id="irsTableBody">
                            @php
                                // Grouping irsTable by 'hari'
                                $groupedByHari = $irsTable->groupBy('hari');
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
                                        <td class="border px-4 py-2">{{ $irs->sks }}</td>
                                        <td class="border px-4 py-2">{{ $irs->jam_mulai }}</td>
                                        <td class="border px-4 py-2">{{ $irs->kelas }}</td>
                                        <td class="border px-4 py-2">{{ $irs->status_verifikasi }}</td>
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

  <script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.btn');
    const buatirsContent = document.querySelector('.BuatIRS');
    const irsContent = document.querySelector('.IRS');

    // Fungsi untuk mengatur tampilan konten
    function toggleContent(filter) {
      if (filter === 'BuatIRS') {
        buatirsContent.style.display = 'block';
        irsContent.style.display = 'none';
      } else if (filter === 'IRS') {
        buatirsContent.style.display = 'none';
        irsContent.style.display = 'block';
      }
    }

    buttons.forEach(button => {
      button.addEventListener('click', function() {
        // Menghapus titik dari data-filter
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

    // Set tampilan default (IRS)
    const defaultButton = document.querySelector('.a[data-filter="BuatIRS"]');
    defaultButton.classList.add('bg-amber-400');
    toggleContent('BuatIRS');
});

document.getElementById('matkul-dropdown').addEventListener('change', function () {
    const opsiDipilih = this.options[this.selectedIndex]; // Ambil opsi yang dipilih
    const kodeMatkul = this.value; // Ambil nilai kode mata kuliah
    const namaMatkul = opsiDipilih.getAttribute('data-name'); // Ambil nama mata kuliah dari atribut
    const sksMatkul = opsiDipilih.getAttribute('data-sks'); // Ambil SKS mata kuliah dari atribut
    const tabelJadwal = document.getElementById('jadwalTableBody'); // Elemen body tabel jadwal

    // Periksa apakah mata kuliah dipilih (kode tidak kosong)
    if (kodeMatkul && namaMatkul) {
        // Buat elemen untuk menampilkan mata kuliah yang dipilih
        const divMatkulDipilih = document.createElement('div');
        divMatkulDipilih.classList.add('flex', 'items-center', 'bg-teal-500', 'p-2', 'rounded', 'mb-2');
        divMatkulDipilih.id = `matkul-${kodeMatkul}`; // Beri ID unik berdasarkan kode mata kuliah

        divMatkulDipilih.innerHTML = `
            <div class="flex-grow overflow-hidden break-words">
                <p class="text-[12px] text-justify">${namaMatkul}</p>
            </div>
            <div class="flex items-center justify-end min-w-[120px] max-w-[120px]">
                <p class="text-[12px] text-right font-semibold pr-2">${kodeMatkul} (${sksMatkul} SKS)</p>
            </div>
        `;
        document.getElementById('selected-matkul').appendChild(divMatkulDipilih);

        // Periksa apakah jadwal untuk mata kuliah ini sudah ada di tabel
        const barisJadwalExist = document.querySelector(`#jadwalTableBody .row-${kodeMatkul}`);

        // Jika belum ada, ambil data jadwal dari server
        if (!barisJadwalExist) {
            fetch(`/get-jadwal-mk/${kodeMatkul}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        
                        // Tambahkan setiap jadwal ke tabel
                        data.forEach(jadwal => {
                            const baris = document.createElement('tr');
                            baris.classList.add('bg-white', `row-${kodeMatkul}`); // Tambahkan kelas unik untuk mata kuliah

                            baris.innerHTML = `
                                <td class="border px-4 py-2">${jadwal.hari}</td>
                                <td class="border px-4 py-2">${jadwal.matkul.nama}</td>
                                <td class="border px-4 py-2">${jadwal.kodemk}</td>
                                <td class="border px-4 py-2">${jadwal.matkul.sks}</td>
                                <td class="border px-4 py-2">${jadwal.jam_mulai}</td>
                                <td class="border px-4 py-2">${jadwal.kelas}</td>
                                <input type="text" id="nim" value="{{ $mahasiswa->nim }}" class="hidden">
                                <input type="text" id="smt" value="{{ $mahasiswa->smt }}" class="hidden">
                                <td class="border px-4 py-2">
                                    <button class="bg-teal-500 text-white px-4 py-1 rounded" onclick="pilihJadwal('${jadwal.jadwalid}', this)">Pilih</button>
                                </td>
                            `;
                            tabelJadwal.appendChild(baris);
                        });
                    } else {
                        divMatkulDipilih.classList.add('bg-red-500', 'text-white'); // Ubah warna background menjadi merah dan teks menjadi putih
                        alert('Jadwal untuk mata kuliah ini belum tersedia, silakan pilih mata kuliah lain!');
                    }
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat mengambil data jadwal:', error);

                    // Tambahkan pesan error ke tabel
                    const baris = document.createElement('tr');
                    baris.classList.add(`row-${kodeMatkul}`);
                    baris.innerHTML = '<td colspan="7">Terjadi kesalahan saat mengambil data jadwal.</td>';
                    tabelJadwal.appendChild(baris);
                });
        }
    }
});

function pilihJadwal(jadwalid, button) {
    const nim = document.getElementById('nim').value;  // Ambil nilai NIM
    const smt = document.getElementById('smt').value;  // Ambil nilai Semester

    // Pastikan nim dan smt terisi
    if (!nim || !smt) {
        alert('NIM atau Semester tidak valid.');
        return;
    }

    // Kirim AJAX untuk cek apakah jadwal sudah dipilih
    $.ajax({
        url: '/cek-jadwal',
        method: 'POST',
        data: {
            nim: nim,
            jadwalid: jadwalid,
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(response) {
            console.log(response);  // Periksa response di console

            if (response.exists) {
                alert('Anda sudah memilih mata kuliah ini.');
            } else if (response.sks_over_limit) {
                alert('Anda sudah melebihi batas SKS yang dapat diambil.');
            } else {
                // Lanjutkan untuk menyimpan jadwal
                $.ajax({
                    url: '/store-jadwal',
                    method: 'POST',
                    data: {
                        nim: nim,
                        smt: smt,
                        jadwalid: jadwalid,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Jadwal berhasil dipilih!');
                            button.textContent = 'Batalkan'; // Ganti teks tombol menjadi "Batalkan"
                        } else {
                            alert('Terjadi kesalahan saat memilih jadwal.');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat menyimpan jadwal.');
                    }
                });
            }
        },
        error: function(xhr) {
            // Tangani error dengan response dari server (status 400 atau lainnya)
            if (xhr.status === 400) {
                const response = xhr.responseJSON;
                if (response.sks_over_limit) {
                    alert('Anda sudah melebihi batas SKS yang dapat diambil.');
                } else {
                    alert('Terjadi kesalahan saat memeriksa jadwal.');
                }
            } else {
                alert('Terjadi kesalahan saat memeriksa jadwal.');
            }
        }
    });
}

</script> 
</body>
</html>
@endsection