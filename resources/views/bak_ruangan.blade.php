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
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }
        .popup-form {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 40%;
            max-width: 500px;
            padding: 20px;
            margin: 0 auto;
            animation: popup 0.5s ease-out;
        }
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
<body class="min-h-screen relative">
    <div class="bg-white shadow-lg rounded-lg">
        <div id="content-ruangan" class="p-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-semibold text-teal-800 mb-0">RUANGAN</h1>
                <div class="flex items-center">
                    <button class="btn bg-teal-500 btn-icon-text mr-2 p-2 rounded-lg" onclick="addRow()">
                        <i class="fas fa-plus text-white"></i>
                        <strong class="text-white">Tambah Ruangan</strong>
                    </button>
                </div>
            </div>

            <div class="border rounded-md overflow-x-auto">
                <div class="table-responsive p-2">
                    <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse">
                        <thead>
                            <tr>
                                <th class="font-bold text-sm px-4 py-2" style="width: 25%;">Gedung</th>
                                <th class="font-bold text-sm px-4 py-2" style="width: 25%;">Ruang</th>
                                <th class="font-bold text-sm px-4 py-2" style="width: 25%;">Kapasitas</th>
                                <th class="font-bold text-sm px-4 py-2" style="width: 25%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="ruanganTableBody">
                            @foreach($paginatedRuangans as $ruangan)
                                <tr id="ruangan_{{ $ruangan->id }}" class="odd:bg-teal-800/10 even:bg-white mb-2 hover:bg-green-200 cursor-pointer">
                                    <td class="text-sm px-4 py-2">{{ $ruangan->gedung }}</td>
                                    <td class="text-sm px-4 py-2">{{ $ruangan->namaruang }}</td>
                                    <td class="text-sm px-4 py-2">{{ $ruangan->kapasitas }}</td>
                                    <td class="text-sm px-4 py-2 text-center">
                                        @if($ruangan->status !== 'sudah disetujui')
                                            <button class="btn btn-sm btn-danger delete-btn bg-amber-400 w-20 text-white p-2 rounded-lg" onclick="deleteRuangan({{ $ruangan->id }})">Hapus</button>
                                            <button class="btn btn-sm btn-primary edit-btn bg-teal-500 w-20 text-white p-2 rounded-lg" onclick="editRow(this, {{ $ruangan->id }})">Edit</button>
                                        @else
                                            <button class="btn btn-secondary" disabled>Hapus</button>
                                            <button class="btn btn-secondary" disabled>Edit</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                    <div class="flex flex-1 justify-between sm:hidden">
                        @if ($paginatedRuangans->onFirstPage())
                            <span class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 cursor-default">Previous</span>
                        @else
                            <a href="{{ $paginatedRuangans->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                        @endif

                        @if ($paginatedRuangans->hasMorePages())
                            <a href="{{ $paginatedRuangans->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                        @else
                            <span class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 cursor-default">Next</span>
                        @endif
                    </div>
                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing
                                <span class="font-medium">{{ $paginatedRuangans->firstItem() }}</span>
                                to
                                <span class="font-medium">{{ $paginatedRuangans->lastItem() }}</span>
                                of
                                <span class="font-medium">{{ $paginatedRuangans->total() }}</span>
                                results
                            </p>
                        </div>
                        <div>
                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                {{-- Previous Page Link --}}
                                @if ($paginatedRuangans->onFirstPage())
                                    <span class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 cursor-default">
                                        <span class="sr-only">Previous</span>
                                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @else
                                    <a href="{{ $paginatedRuangans->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                        <span class="sr-only">Previous</span>
                                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($paginatedRuangans->links()->elements as $element)
                                    {{-- "Three Dots" Separator --}}
                                    @if (is_string($element))
                                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300">{{ $element }}</span>
                                    @endif

                                    {{-- Array Of Links --}}
                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $paginatedRuangans->currentPage())
                                                <span class="relative z-10 inline-flex items-center bg-teal-500 px-4 py-2 text-sm font-semibold text-white">{{ $page }}</span>
                                            @else
                                                <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">{{ $page }}</a>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($paginatedRuangans->hasMorePages())
                                    <a href="{{ $paginatedRuangans->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                        <span class="sr-only">Next</span>
                                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @else
                                    <span class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 cursor-default">
                                        <span class="sr-only">Next</span>
                                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @endif
                            </nav>
                        </div>
                    </div>
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
                    <label class="block">Nama Ruang</label>
                    <input type="text" name="namaruang" id="namaruang" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block">Gedung</label>
                    <input type="text" name="gedung" id="gedung" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block">Kapasitas</label>
                    <input type="number" name="kapasitas" id="kapasitas" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeTambahForm()" class="mr-2 px-4 py-2 bg-teal-500 text-white rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-amber-400 text-white rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteConfirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h2>
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus data ini?</p>
            <div class="flex justify-end">
                <button type="button" class="mr-2 px-4 py-2 bg-teal-500 text-white rounded-lg" onclick="closeDeleteModal()">Batal</button>
                <button type="button" class="px-4 py-2 bg-amber-400 text-white rounded-lg" onclick="confirmDelete()">Hapus</button>
            </div>
        </div>
    </div>

