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
            background-image: linear-gradient(to right, #02979D, #FFBB1C);
            background-size: cover;
            background-repeat: repeat;
            height: max-content;
            margin: 0;
        }
    
    .table-responsive {
      width: 100%;
    }
    .table {
      width: 100%;
      table-layout: fixed;
      margin-bottom: 0;
    }
    .table th, .table td {
      word-wrap: break-word;
      text-align: center; /* Posisi horizontal di tengah */
      vertical-align: middle; /* Posisi vertikal di tengah */
      border-top: none;
    }
    
    .card-body {
      padding: 0;
    }

  </style>
</head>
<body class="min-h-screen">

  <!-- Container -->
<div class="bg-white shadow-lg rounded-lg">
  <div id="content-jadwal" class="p-4">
    <!-- Header dan Tombol -->
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-xl font-semibold text-teal-800 items-center mb-0">JADWAL</h1>
      <div class="flex items-center">
        <button class="btn bg-teal-500 btn-icon-text mr-2" onclick="addRow()">
          <i class="fas fa-plus text-white"></i>
          <strong class="text-white">Tambah Jadwal</strong>
        </button>
        <button class="btn btn-warning btn-icon-text">
          <i class="far fa-calendar-alt text-white"></i>
          <strong class="text-white">Set Jadwal</strong>
        </button>
      </div>
    </div>
    
    <!-- Tabel -->
    <div class="border rounded-md items-center">
      <div class="page-content page-container" id="page-content">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="card border-0">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped text-teal-800">
                    <thead>
                      <tr>
                        <th class="font-bold" style="width: 20%;">Keterangan</th>
                        <th class="font-bold" style="width: 25%;">Jadwal Mulai</th>
                        <th class="font-bold" style="width: 24%;">Jadwal Berakhir</th>
                        <th class="font-bold text-center" style="width: 15%;">Aksi</th>
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
    const jadwalData = [
      { id: 1, keterangan: 'IRS Semester Ganjil', jadwalmulai: '2024-01-01', jadwalberakhir: '2024-01-15' },
      { id: 2, keterangan: 'IRS Semester Genap', jadwalmulai: '2024-06-01', jadwalberakhir: '2024-06-15' },
    ];

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

    function addRow() {
      const newId = jadwalData.length ? jadwalData[jadwalData.length - 1].id + 1 : 1;
      const newJadwal = { id: newId, keterangan: 'Jadwal Baru', jadwalmulai: '2024-01-01', jadwalberakhir: '2024-01-15' };
      jadwalData.push(newJadwal);
      renderTable();
    }

    function deleteRow(id) {
      const index = jadwalData.findIndex(item => item.id === id);
      if (index !== -1) {
        jadwalData.splice(index, 1);
        renderTable();
      }
    }

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

    function closeEditForm() {
      $('#editForm').hide();
    }

    $(document).ready(() => {
      renderTable();
    });
  </script>
</body>
@endsection
