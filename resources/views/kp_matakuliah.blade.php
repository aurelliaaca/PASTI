@extends('layouts.app')

@section('title', 'KP Matakuliah')

@section('content')
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
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
<body class="min-h-screen bg-gradient-to-r from-teal-600 to-amber-500">

        <div class="bg-white shadow-lg rounded-lg">
            <div id="content-matakuliah" class="p-4">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-xl font-semibold text-teal-800 mb-0">MATA KULIAH</h1>
                    <div class="flex items-center">
                        <button class="btn bg-teal-500 btn-icon-text mr-2 p-2 rounded-lg" onclick="showTambahModal()">
                            <i class="fas fa-plus text-white"></i>
                            <strong class="text-white">Tambah Mata Kuliah</strong>
                        </button>
                    </div>
                </div>

                <!-- Tabel -->
                <div class="border rounded-md overflow-x-auto">
                    <div class="table-responsive p-2">
                        <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse">
                            <thead>
                                <tr>
                                    <th class="font-bold text-sm px-4 py-2">No</th>
                                    <th class="font-bold text-sm px-4 py-2">Kode</th>
                                    <th class="font-bold text-sm px-4 py-2">Mata Kuliah</th>
                                    <th class="font-bold text-sm px-4 py-2">Semester</th>
                                    <th class="font-bold text-sm px-4 py-2">SKS</th>
                                    <th class="font-bold text-sm px-4 py-2">Status</th>
                                    <th class="font-bold text-sm px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matakuliah as $index => $mk)
                                <tr class="odd:bg-teal-800/10 even:bg-white mb-2 hover:bg-green-200 cursor-pointer">
                                    <td class="text-sm px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="text-sm px-4 py-2">{{ $mk->kode }}</td>
                                    <td class="text-sm px-4 py-2">{{ $mk->nama }}</td>
                                    <td class="text-sm px-4 py-2">{{ $mk->semester }}</td>
                                    <td class="text-sm px-4 py-2">{{ $mk->sks }}</td>
                                    <td class="text-sm px-4 py-2">{{ $mk->status }}</td>
                                    <td class="text-sm px-4 py-2 text-center">
                                        <button onclick="editMataKuliah('{{ $mk->kode }}', '{{ $mk->nama }}', '{{ $mk->semester }}', '{{ $mk->sks }}', '{{ $mk->status }}')" 
                                                class="btn btn-sm btn-primary edit-btn bg-teal-500 w-20 text-white p-2 rounded-lg">
                                            Edit
                                        </button>
                                        <button onclick="hapusMataKuliah('{{ $mk->kode }}')" 
                                                class="btn btn-sm btn-danger delete-btn bg-amber-400 w-20 text-white p-2 rounded-lg">
                                            Hapus
                                        </button>
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

    <!-- Modal Form Tambah atau Edit Mata Kuliah -->
    <div id="tambahModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg w-1/3 relative">
            <button onclick="closeTambahModal()" class="absolute top-2 right-2 text-2xl text-gray-500 hover:text-gray-700">&times;</button>
            <h2 id="modalTitle" class="text-xl font-bold text-teal-800 mb-4">Tambah Mata Kuliah</h2>
            <form action="{{ route('matakuliah.store') }}" method="POST" class="space-y-4" id="matakuliahFormTambah">
                @csrf
                <div class="flex flex-col">
                    <label for="kode" class="font-medium">Kode Mata Kuliah</label>
                    <input type="text" name="kode" id="kode" class="px-3 py-2 border rounded" required placeholder="Kode Mata Kuliah" oninput="checkDuplicateMatkul()">
                    <span id="kode-error" class="text-red-500 text-sm hidden">Kode sudah ada</span>
                </div>
                <div class="flex flex-col">
                    <label for="nama" class="font-medium">Nama Mata Kuliah</label>
                    <input type="text" name="nama" id="nama" class="px-3 py-2 border rounded" required placeholder="Nama Mata Kuliah" oninput="checkDuplicateMatkul()">
                    <span id="nama-error" class="text-red-500 text-sm hidden">Nama sudah ada</span>
                </div>
                <div class="flex flex-col">
                    <label for="semester" class="font-medium">Semester</label>
                    <input type="number" name="semester" id="semester" class="px-3 py-2 border rounded" required placeholder="Semester">
                </div>
                <div class="flex flex-col">
                    <label for="sks" class="font-medium">SKS</label>
                    <input type="number" name="sks" id="sks" class="px-3 py-2 border rounded" required placeholder="SKS">
                </div>
                <div class="flex flex-col">
                    <label for="status" class="font-medium">Status</label>
                    <select name="status" id="status" class="px-3 py-2 border rounded" required>
                        <option value="wajib">Wajib</option>
                        <option value="pilihan">Pilihan</option>
                    </select>
                </div>
                <button type="submit" class="bg-teal-700 text-white px-4 py-2 rounded hover:bg-teal-800 mt-4">Tambah Mata Kuliah</button>
            </form>
        </div>
    </div>

    <!-- Modal Form Edit Mata Kuliah -->
    <div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg w-1/3 relative">
            <button onclick="closeEditModal()" class="absolute top-2 right-2 text-2xl text-gray-500 hover:text-gray-700">&times;</button>
            <h2 id="modalTitleEdit" class="text-xl font-bold text-teal-800 mb-4">Edit Mata Kuliah</h2>
            <form action="" method="POST" class="space-y-4" id="matakuliahFormEdit">
                @csrf
                @method('PUT')
                <div class="flex flex-col">
                    <label for="kode" class="font-medium">Kode Mata Kuliah</label>
                    <input type="text" name="kode" id="kodeEdit" class="px-3 py-2 border rounded" required placeholder="Kode Mata Kuliah" readonly>
                </div>
                <div class="flex flex-col">
                    <label for="nama" class="font-medium">Nama Mata Kuliah</label>
                    <input type="text" name="nama" id="namaEdit" class="px-3 py-2 border rounded" required placeholder="Nama Mata Kuliah" readonly>
                </div>
                <div class="flex flex-col">
                    <label for="semester" class="font-medium">Semester</label>
                    <input type="number" name="semester" id="semesterEdit" class="px-3 py-2 border rounded" required placeholder="Semester">
                </div>
                <div class="flex flex-col">
                    <label for="sks" class="font-medium">SKS</label>
                    <input type="number" name="sks" id="sksEdit" class="px-3 py-2 border rounded" required placeholder="SKS">
                </div>
                <div class="flex flex-col">
                    <label for="status" class="font-medium">Status</label>
                    <select name="status" id="statusEdit" class="px-3 py-2 border rounded" required>
                        <option value="wajib">Wajib</option>
                        <option value="pilihan">Pilihan</option>
                    </select>
                </div>
                <button type="submit" class="bg-teal-700 text-white px-4 py-2 rounded hover:bg-teal-800 mt-4">Perbarui Mata Kuliah</button>
            </form>
        </div>
    </div>

    <script>
        function showTambahModal() {
            $('#tambahModal').removeClass('hidden');
            $('#editModal').addClass('hidden');
            $('#matakuliahFormTambah')[0].reset();
            $('#modalTitle').text('Tambah Mata Kuliah');
            
        }

        function closeTambahModal() {
            $('#tambahModal').addClass('hidden');
        }

        function closeEditModal() {
            $('#editModal').addClass('hidden');
        }

        function editMataKuliah(kode, nama, semester, sks, status) {
            $('#editModal').removeClass('hidden');
            $('#tambahModal').addClass('hidden');
            $('#kodeEdit').val(kode);
            $('#namaEdit').val(nama);
            $('#semesterEdit').val(semester);
            $('#sksEdit').val(sks);
            $('#statusEdit').val(status);
            $('#matakuliahFormEdit').attr('action', '{{ route('matakuliah.update', ':kode') }}'.replace(':kode', kode));
        }

        $('#matakuliahFormTambah').on('submit', function(event) {
            event.preventDefault();
            var form = $(this);
            var formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Tambahkan CSRF Token
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Berhasil!', 'Mata kuliah berhasil ditambahkan.', 'success')
                        .then(() => location.reload());
                    } else {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menambahkan mata kuliah.', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', error);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat mengirim data.', 'error');
                }
            });
        });

        $('#matakuliahFormEdit').on('submit', function(event) {
            event.preventDefault();
            var form = $(this);
            var formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Tambahkan CSRF Token
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Berhasil!', 'Mata kuliah berhasil diperbarui.', 'success')
                        .then(() => location.reload());
                    } else {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat memperbarui mata kuliah.', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', error);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat mengirim data.', 'error');
                }
            });
        });

        function hapusMataKuliah(kode) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data mata kuliah ini akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
            }).then((result) => {
                if (result.isConfirmed) {
                    var deleteUrl = '{{ route('matakuliah.destroy', ':kode') }}'.replace(':kode', kode);
                    fetch(deleteUrl, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Dihapus!', 'Mata kuliah berhasil dihapus.', 'success')
                            .then(() => location.reload());
                        } else {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus mata kuliah.', 'error');
                        }
                    });
                }
            });
        }
        function checkDuplicateMatkul() {
            // Ambil nilai kode dan nama mata kuliah dari input
            var kode = $('#kode').val();
            var nama = $('#nama').val();

            // Kirim request untuk memeriksa duplikasi
            $.ajax({
                url: "{{ route('matakuliah.checkDuplicateMK') }}",  // Route untuk cek duplikasi
                method: "POST",
                data: {
                    kode: kode,
                    nama: nama,
                    _token: $('meta[name="csrf-token"]').attr('content')  // Kirim CSRF token
                },
                success: function(response) {
                    // Jika ada duplikasi, tampilkan pesan error
                    if (response.exists) {
                        if (response.exists_kode) {
                            $('#kode-error').removeClass('hidden');
                        } else {
                            $('#kode-error').addClass('hidden');
                        }

                        if (response.exists_nama) {
                            $('#nama-error').removeClass('hidden');
                        } else {
                            $('#nama-error').addClass('hidden');
                        }

                        // Disable tombol submit jika ada duplikasi
                        if (response.exists_kode || response.exists_nama) {
                            $('#matakuliahFormTambah button').attr('disabled', true);
                        } else {
                            $('#matakuliahFormTambah button').attr('disabled', false);
                        }
                    }
                }
            });
        }

    </script>
</body>
</html>
@endsection
