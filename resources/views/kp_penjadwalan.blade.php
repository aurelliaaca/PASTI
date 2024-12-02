@extends('layouts.app')

@section('title', 'Kp Penjadwalan')

@section('content')
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('{{ asset('image/bg_PASTI1.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
    
</head>

<body class="min-h-screen bg-gradient-to-r from-teal-600 to-amber-500">
        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="absolute top-38 left-7 flex items-center gap-2 bg-teal-800 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition-all duration-300 shadow-lg hover:shadow-xl">
            <i class="fas fa-arrow-left"></i>
            <span class="font-medium">Kembali</span>
        </a>
    <div class="max-w-7xl mx-auto p-4 min-h-screen">

        <!-- Header dengan Tombol -->
        <div class="flex w-full mb-4">
            <button class="btn flex-1 bg-amber-400 text-white p-2 rounded-tl-xl rounded-bl-xl shadow-sm hover:bg-orange-400 whitespace-nowrap flex justify-center items-center" data-filter=".buatJadwal">
                <span class="font-semibold italic text-center">Buat Jadwal</span>
            </button>
            <button class="btn flex-1 bg-teal-700 text-white p-2 rounded-tr-xl rounded-br-xl shadow-sm hover:bg-orange-400 whitespace-nowrap flex justify-center items-center" data-filter=".jadwalKuliah">
                <span class="font-semibold italic text-center">Jadwal Kuliah</span>
            </button>
            <!-- <button class="btn flex-1 bg-teal-700 text-white p-2 rounded-tr-xl rounded-br-xl shadow-sm hover:bg-orange-400 whitespace-nowrap flex justify-center items-center" data-filter=".penetapan">
                <span class="font-semibold italic text-center">Penetapan</span>
            </button> -->
        </div>

        <!-- Konten Dinamis -->
        <div class="content-area">
            <!-- Buat Jadwal -->
            <div class="buatJadwal" style="display: block;">
                <div class="bg-teal-700 text-teal-900 p-4 rounded-lg">
                    <h2 class="text-xl font-bold text-white mb-2">Buat Jadwal Kuliah</h2>
                    <form id="jadwalForm">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-white block font-medium mb-2">Nama Mata Kuliah</label>
                                <select id="namaMk" name="namaMk" class="w-full p-2 border rounded">
                                    
                                    <option value="">Pilih Mata Kuliah</option>
                                    @foreach ($matakuliah as $mk)
                                        <option value="{{ $mk->kode }}"
                                        data-nama="{{ $mk->nama }}"
                                        data-kode="{{ $mk->kode }}"
                                        data-sks="{{ $mk->sks }}"
                                        data-semester="{{ $mk->semester }}">
                                        {{ $mk->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div>
                                <label class="text-white block font-medium mb-2">Kode Mata Kuliah</label>
                                <input type="text" id="kodeMk" class="w-full p-2 border rounded" readonly>
                            </div>
                            <div>
                                <label class="text-white block font-medium mb-2">SKS</label>
                                <input type="number" id="sksMk" class="w-full p-2 border rounded" readonly>
                            </div>
                            <div>
                                <label class="text-white block font-medium mb-2">Semester</label>
                                <input type="number" id="semesterMk" class="w-full p-2 border rounded" readonly>
                            </div>
                            <div>
                                <label class="text-white block font-medium mb-2">Kelas</label>
                                <select id="kelasMk" class="w-full p-2 border rounded">
                                    <option value=""> Pilih Kelas </option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-white block font-medium mb-2">Ruang</label>
                                <select id="ruangKls" class="w-full p-2 border rounded">
                                    <option value=""> Pilih Ruangan </option>
                                    @foreach ($ruang as $rg)
                                        <option value="{{ $rg->ruang }}">{{ $rg->ruang }}</option>
                                        
                                    @endforeach

                                </select>
                            </div>
                            <div>
                                <label class="text-white block font-medium mb-2">Jam Mulai</label>
                                <input type="time" id="jamMulai" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="text-white block font-medium mb-2">Jam Selesai</label>
                                <input type="time" id="jamSelesai" class="w-full p-2 border rounded" readonly>
                            </div>
                            <div>
                                <label class="text-white block font-medium mb-2">Hari</label>
                                <select id="hari" class="w-full p-2 border rounded">
                                    <option value=""> Pilih Hari </option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-white block font-medium mb-2">Dosen</label>
                                <select id="dosenSelect" class="w-full p-2 border rounded" multiple>
                                    <!-- Dosen Options -->
                                    @foreach ($dosen as $ds)
                                        <option value="{{ $ds->nip }}">{{ $ds->nama }}</option>
                                        
                                    @endforeach
                                </select>
                                <p id="dosenError" class="text-red-500 text-sm mt-1 hidden">Pilih minimal 1 dosen dan maksimal 3 dosen.</p>
                            </div>


                        </div>
                        <button type="button" id="addJadwal" class="mt-4 w-full bg-amber-400 text-white py-2 rounded-lg hover:bg-orange-400">Tambah Jadwal</button>
                    </form>
                </div>
            </div>

            <!-- Jadwal Kuliah -->
            <div class="jadwalKuliah" style="display: none;">
                <div class="bg-white text-teal-900 p-4 rounded-lg">
                    <h2 class="text-xl font-bold text-teal-800 mb-2">STATUS JADWAL KULIAH: BELUM DIAJUKAN</h2>
                    <div class="flex justify-between items-center mb-4">
                        <div></div> <!-- Placeholder untuk mengatur posisi -->
                        <button class="bg-amber-500 text-white p-2 rounded flex items-center space-x-2 rounded-lg hover:bg-orange-400">
                            <span class="text-sm">Ajukan Jadwal</span>
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border text-center table-auto">
                            <thead class="bg-teal-700 text-white">
                                <tr>
                                    <th class="border px-4 py-2">No</th>
                                    <th class="border px-4 py-2">Nama Mata Kuliah</th>
                                    <th class="border px-4 py-2">Kode</th>
                                    <th class="border px-4 py-2">SKS</th>
                                    <th class="border px-4 py-2">Hari</th>
                                    <th class="border px-4 py-2">Jam</th>
                                    <th class="border px-4 py-2">Kelas</th>
                                    <th class="border px-4 py-2">Ruang</th>
                                    <th class="border px-4 py-2">Dosen</th>
                                    <th class="border px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="jadwalTable">
                                <!-- Dynamic jadwal content here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Penetapan -->
            <div class="penetapan" style="display: none;">
                <div class="bg-white text-teal-900 p-4 rounded-lg">
                    <h2 class="text-xl font-bold text-teal-800 mb-2">Penetapan Jadwal Kuliah</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full border text-center table-auto">
                            <thead class="bg-teal-700 text-white">
                                <tr>
                                    <th class="border px-4 py-2">No</th>
                                    <th class="border px-4 py-2">Nama Mata Kuliah</th>
                                    <th class="border px-4 py-2">Kode</th>
                                    <th class="border px-4 py-2">SKS</th>
                                    <th class="border px-4 py-2">Hari</th>
                                    <th class="border px-4 py-2">Jam</th>
                                    <th class="border px-4 py-2">Kelas</th>
                                    <th class="border px-4 py-2">Ruang</th>
                                    <th class="border px-4 py-2">Dosen</th>
                                </tr>
                            </thead>
                            <tbody id="penetapanTable">
                                <!-- Penetapan content here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.btn');
            const sections = document.querySelectorAll('.buatJadwal, .jadwalKuliah, .penetapan');

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

            const defaultButton = document.querySelector('.btn[data-filter=".buatJadwal"]');
            if (defaultButton) {
                defaultButton.classList.add('bg-amber-400');
                toggleContent('.buatJadwal');
            }
        });

        // Initialize Choices.js for the Dosen select element
        const dosenSelect = document.getElementById("dosenSelect");
        const choicesDosen = new Choices(dosenSelect, {
            removeItemButton: true,
            maxItemCount: 3,
            searchEnabled: false, // Disable search, optional
            itemSelectText: '',  // Hide the "Select" text
            placeholder: true,
            placeholderValue: 'Pilih Dosen'
        });
        // Add Jadwal Script
        const mataKuliahData = [
            { nama: "Dasar Pemrograman", kode: "MK01", sks: 3, semester: 1 },
            { nama: "Algoritma Pemrograman", kode: "MK02", sks: 4, semester: 2 }
        ];

        const jadwalData = [];
        const addJadwalBtn = document.getElementById("addJadwal");
        const jadwalTable = document.getElementById("jadwalTable");
        const namaMkSelect = document.getElementById("namaMk");
        const kodeMk = document.getElementById("kodeMk");
        const sksMk = document.getElementById("sksMk");
        const semesterMk = document.getElementById("semesterMk");

        // Fungsi untuk mengambil data berdasarkan kode mata kuliah
        async function fetchData(kodeMk) {
            try {
                const response = await fetch(`/get-mata-kuliah-data/${kodeMk}`);
                const data = await response.json();
                
                // Set nilai pada form berdasarkan data yang didapat
                if (data) {
                    document.getElementById("kodeMk").value = data.kode;
                    document.getElementById("sksMk").value = data.sks;
                    document.getElementById("semesterMk").value = data.semester;
                }
            } catch (error) {
                console.error("Error fetching mata kuliah data:", error);
            }
        }

        mataKuliahData.forEach(mk => {
            const option = document.createElement("option");
            option.value = mk.kode;
            option.textContent = mk.nama;
            namaMkSelect.appendChild(option);
        });

        namaMkSelect.addEventListener("change", function () {
            const selectedOption = namaMkSelect.options[namaMkSelect.selectedIndex];
            const kode = selectedOption.value;

            if (kode) {
                fetchData(kode);  // Panggil fetch untuk mendapatkan data
            } else {
                kodeMk.value = '';
                sksMk.value = '';
                semesterMk.value = '';
            }
        });
        
        // Tambahkan Event Listener untuk menghitung jam selesai berdasarkan jam mulai dan jumlah SKS
        document.getElementById("jamMulai").addEventListener("change", function () {
            const sks = parseInt(sksMk.value) || 0; // Ambil jumlah SKS
            const jamMulai = this.value;

            if (jamMulai && sks > 0) {
                const [hours, minutes] = jamMulai.split(":").map(Number);
                const totalMinutes = hours * 60 + minutes + sks * 50; // Tambahkan durasi sesuai SKS
                const jamSelesaiHours = Math.floor(totalMinutes / 60);
                const jamSelesaiMinutes = totalMinutes % 60;

                // Atur nilai jam selesai pada form
                document.getElementById("jamSelesai").value = 
                    `${jamSelesaiHours.toString().padStart(2, '0')}:${jamSelesaiMinutes.toString().padStart(2, '0')}`;
            }
        });


        addJadwalBtn.addEventListener("click", () => {
            const selectedDosen = Array.from(dosenSelect.selectedOptions).map(option => option.textContent); // Mengambil nama dosen lengkap
            const dosenError = document.getElementById("dosenError");

            // Validasi untuk memilih minimal 1 dosen dan maksimal 3 dosen
            if (selectedDosen.length < 1 || selectedDosen.length > 3) {
                dosenError.classList.remove("hidden");
                return;
            } else {
                dosenError.classList.add("hidden");
            }

            const nama = namaMkSelect.options[namaMkSelect.selectedIndex]?.text || "";
            const kode = kodeMk.value;
            const sks = sksMk.value;
            const semester = semesterMk.value;
            const kelas = document.getElementById("kelasMk").value;
            const ruang = document.getElementById("ruangKls").value;
            const hari = document.getElementById("hari").value;
            const jamMulai = document.getElementById("jamMulai").value;
            const jamSelesai = document.getElementById("jamSelesai").value;

            if (!nama || !kode || !sks || !kelas || !ruang || !hari || !jamMulai || !selectedDosen) {
                alert("Semua field harus diisi!");
                return;
            }

            jadwalData.push({ 
                nama, 
                kode, 
                sks, 
                semester, 
                kelas, 
                ruang, 
                hari, 
                jam: `${jamMulai} - ${jamSelesai}`, 
                dosen: selectedDosen // Menyimpan nama dosen lengkap
            });
            renderJadwal();
            Swal.fire({
                title: 'Berhasil!',
                text: 'Jadwal berhasil ditambahkan.',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4CAF50'
            });
        });



        function renderJadwal() {
            jadwalTable.innerHTML = "";
            jadwalData.forEach((jadwal, index) => {
                const row = document.createElement("tr");
                row.classList.add(index % 2 === 0 ? "bg-gray-50" : "bg-gray-100", "hover:bg-gray-200");
                row.innerHTML = `
                    <td class="border px-4 py-2">${index + 1}</td>
                    <td class="border px-4 py-2">${jadwal.nama}</td>
                    <td class="border px-4 py-2">${jadwal.kode}</td>
                    <td class="border px-4 py-2">${jadwal.sks}</td>
                    <td class="border px-4 py-2">${jadwal.hari}</td>
                    <td class="border px-4 py-2">${jadwal.jam}</td>
                    <td class="border px-4 py-2">${jadwal.kelas}</td>
                    <td class="border px-4 py-2">${jadwal.ruang}</td>
                    <td class="border px-4 py-2">${jadwal.dosen.join(", ")}</td>
                    <td class="border px-4 py-2">
                        <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-700" onclick="deleteJadwal(${index})">Hapus</button>
                    </td>
                `;
                jadwalTable.appendChild(row);
            });
        }

        function deleteJadwal(index) {
            jadwalData.splice(index, 1);
            renderJadwal();
        }
    </script>
</body>
</html>
@endsection
