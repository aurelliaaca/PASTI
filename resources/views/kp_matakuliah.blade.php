@extends('layouts.app')

@section('title', 'KP Matakuliah')

@section('content')
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
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
    <a href="{{ url()->previous() }}" class="absolute top-4 left-7 flex items-center gap-2 bg-teal-800 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition-all duration-300 shadow-lg hover:shadow-xl">
        <i class="fas fa-arrow-left"></i>
        <span class="font-medium">Kembali</span>
    </a>

    <div class="max-w-7xl mx-auto p-4 min-h-screen">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold text-teal-800 mb-4">Daftar Mata Kuliah</h1>
            <div class="overflow-x-auto">
                <table class="w-full border text-center table-auto">
                    <thead class="bg-teal-700 text-white">
                        <tr>
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">Kode</th>
                            <th class="border px-4 py-2">Mata Kuliah</th>
                            <th class="border px-4 py-2">Semester</th>
                            <th class="border px-4 py-2">SKS</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Dummy -->
                        @php
                            $matakuliah = [
                                ['kode' => 'MK001', 'nama' => 'Pemrograman Dasar', 'semester' => 1, 'sks' => 3],
                                ['kode' => 'MK002', 'nama' => 'Struktur Data', 'semester' => 2, 'sks' => 3],
                                ['kode' => 'MK003', 'nama' => 'Basis Data', 'semester' => 3, 'sks' => 3],
                                ['kode' => 'MK004', 'nama' => 'Jaringan Komputer', 'semester' => 4, 'sks' => 3],
                                ['kode' => 'MK005', 'nama' => 'Kecerdasan Buatan', 'semester' => 5, 'sks' => 3],
                            ];
                        @endphp

                        @foreach ($matakuliah as $index => $mk)
                        <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-gray-100' }} hover:bg-gray-200">
                            <td class="border px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $mk['kode'] }}</td>
                            <td class="border px-4 py-2">{{ $mk['nama'] }}</td>
                            <td class="border px-4 py-2">{{ $mk['semester'] }}</td>
                            <td class="border px-4 py-2">{{ $mk['sks'] }}</td>
                            <td class="border px-4 py-2">
                                <button onclick="editMataKuliah('{{ $mk['kode'] }}', '{{ $mk['nama'] }}', '{{ $mk['semester'] }}', '{{ $mk['sks'] }}')" 
                                        class="bg-amber-500 text-white px-3 py-1 rounded hover:bg-amber-700">Edit</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit Mata Kuliah -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold text-teal-800 mb-4">Edit Mata Kuliah</h2>
            <form id="editForm">
                <div class="mb-4">
                    <label class="block font-medium mb-2">Kode</label>
                    <input type="text" id="editKode" class="w-full border rounded px-3 py-2" readonly>
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-2">Mata Kuliah</label>
                    <input type="text" id="editNama" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-2">Semester</label>
                    <input type="number" id="editSemester" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-2">SKS</label>
                    <input type="number" id="editSKS" class="w-full border rounded px-3 py-2">
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700 mr-2" onclick="closeModal()">Batal</button>
                    <button type="submit" class="bg-teal-700 text-white px-4 py-2 rounded hover:bg-teal-800">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editMataKuliah(kode, nama, semester, sks) {
            document.getElementById('editKode').value = kode;
            document.getElementById('editNama').value = nama;
            document.getElementById('editSemester').value = semester;
            document.getElementById('editSKS').value = sks;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        document.getElementById('editForm').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data mata kuliah berhasil diperbarui.',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4CAF50'
            }).then(() => {
                closeModal();
            });
        });
    </script>
</body>
</html>
@endsection
