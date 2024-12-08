@extends('layouts.app')

@section('title', 'Penjadwalan Mata Kuliah')

@section('content')
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('{{ asset('image/bg_PASTI1.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            height: max-content;
            margin: 0;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100 overflow-hidden">
    <div class="min-h-screen">
        <div class="bg-white shadow min-h-screen p-6">
            <h1 class="text-2xl font-bold text-teal-800 mb-4"></h1>

            <!-- Button untuk Menambah dan Mengajukan Jadwal -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold text-teal-800 mb-4">JADWAL MATA KULIAH</h1>
                <div class="flex space-x-2">
                    @if($jadwals->where('status', '!=', 'belum disetujui')->count() > 0)
                        <!-- Tombol disabled -->
                        <button type="button" 
                                class="btn btn-sm btn-primary bg-teal-300 text-white p-2 rounded-lg flex items-center gap-2 cursor-not-allowed opacity-50" 
                                disabled>
                            <i class="fas fa-plus"></i>
                            <span class="font-medium">Tambah Jadwal</span>
                        </button>
                        <button type="button" 
                                class="btn btn-sm btn-primary bg-amber-300 text-white p-2 rounded-lg flex items-center gap-2 cursor-not-allowed opacity-50" 
                                disabled>
                            <i class="fas fa-paper-plane"></i>
                            <span class="font-medium">Ajukan Jadwal</span>
                        </button>
                    @else
                        <button type="button" 
                                class="btn btn-sm btn-primary bg-teal-500 text-white p-2 rounded-lg flex items-center gap-2" 
                            onclick="showTambahModal()">
                        <i class="fas fa-plus"></i>
                        <span class="font-medium">Tambah Jadwal</span>
                    </button>
                    <button type="button" 
                            class="btn btn-sm btn-primary bg-amber-400 text-white p-2 rounded-lg flex items-center gap-2" 
                            onclick="ajukanSemuaJadwal()">
                        <i class="fas fa-paper-plane"></i>
                        <span class="font-medium">Ajukan Jadwal</span>
                    </button>
                    @endif
                </div>
            </div>

            <!-- Tabel Jadwal -->
            <div class="border rounded-md overflow-x-auto">
                <div class="table-responsive p-2">
                    <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse">
                        <thead>
                            <tr>
                                <th class="font-bold text-sm px-4 py-2">No</th>
                                <th class="font-bold text-sm px-4 py-2">Nama Mata Kuliah</th>
                                <th class="font-bold text-sm px-4 py-2">Kode</th>
                                <th class="font-bold text-sm px-4 py-2">SKS</th>
                                <th class="font-bold text-sm px-4 py-2">Semester</th>
                                <th class="font-bold text-sm px-4 py-2">Hari</th>
                                <th class="font-bold text-sm px-4 py-2">Jam</th>
                                <th class="font-bold text-sm px-4 py-2">Kelas</th>
                                <th class="font-bold text-sm px-4 py-2">Ruang</th>
                                <th class="font-bold text-sm px-4 py-2">Kuota</th>
                                <th class="font-bold text-sm px-4 py-2">Koordinator</th>
                                <th class="font-bold text-sm px-4 py-2">Pengampu 1</th>
                                <th class="font-bold text-sm px-4 py-2">Pengampu 2</th>
                                <th class="font-bold text-sm px-4 py-2">Status</th>
                                <th class="font-bold text-sm px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwals as $index => $jadwal)
                            <tr class="odd:bg-teal-800/10 even:bg-white mb-2 hover:bg-green-200 cursor-pointer">
                                <td class="text-sm px-4 py-2">{{ $index + 1 }}</td>
                                <td class="text-sm px-4 py-2">{{ $jadwal->matkul->nama }}</td>
                                <td class="text-sm px-4 py-2">{{ $jadwal->matkul->kode }}</td>
                                <td class="text-sm px-4 py-2">{{ $jadwal->matkul->sks }}</td>
                                <td class="text-sm px-4 py-2">{{ $jadwal->matkul->semester }}</td>
                                <td class="text-sm px-4 py-2">{{ $jadwal->hari }}</td>
                                <td class="text-sm px-4 py-2">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                                <td class="text-sm px-4 py-2">{{ $jadwal->kelas }}</td>
                                <td class="text-sm px-4 py-2">{{ $jadwal->namaruang ?? '-' }}</td>
                                <td class="text-sm px-4 py-2">{{ $jadwal->kuota }}</td>
                                <td class="text-sm px-4 py-2">{{ $jadwal->koordinator->nama ?? '-' }}</td>
                                <td class="text-sm px-4 py-2">{{ $jadwal->pengampu1->nama ?? '-' }}</td>
                                <td class="text-sm px-4 py-2">{{ $jadwal->pengampu2->nama ?? '-' }}</td>
                                <td class="text-sm px-4 py-2">{{ $jadwal->status }}</td>
                                <td class="text-sm px-4 py-2 text-center">
                                    <div class="flex justify-center gap-2">
                                        @if($jadwal->status === 'belum disetujui')
                                            <button type="button" 
                                                    onclick="editJadwal('{{ $jadwal->jadwalid }}')" 
                                                    class="btn btn-sm btn-primary edit-btn bg-teal-500 w-20 text-white p-2 rounded-lg">
                                                Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger delete-btn bg-amber-400 w-20 text-white p-2 rounded-lg" 
                                                    onclick="confirmDelete({{ $jadwal->jadwalid }})">
                                                Hapus
                                            </button>
                                        @else
                                            <span class="text-gray-500 italic">Tidak ada aksi</span>
                                        @endif
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
                        <option value="" disabled selected>Pilih Hari</option> 
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="kelas" class="font-medium">Kelas</label>
                        <select name="kelas" id="kelas" class="px-3 py-2 border rounded" required>
                            <option value="" disabled selected>Pilih Kelas</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="jam_mulai" class="font-medium">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" class="px-3 py-2 border rounded" required>
                    </div>

                    <div class="flex flex-col">
                        <label for="jam_selesai" class="font-medium">Jam Selesai</label>
                        <input type="time" id="jam_selesai" name="jam_selesai" class="px-3 py-2 border rounded" readonly>
                    </div>

                    <div class="flex flex-col">
                        <label for="namaruang" class="font-medium">Ruang</label>
                        <select name="namaruang" id="namaruang" class="px-3 py-2 border rounded" required>
                            <option value="" disabled selected>Pilih Ruangan</option>
                            @foreach($ruangan as $r)
                                <option value="{{ $r->namaruang }}">{{ $r->namaruang }}</option>
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

        // Fungsi untuk memfilter dan update pilihan dosen
        function updateDosenOptions() {
            // Ambil nilai yang dipilih saat ini
            const koordinatorValue = $('#koordinator_nip').val();
            const pengampu1Value = $('#pengampu1_nip').val();
            const pengampu2Value = $('#pengampu2_nip').val();

            // Ambil semua data dosen dari select koordinator
            const allOptions = $('#koordinator_nip option').map(function() {
                return {
                    value: $(this).val(),
                    text: $(this).text()
                };
            }).get();

            // Filter dan update pengampu1
            const pengampu1Select = $('#pengampu1_nip');
            const currentPengampu1 = pengampu1Select.val();
            pengampu1Select.empty();
            pengampu1Select.append('<option value="">- Pilih Pengampu 1 -</option>');
            
            allOptions.forEach(option => {
                if (option.value && option.value !== koordinatorValue && option.value !== pengampu2Value) {
                    pengampu1Select.append(`<option value="${option.value}">${option.text}</option>`);
                }
            });
            if (currentPengampu1 && currentPengampu1 !== koordinatorValue && currentPengampu1 !== pengampu2Value) {
                pengampu1Select.val(currentPengampu1);
            }

            // Filter dan update pengampu2
            const pengampu2Select = $('#pengampu2_nip');
            const currentPengampu2 = pengampu2Select.val();
            pengampu2Select.empty();
            pengampu2Select.append('<option value="">- Pilih Pengampu 2 -</option>');
            
            allOptions.forEach(option => {
                if (option.value && option.value !== koordinatorValue && option.value !== pengampu1Value) {
                    pengampu2Select.append(`<option value="${option.value}">${option.text}</option>`);
                }
            });
            if (currentPengampu2 && currentPengampu2 !== koordinatorValue && currentPengampu2 !== pengampu1Value) {
                pengampu2Select.val(currentPengampu2);
            }
        }

        // Tambahkan event listener untuk setiap perubahan pada select
        $(document).ready(function() {
            $('#koordinator_nip, #pengampu1_nip, #pengampu2_nip').on('change', function() {
                updateDosenOptions();
            });
        });

        // Edit Jadwal
        function editJadwal(jadwalid) {
            // Ubah judul modal
            document.getElementById('modalTitle').textContent = 'Edit Jadwal';
            
            // Ambil data jadwal yang akan diedit
            fetch(`/kp_penjadwalan/edit/${jadwalid}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Data jadwal:', data); // untuk debugging
                    
                    // Isi form dengan data yang ada
                    $('#mata_kuliah_kode').val(data.kodemk).trigger('change'); // trigger change untuk update field terkait
                    $('#hari').val(data.hari);
                    $('#jam_mulai').val(data.jam_mulai);
                    $('#jam_selesai').val(data.jam_selesai);
                    $('#kelas').val(data.kelas);
                    $('#namaruang').val(data.namaruang);
                    $('#koordinator_nip').val(data.koordinator_nip);
                    $('#pengampu1_nip').val(data.pengampu1_nip);
                    $('#pengampu2_nip').val(data.pengampu2_nip);
                    $('#kuota').val(data.kuota);

                    // Tambahkan ID jadwal ke form
                    if ($('input[name="jadwalid"]').length) {
                        $('input[name="jadwalid"]').val(data.jadwalid);
                    } else {
                        $('#jadwalForm').append(`<input type="hidden" name="jadwalid" value="${data.jadwalid}">`);
                    }
                    
                    // Tampilkan modal
                    document.getElementById('tambahModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Gagal mengambil data jadwal', 'error');
                });
        }

        // Handle form submission
        $('#jadwalForm').submit(function(e) {
            e.preventDefault();
            
            const jadwalid = $('input[name="jadwalid"]').val();
            const url = jadwalid ? `/kp_penjadwalan/update/${jadwalid}` : "{{ route('kp.jadwal.store') }}";
            const method = jadwalid ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: jadwalid ? 'Jadwal berhasil diupdate' : 'Jadwal berhasil ditambahkan',
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire('Gagal', xhr.responseJSON?.message || 'Terjadi kesalahan', 'error');
                }
            });
        });

        // Reset form saat modal ditutup
        function closeTambahModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Jadwal';
            document.getElementById('jadwalForm').reset();
            $('input[name="jadwalid"]').remove();
            document.getElementById('tambahModal').classList.add('hidden');
        }

        function ajukanSemuaJadwal() {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin mengajukan semua jadwal?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Ajukan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('kaprodi.jadwal.ajukan-semua') }}",
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if(response.status == 'success') {
                                Swal.fire(
                                    'Berhasil!',
                                    'Semua jadwal telah diajukan.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                'Gagal mengajukan jadwal: ' + (xhr.responseJSON?.message || 'Terjadi kesalahan'),
                                'error'
                            );
                        }
                    });
                }
            });
        }

        function confirmDelete(jadwalid) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data jadwal ini akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('Deleting jadwal with ID:', jadwalid);
                    window.location.href = '/kp_penjadwalan/delete/' + jadwalid;
                }
            });
        }

        // Tambahkan listener untuk pesan flash
        document.addEventListener('DOMContentLoaded', function() {
            // Check for success message
            @if(session('success'))
                Swal.fire('Berhasil!', '{{ session('success') }}', 'success');
            @endif

            // Check for error message
            @if(session('error'))
                Swal.fire('Gagal!', '{{ session('error') }}', 'error');
            @endif
        });
    </script>
</body>
</html>
@endsection
