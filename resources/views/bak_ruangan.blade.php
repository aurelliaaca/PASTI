@extends('layouts.app')

@section('title', 'Ruangan')

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
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5); /* Gelap di belakang form */
            display: none; /* Sembunyikan overlay secara default */
            justify-content: flex center;
            align-items: center; /* Membuat konten berada di tengah */
            z-index: 999; /* Pastikan overlay berada di atas konten lainnya */
        }
        .popup-form {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Shadow atas dan bawah */
            width: 40%; /* Atur lebar form sesuai kebutuhan */
            max-width: 500px;
            padding: 20px;
            margin: 0 auto;
            animation: popup 0.5s ease-out; /* Animasi halus */
        }
        /* Animasi popup */
        @keyframes popup {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="bg-white shadow-lg rounded-lg">
        <div id="content-ruangan" class="p-4">
            <!-- Header dan Tombol -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-semibold text-teal-800 mb-0">RUANGAN</h1>
                <div class="flex items-center">
                    <button class="btn bg-teal-500 btn-icon-text mr-2 p-2 rounded-lg" onclick="addRow()">
                        <i class="fas fa-plus text-white"></i>
                        <strong class="text-white">Tambah Ruangan</strong>
                    </button>
                </div>
            </div>

            <!-- Tabel -->
            <div class="border rounded-md">
                <div class="table-responsive p-2 table-striped">
                    <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse">
                        <thead>
                            <tr>
                                <th class="font-bold" style="width: 30%;">Gedung</th>
                                <th class="font-bold" style="width: 30%;">Ruang</th>
                                <th class="font-bold" style="width: 25%;">Kapasitas</th>
                                <th class="font-bold text-center" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="ruanganTableBody">
                            @foreach($ruangans as $ruangan)
                                <tr id="ruangan_{{ $ruangan->id }}" class="odd:bg-teal-800/10 even:bg-white mb-2">
                                    <td>{{ $ruangan->gedung }}</td>
                                    <td>{{ $ruangan->ruang }}</td>
                                    <td>{{ $ruangan->kapasitas }}</td>
                                    <td class="text-center py-2">
                                        <button class="btn btn-sm btn-danger delete-btn bg-amber-400 w-20 text-white p-2 rounded-lg" onclick="deleteRow(this, {{ $ruangan->id }})">Hapus</button>
                                        <button class="btn btn-sm btn-primary edit-btn bg-teal-500 w-20 text-white p-2 rounded-lg" onclick="editRow(this, {{ $ruangan->id }})">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay untuk popup -->
    <div id="overlay" class="overlay">
        <div class="popup-form">
            <form id="tambahForm" action="{{ route('ruangan.store') }}" method="POST">
                @csrf
                <h2 class="text-lg font-semibold mb-4 text-center">Tambah Ruangan</h2>
                <div class="mb-4">
                    <label class="block">Gedung</label>
                    <input type="text" name="gedung" id="gedung" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block">Ruang</label>
                    <input type="text" name="ruang" id="ruang" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block">Kapasitas</label>
                    <input type="number" name="kapasitas" id="kapasitas" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeTambahForm()" class="mr-2 px-4 py-2 bg-teal-500 text-white rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-amber-400 text-white rounded-lg">Save</button>
                </div>
            </form>
        </div>
    </div>

<script>
    // Fungsi untuk menambah form
    function addRow() {
        document.getElementById('overlay').style.display = 'flex';
        $('#tambahForm').trigger('reset'); // Reset form
        $('#tambahForm').attr('action', '{{ route('ruangan.store') }}'); // Reset action URL untuk tambah
        $('#tambahForm').find('input[name="_method"]').remove(); // Remove hidden method field jika ada
    }

    // Fungsi untuk menutup form
    function closeTambahForm() {
        $('#overlay').hide(); // Menyembunyikan overlay
    }

    // Menangani pengiriman form untuk tambah atau edit ruangan
    // Fungsi untuk menangani pengiriman form
    $('#tambahForm').on('submit', function (e) {
        e.preventDefault();  // Mencegah pengiriman form default
        var formData = new FormData(this);
        var actionUrl = $(this).attr('action'); // Dapatkan URL form action

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    // Jika ini adalah update, kita perlu mengganti row yang ada
                    if (response.is_edit) {
                        var updatedRow = $('#ruangan_' + response.data.id);
                        updatedRow.find('td:eq(0)').text(response.data.gedung);
                        updatedRow.find('td:eq(1)').text(response.data.ruang);
                        updatedRow.find('td:eq(2)').text(response.data.kapasitas);
                    } else {
                        // Jika ini adalah tambah ruangan, tambahkan baris baru
                        var newRow = '<tr id="ruangan_' + response.data.id + '" class="odd:bg-teal-800/10 even:bg-white mb-2">' +
                            '<td>' + response.data.gedung + '</td>' +
                            '<td>' + response.data.ruang + '</td>' +
                            '<td>' + response.data.kapasitas + '</td>' +
                            '<td class="text-center py-2">' +
                                '<button class="btn btn-sm btn-danger delete-btn bg-amber-400 w-20 text-white p-2 rounded-lg" onclick="deleteRow(this, ' + response.data.id + ')">Hapus</button>' +
                                '<button class="btn btn-sm btn-primary edit-btn bg-teal-500 w-20 text-white p-2 rounded-lg" onclick="editRow(this, ' + response.data.id + ')">Edit</button>' +
                            '</td>' +
                        '</tr>';

                        $('#ruanganTableBody').append(newRow); // Menambahkan baris baru ke dalam tabel
                        closeTambahForm(); // Menutup form setelah data berhasil ditambahkan
                    }
                } else {
                    alert('Terjadi kesalahan, data gagal disimpan.');
                }
            },
            error: function (error) {
                console.log(error);
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });
    });

    // Fungsi untuk mengedit baris data
    function editRow(button, id) {
        var row = $(button).closest('tr');
        var gedung = row.find('td:eq(0)').text();
        var ruang = row.find('td:eq(1)').text();
        var kapasitas = row.find('td:eq(2)').text();

        // Menampilkan popup form untuk edit
        document.getElementById('overlay').style.display = 'flex';
        $('#tambahForm').trigger('reset'); // Reset form
        $('#tambahForm').attr('action', '{{ route('ruangan.update', ':id') }}'.replace(':id', id)); // Set URL untuk update
        $('#tambahForm').find('input[name="_method"]').remove(); // Remove method hidden field jika ada
        $('#tambahForm').append('<input type="hidden" name="_method" value="PUT">'); // Menambahkan metode PUT untuk update

        // Mengisi form dengan data yang ada
        $('#gedung').val(gedung);
        $('#ruang').val(ruang);
        $('#kapasitas').val(kapasitas);
    }

    // Fungsi untuk menghapus baris
    function deleteRow(button, id) {
        var row = $(button).closest('tr');

        if (confirm('Apakah Anda yakin ingin menghapus ruangan ini?')) {
            $.ajax({
                url: '{{ route('ruangan.destroy', ':id') }}'.replace(':id', id),
                type: 'DELETE',
                success: function (response) {
                    if (response.success) {
                        row.remove(); // Menghapus baris jika berhasil
                    } else {
                        alert('Terjadi kesalahan, data gagal dihapus.');
                    }
                },
                error: function (error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat menghapus data.');
                }
            });
        }
    }
</script>
</body>
</html>
@endsection