@extends('layouts.app')

@section('title', 'Jadwal')

@section('content')
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-image: url('{{ asset('image/bg_PASTI1.png') }}');
      background-size: cover;
      background-repeat: no-repeat;
      background-color: #f9f9fa
    }

    .table-responsive {
     display: block;
     width: 100%;
     overflow-x: auto;
     -webkit-overflow-scrolling: touch;
     -ms-overflow-style: -ms-autohiding-scrollbar
    }

    .table,
    .jsgrid .jsgrid-table {
     width: 100%;
     max-width: 100%;
     margin-bottom: 1rem;
     background-color: transparent
    }

    .table thead th,
    .jsgrid .jsgrid-table thead th {
     border-top: 0;
     border-bottom-width: 1px;
     font-weight: 500;
     font-size: .875rem;
     text-transform: uppercase
    }

    .table td,
    .jsgrid .jsgrid-table td {
     font-size: 0.875rem;
     padding: .875rem 0.9375rem;
    }

    .table tbody tr:hover,
    .jsgrid .jsgrid-table tbody tr:hover {
      background-color: #518b726b !important; 
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
  </style>
</head>
<body class="relative">
    <!-- Back Button -->
    <a href="{{ url()->previous() }}" class="absolute top-25 left-7 flex items-center gap-2 bg-teal-800 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition-all duration-300 shadow-lg hover:shadow-xl">
        <i class="fas fa-arrow-left"></i>
        <span class="font-medium">Kembali</span>
    </a>

    <!-- Container -->
    <div class="bg-white shadow-lg rounded-lg mx-auto max-w-7xl p-6 mt-1">
        <!-- Content -->
        <div id="content-jadwal" class="p-4">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-teal-800">JADWAL</h2>
                <div class="flex items-center">
                    <button class="btn bg-teal-500 btn-icon-text mr-2" onclick="addRow()">
                        <i class="fas fa-plus me-2 text-white"></i>
                        <strong class="text-white">Tambah Jadwal</strong>
                    </button>
                    <button class="btn btn-warning btn-icon-text mr-2">
                        <i class="far fa-calendar-alt me-2 text-white"></i>
                        <strong class="text-white">Set Jadwal</strong>
                    </button>
                </div>
            </div>
            <div class="border rounded-md mt-2 p-4">
                <div class="page-content page-container" id="page-content">
                    <div class="row container d-flex justify-content-center">
                        <div class="col-lg-12 grid-margin">
                            <div class="card border-0 shadow-none m-0 p-0">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="font-bold" style="width: 25%;">Keterangan</th>
                                                    <th class="font-bold" style="width: 25%;">Jadwal Mulai</th>
                                                    <th class="font-bold" style="width: 24%;">Jadwal Berakhir</th>
                                                    <th class="font-bold text-center " style="width: 15%;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="jadwalTableBody">
                                                <!-- Data akan diisi oleh JavaScript -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <form id="editForm" style="display:none" class="fixed inset-0 flex items-center justify-center">
        <div class="bg-white p-6 rounded-xl w-1/3" style="box-shadow: 0 -4px 35px rgba(0, 0, 0, 0.2)">
            <h2 class="text-lg font-semibold mb-4 text-center">Edit Jadwal</h2>
            <input type="hidden" id="editId" name="id">
            <div class="mb-4">
                <label class="block">Keterangan</label>
                <input type="text" id="editKeterangan" class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label class="block">Jadwal Mulai</label>
                <input type="date" id="editJadwalMulai" class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label class="block">Jadwal Berakhir</label>
                <input type="date" id="editJadwalBerakhir" class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEditForm()" class="mr-2 px-4 py-2 bg-teal-400/50 text-white rounded-lg">Cancel</button>
                <button type="button" onclick="saveEdit()" class="px-4 py-2 bg-teal-500 text-white rounded-lg">Save</button>
            </div>
        </div>
    </form>

    <script>
        // Data dummy
        const jadwalData = [
            { id: 1, keterangan: 'IRS Semester Ganjil', jadwalmulai: '2024-01-01', jadwalberakhir: '2024-01-15' },
            { id: 2, keterangan: 'IRS Semester Genap', jadwalmulai: '2024-06-01', jadwalberakhir: '2024-06-15' },
        ];

        // Render tabel
        function renderTable() {
            const tableBody = $('#jadwalTableBody');
            tableBody.empty();
            jadwalData.forEach(item => {
                tableBody.append(`
                    <tr>
                        <td>${item.keterangan}</td>
                        <td>${item.jadwalmulai}</td>
                        <td>${item.jadwalberakhir}</td>
                        <td>
                            <button class="bg-teal-500 text-white px-3 py-1.5 rounded-lg mr-2 text-sm" onclick="editRow(${item.id})">Edit</button>
                            <button class="bg-amber-400 text-white px-3 py-1.5 rounded-lg text-sm" onclick="deleteRow(${item.id})">Hapus</button>
                        </td>
                    </tr>
                `);
            });
        }

        // Tambah baris baru
        function addRow() {
            const newId = jadwalData.length ? jadwalData[jadwalData.length - 1].id + 1 : 1;
            const newJadwal = {
                id: newId,
                keterangan: 'Jadwal Baru',
                jadwalmulai: '2024-01-01',
                jadwalberakhir: '2024-01-15',
            };
            jadwalData.push(newJadwal);
            renderTable();
        }

        // Hapus baris
        function deleteRow(id) {
            const index = jadwalData.findIndex(item => item.id === id);
            if (index !== -1) {
                jadwalData.splice(index, 1);
                renderTable();
            }
        }

        // Edit form
        function editRow(id) {
            const item = jadwalData.find(data => data.id === id);
            if (item) {
                $('#editId').val(item.id);
                $('#editKeterangan').val(item.keterangan);
                $('#editJadwalMulai').val(item.jadwalmulai);
                $('#editJadwalBerakhir').val(item.jadwalberakhir);
                $('#editForm').show();
            }
        }

        // Save edit
        function saveEdit() {
            const id = parseInt($('#editId').val());
            const keterangan = $('#editKeterangan').val();
            const jadwalmulai = $('#editJadwalMulai').val();
            const jadwalberakhir = $('#editJadwalBerakhir').val();

            const index = jadwalData.findIndex(data => data.id === id);
            if (index !== -1) {
                jadwalData[index] = { id, keterangan, jadwalmulai, jadwalberakhir };
                renderTable();
                closeEditForm();
            }
        }

        // Close form
        function closeEditForm() {
            $('#editForm').hide();
        }

        // Inisialisasi
        $(document).ready(() => {
            renderTable();
        });
    </script>
</body>
</html>
@endsection