@extends('layouts.app')

@section('title', 'Periode')

@section('content')
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <div id="content-jadwal" class="p-4">
            <!-- Header dan Tombol -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-semibold text-teal-800 mb-0">JADWAL</h1>
                <div class="flex items-center">
                    <button class="btn bg-teal-500 btn-icon-text mr-2 p-2 rounded-lg" onclick="addRow()">
                        <i class="fas fa-plus text-white"></i>
                        <strong class="text-white">Tambah Jadwal</strong>
                    </button>
                </div>
            </div>

            <!-- Tabel -->
            <div class="border rounded-md">
                <div class="table-responsive p-2 table-striped">
                    <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse">
                        <thead>
                            <tr>
                                <th class="font-bold" style="width: 20%;">Keterangan</th>
                                <th class="font-bold" style="width: 25%;">Jadwal Mulai</th>
                                <th class="font-bold" style="width: 24%;">Jadwal Berakhir</th>
                                <th class="font-bold text-center" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="jadwalTableBody">
                            @foreach($periode as $jadwal)
                                <tr id="jadwal_{{ $jadwal->id }}" class="odd:bg-teal-800/10 even:bg-white mb-2">
                                    <td>{{ $jadwal->keterangan }}</td>
                                    <td>{{ $jadwal->jadwal_mulai }}</td>
                                    <td>{{ $jadwal->jadwal_berakhir }}</td>
                                    <td class="text-center py-2">
                                        <button class="btn btn-sm btn-danger delete-btn bg-amber-400 w-20 text-white p-2 rounded-lg" onclick="deleteRow(this, {{ $jadwal->id }})">Hapus</button>
                                        <button 
                                            class="btn btn-sm btn-primary edit-btn bg-teal-500 w-20 text-white p-2 rounded-lg" 
                                            onclick="editRow(this, {{ $jadwal->id }})">
                                            Edit
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
    
    <!-- Overlay untuk popup -->
    <div id="overlay" class="overlay">
        <div class="popup-form">
            <form id="tambahForm" action="{{ route('simpanPeriode') }}" method="POST">
                @csrf
                <!-- Placeholder untuk input hidden _method (ditambahkan secara dinamis oleh JavaScript) -->
                <h2 class="text-lg font-semibold mb-4 text-center">Tambah Jadwal Periode</h2>
                <div class="mb-4">
                    <label class="block">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block">Jadwal Mulai</label>
                    <input type="date" name="jadwal_mulai" id="jadwal_mulai" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block">Jadwal Berakhir</label>
                    <input type="date" name="jadwal_berakhir" id="jadwal_berakhir" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeTambahForm()" class="mr-2 px-4 py-2 bg-teal-500 text-white rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-amber-400 text-white rounded-lg">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Popup untuk notifikasi berhasil -->
    <div id="successPopup" class="overlay">
    <div class="popup-form text-center">
        <h2 class="text-lg font-semibold mb-4 text-green-700">Berhasil!</h2>
        <p class="text-gray-700">Periode berhasil diatur.</p>
        <button onclick="closeSuccessPopup()" class="mt-4 px-4 py-2 bg-teal-500 text-white rounded-lg">Tutup</button>
    </div>
</div>


<script>
    // Fungsi untuk menambah form
    function addRow() {
        document.getElementById('overlay').style.display = 'flex';
        $('#tambahForm').trigger('reset'); // Reset form
            $('#tambahForm').attr('action', '{{ route('simpanPeriode') }}'); // Reset action URL untuk tambah
            $('#tambahForm').find('input[name="_method"]').remove(); // Remove hidden method field jika ada
    }

    // Fungsi untuk menutup form
    function closeTambahForm() {
        $('#overlay').hide(); // Menyembunyikan overlay
    }

    function showSuccessPopup() {
        document.getElementById('successPopup').style.display = 'flex';
    }

    function closeSuccessPopup() {
        document.getElementById('successPopup').style.display = 'none';
    }

    document.getElementById('tambahForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Mencegah form submit secara default

        const form = this;
        const formData = new FormData(form);
        var actionUrl = $(this).attr('action');

        // Kirim data menggunakan AJAX
        fetch(form.action, {
            url: actionUrl,
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Tampilkan popup sukses
                    showSuccessPopup();

                    // Reset form
                    form.reset();

                    // Tutup form tambah
                    closeTambahForm();
                    
                } else {
                    alert('Gagal menyimpan data: ' + (data.message || 'Kesalahan tidak diketahui.'));
                }
                
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data.');
            });
    });


    // Fungsi untuk mengedit periode
    function editRow(button, id) {
        // Ambil elemen baris (tr) berdasarkan tombol yang ditekan
        var row = $(button).closest('tr');

        // Ambil data dari kolom dalam baris
        var keterangan = row.find('td:eq(0)').text();
        var jadwalMulai = row.find('td:eq(1)').text();
        var jadwalBerakhir = row.find('td:eq(2)').text();

        // Tampilkan data di form edit
        $('#overlay').show();
        $('#keterangan').val(keterangan);
        $('#jadwal_mulai').val(jadwalMulai);
        $('#jadwal_berakhir').val(jadwalBerakhir);

        // Update data periode melalui AJAX ketika tombol submit ditekan
        $('#tambahForm').off('submit').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            

            $.ajax({
                url: `/periode/${id}`, // URL endpoint untuk update periode
                type: 'PUT', // Method PUT untuk mengupdate data
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        // Update baris tabel dengan data baru
                        row.find('td:eq(0)').text(response.data.keterangan);
                        row.find('td:eq(1)').text(response.data.jadwal_mulai);
                        row.find('td:eq(2)').text(response.data.jadwal_berakhir);
                        $('#tambahForm').attr('action', `/periode/${id}`);

                        showAlert('Periode berhasil diperbarui!', 'success');
                        closeTambahForm();
                    } else {
                        showAlert(response.message || 'Gagal memperbarui data.', 'danger');
                    }
                },
                error: function (xhr) {
                    showAlert('Terjadi kesalahan saat memperbarui data.', 'danger');
                    console.error(xhr.responseText);
                }
            });
        });

        // Tampilkan popup form untuk proses edit
        document.getElementById('overlay').style.display = 'flex';
    }


    // Fungsi untuk menghapus jadwal
    function deleteRow(button, id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        fetch(`/periode/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Hapus baris tabel
                const row = button.closest('tr');
                row.remove();

                alert('Data berhasil dihapus.');
            } else {
                alert('Gagal menghapus data: ' + (data.message || 'Kesalahan tidak diketahui.'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus data.');
        });
    }
}
</script>
</body>
</html>
@endsection