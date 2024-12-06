@extends('layouts.app')

@section('title', 'Penjadwalan Mata Kuliah')

@section('content')
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('{{ asset('image/bg_PASTI1.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100 overflow-hidden">
    <div class="min-h-screen">
        <div class="bg-white shadow min-h-screen p-6">
            <h1 class="text-2xl font-bold text-teal-800 mb-4">Jadwal Mata Kuliah</h1>

            <!-- Button untuk Menambah Jadwal -->
            <div class="mb-4">
                <button onclick="showTambahModal()" class="bg-teal-700 text-white px-4 py-2 rounded hover:bg-teal-800">
                    Tambah Jadwal
                </button>
            </div>

            <!-- Tabel Jadwal -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 shadow-sm">
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
                            <th class="border px-4 py-2">Kuota</th>
                            <th class="border px-4 py-2">Koordinator</th>
                            <th class="border px-4 py-2">Pengampu 1</th>
                            <th class="border px-4 py-2">Pengampu 2</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwals as $index => $jadwal)
                        <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-gray-100' }} hover:bg-gray-200">
                            <td class="border px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->matkul->nama }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->matkul->kode }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->matkul->sks }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->hari }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->kelas }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->ruangan->ruang ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->kuota }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->koordinator->nama ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->pengampu1->nama ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->pengampu2->nama ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $jadwal->status }}</td>
                            <td class="border px-4 py-2">
                                @if($jadwal->status == 'belum disetujui')
                                    <button onclick="editJadwal({{ $jadwal->id }})" class="bg-amber-500 text-white px-3 py-1 rounded hover:bg-amber-700">Edit</button>
                                    <button onclick="hapusJadwal({{ $jadwal->id }})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
                                @endif
                                @if($jadwal->status == 'belum disetujui')
                                    <button onclick="ajukanJadwal({{ $jadwal->id }})" class="bg-teal-700 text-white px-4 py-2 rounded hover:bg-teal-800">Ajukan Jadwal</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah Jadwal -->
    <div id="tambahModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg w-2/3 relative">
            <button onclick="closeTambahModal()" class="absolute top-2 right-2 text-2xl text-gray-500 hover:text-gray-700">&times;</button>
            <h2 id="modalTitle" class="text-xl font-bold text-teal-800 mb-4">Tambah Jadwal</h2>
            <form id="jadwalForm" method="POST">
                @csrf
                <!-- Grid dua kolom -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label for="mata_kuliah_kode" class="font-medium">Mata Kuliah</label>
                        <select name="kodemk" id="mata_kuliah_kode" class="px-3 py-2 border rounded" required>
                        <option value="" disabled selected>Pilih Mata Kuliah</option> <!-- Placeholder -->
                            @foreach($matakuliah as $mk)
                                <option value="{{ $mk->kode }}" data-nama="{{ $mk->nama }}" data-kode="{{ $mk->kode }}" data-sks="{{ $mk->sks }}" data-semester="{{ $mk->semester }}">{{ $mk->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="kode" class="font-medium">Kode</label>
                        <input type="text" name="kodemk" id="kode" class="px-3 py-2 border rounded" readonly>
                    </div>

                    <div class="flex flex-col">
                        <label for="sks" class="font-medium">SKS</label>
                        <input type="number" name="sks" id="sks" class="px-3 py-2 border rounded" readonly>
                    </div>

                    <div class="flex flex-col">
                        <label for="semester" class="font-medium">Semester</label>
                        <input type="number" name="semester" id="semester" class="px-3 py-2 border rounded" readonly>
                    </div>

                    <div class="flex flex-col">
                        <label for="hari" class="font-medium">Hari</label>
                        <select name="hari" id="hari" class="px-3 py-2 border rounded" required>
                        <option value="" disabled selected>Pilih Hari</option> <!-- Placeholder -->
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="jam_mulai" class="font-medium">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" class="px-3 py-2 border rounded" required>
                    </div>

                    <div class="flex flex-col">
                        <label for="jam_selesai" class="font-medium">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" class="px-3 py-2 border rounded" readonly>
                    </div>

                    <div class="flex flex-col">
                        <label for="kelas" class="font-medium">Kelas</label>
                        <select name="kelas" id="kelas" class="px-3 py-2 border rounded" required>
                            <option value="" disabled selected>Pilih Kelas</option>
                            <option value="A">Kelas A</option>
                            <option value="B">Kelas B</option>
                            <option value="C">Kelas C</option>
                            <option value="D">Kelas D</option>
                            <option value="E">Kelas E</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="ruang_id" class="font-medium">Ruang</label>
                        <select name="ruang_id" id="ruang_id" class="px-3 py-2 border rounded" required>
                            <option value="">Pilih Ruangan</option>
                            @foreach($ruangs as $ruang)
                                <option value="{{ $ruang->ruang }}">{{ $ruang->ruang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="kuota" class="font-medium">Kuota</label>
                        <input type="number" name="kuota" id="kuota" class="px-3 py-2 border rounded" required>
                    </div>

                    <div class="flex flex-col">
                        <label for="koordinator_nip" class="font-medium">Koordinator</label>
                        <select name="koordinator_nip" id="koordinator_nip" class="px-3 py-2 border rounded" required>
                        <option value="" disabled selected>Pilih Koordinator</option> <!-- Placeholder -->
                            @foreach($dosen as $d)
                                <option value="{{ $d->nip }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="pengampu1_nip" class="font-medium">Pengampu 1</label>
                        <select name="pengampu1_nip" id="pengampu1_nip" class="px-3 py-2 border rounded">
                        <option value="" disabled selected>Pilih Pengampu 1</option> <!-- Placeholder -->
                            @foreach($dosen as $d)
                                <option value="{{ $d->nip }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="pengampu2_nip" class="font-medium">Pengampu 2</label>
                        <select name="pengampu2_nip" id="pengampu2_nip" class="px-3 py-2 border rounded">
                        <option value="" disabled selected>Pilih Pengampu 2</option> <!-- Placeholder -->
                            @foreach($dosen as $d)
                                <option value="{{ $d->nip }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Button Submit -->
                <div class="flex justify-end mt-4">
                    <button type="submit" id="submitJadwal" class="bg-teal-700 text-white px-4 py-2 rounded hover:bg-teal-800">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Menangani event change pada select mata kuliah
        $('#mata_kuliah_kode').change(function() {
            var selectedOption = $(this).find('option:selected');
            var kode = selectedOption.data('kode');
            var sks = selectedOption.data('sks');
            var semester = selectedOption.data('semester');

            // Menampilkan data sesuai dengan mata kuliah yang dipilih
            $('#kode').val(kode);
            $('#sks').val(sks);
            $('#semester').val(semester);

            // Menghitung jam selesai berdasarkan SKS
            calculateEndTime(sks);
        });

        function calculateEndTime(sks) {
            var jamMulai = $('#jam_mulai').val();
            if (jamMulai && sks) {
                var startTime = new Date("1970-01-01T" + jamMulai + ":00"); // Menambahkan tanggal agar dapat diproses sebagai waktu
                var duration = sks * 50; // 1 SKS = 50 menit
                startTime.setMinutes(startTime.getMinutes() + duration); // Menambahkan waktu durasi ke waktu mulai

                // Format waktu selesai dalam format HH:mm
                var hours = startTime.getHours().toString().padStart(2, '0');
                var minutes = startTime.getMinutes().toString().padStart(2, '0');
                $('#jam_selesai').val(hours + ':' + minutes); // Menampilkan jam selesai pada field
            }
        }

        // Menangani perubahan pada jam_mulai atau sks
        $('#jam_mulai, #sks').change(function() {
            var sks = $('#sks').val();
            calculateEndTime(sks); // Hitung jam selesai ketika jam_mulai atau sks berubah
        });

        // Show Modal
        function showTambahModal() {
            document.getElementById('tambahModal').classList.remove('hidden');
        }

        // Close Modal
        function closeTambahModal() {
            document.getElementById('tambahModal').classList.add('hidden');
        }

        // Form Validation & Ajax submission
        $('#jadwalForm').submit(function(e) {
            e.preventDefault();
            var formData = {
                kodemk: $('#mata_kuliah_kode').val(),
                hari: $('#hari').val(),
                jam_mulai: $('#jam_mulai').val(),
                jam_selesai: $('#jam_selesai').val(),
                kelas: $('#kelas').val(),
                ruang_id: $('#ruang_id').val(),
                koordinator_nip: $('#koordinator_nip').val(),
                pengampu1_nip: $('#pengampu1_nip').val(),
                pengampu2_nip: $('#pengampu2_nip').val(),
                kuota: $('#kuota').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('kp.jadwal.store') }}",
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    Swal.fire('Berhasil', 'Jadwal berhasil ditambahkan', 'success')
                    .then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    let errorMessage = 'Ada kesalahan dalam menambahkan jadwal';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire('Gagal', errorMessage, 'error');
                    console.error(xhr.responseText);
                }
            });
        });

        function editJadwal(id) {
            $.get(`/jadwal/${id}/edit`, function(jadwal) {
                $('#ruang_id').val(jadwal.ruang_id);
                // ... kode lainnya ...
            });
        }

        // Di console browser
        console.log($('#jadwalForm').serialize());
    </script>
</body>
</html>
@endsection