<script>
    let deleteId = null;

    function deleteRuangan(id) {
        deleteId = id;
        document.getElementById('deleteConfirmModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteConfirmModal').classList.add('hidden');
    }

    function confirmDelete() {
        if (deleteId !== null) {
            $.ajax({
                url: `/ruangan/${deleteId}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showAlert('Data berhasil dihapus!', 'success');
                        document.querySelector(`#ruanganTableBody tr[data-id="${deleteId}"]`).remove();
                    } else {
                        showAlert('Terjadi kesalahan saat menghapus data!', 'danger');
                    }
                    closeDeleteModal();
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                    showAlert('Terjadi kesalahan saat menghapus data!', 'danger');
                    closeDeleteModal();
                }
            });
        }
    }

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

    // Menangani perubahan pada input "namaruang"
    $('#namaruang').on('input', function() {
        var namaruangValue = $(this).val();
        if (namaruangValue.length > 0) {
            var gedungValue = namaruangValue.charAt(0).toUpperCase(); // Ambil huruf pertama dan ubah ke huruf besar
            $('#gedung').val(gedungValue); // Isi otomatis input "Gedung"
        } else {
            $('#gedung').val(''); // Kosongkan input "Gedung" jika "namaruang" kosong
        }
    });

    // Menangani pengiriman form untuk tambah atau edit ruangan
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
                    if (response.is_edit) {
                        var updatedRow = $('#ruangan_' + response.data.id);
                        var currentRuang = updatedRow.find('td:eq(1)').text();

                        // Cek apakah nama ruang berbeda
                        if (currentRuang !== response.data.namaruang) {
                            updatedRow.find('td:eq(0)').text(response.data.gedung);
                            updatedRow.find('td:eq(1)').text(response.data.namaruang);
                            updatedRow.find('td:eq(2)').text(response.data.kapasitas);
                            showAlert('Ruangan berhasil diedit!', 'success'); // Alert sukses edit
                        } else {
                            showAlert('Nama ruang harus berbeda untuk mengedit.', 'warning');
                            return;
                        }
                    } else {
                        // Jika ini adalah tambah ruangan, tambahkan baris baru
                        var newRow = '<tr id="ruangan_' + response.data.id + '" class="odd:bg-teal-800/10 even:bg-white mb-2">';
                        newRow += '<td>' + response.data.gedung + '</td>';
                        newRow += '<td>' + response.data.namaruang + '</td>';
                        newRow += '<td>' + response.data.kapasitas + '</td>';
                        newRow += '<td class="text-center py-2">';
                        newRow += '<button class="btn btn-sm btn-danger delete-btn bg-amber-400 w-20 text-white p-2 rounded-lg mr-1" onclick="deleteRuangan(' + response.data.id + ')">Hapus</button>';
                        newRow += '<button class="btn btn-sm btn-primary edit-btn bg-teal-500 w-20 text-white p-2 rounded-lg" onclick="editRow(this, ' + response.data.id + ')">Edit</button>';
                        newRow += '</td></tr>';

                        $('#ruanganTableBody').append(newRow); // Menambahkan baris baru ke dalam tabel
                        showAlert('Ruangan berhasil ditambahkan!', 'success'); // Alert sukses tambah
                    }
                    closeTambahForm(); // Menutup form setelah proses selesai
                } else {
                    showAlert(response.message || 'Terjadi kesalahan, silakan coba lagi.', 'danger');
                }
            },
            error: function (xhr, status, error) {
                showAlert('Terjadi kesalahan, silakan coba lagi.', 'danger');
            }
        });
    });

    // Fungsi untuk mengedit baris data
    function editRow(button, id) {
        var row = $(button).closest('tr');
        var ruang = row.find('td:eq(1)').text();
        var kapasitas = row.find('td:eq(2)').text();

        // Menampilkan popup form untuk edit
        $('#overlay').show();
        $('#ruang').val(ruang);
        $('#kapasitas').val(kapasitas);
        $('#tambahForm').attr('action', '/ruang/' + id); // Update action URL untuk edit
        $('#tambahForm').append('<input type="hidden" name="_method" value="PUT">'); // Menambahkan metode PUT untuk update
        document.getElementById('overlay').style.display = 'flex';

        // Isi otomatis input "Gedung" berdasarkan "Ruang"
        var gedungValue = ruang.charAt(0).toUpperCase();
        $('#gedung').val(gedungValue).prop('readonly', true); // Kunci input "Gedung"
    }

    // Fungsi untuk menampilkan alert dengan gaya Tailwind CSS
    function showAlert(message, type) {
        const alertDiv = document.createElement('div');
        const alertColors = {
            success: 'bg-green-100 border-green-400 text-green-700',
            warning: 'bg-yellow-100 border-yellow-400 text-yellow-700',
            danger: 'bg-red-100 border-red-400 text-red-700'
        };
        alertDiv.className = `border-l-4 p-4 mb-4 ${alertColors[type]} flex items-center`;
        alertDiv.setAttribute('role', 'alert');
        alertDiv.innerHTML = `
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3a1 1 0 002 0V7zm-1 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
            </svg>
            <span>${message}</span>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-transparent text-current rounded-lg focus:ring-2 focus:ring-gray-400 p-1 hover:bg-gray-200 inline-flex h-8 w-8" aria-label="Close" onclick="this.parentElement.remove();">
                <span aria-hidden="true">&times;</span>
            </button>
        `;
        const contentRuangan = document.getElementById('content-ruangan');
        contentRuangan.insertBefore(alertDiv, contentRuangan.firstChild);

        setTimeout(() => {
            alertDiv.remove();
        }, 2000);
    }
</script>
</body>
</html>
@endsection