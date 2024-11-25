@extends('layouts.app')

@section('title', 'Bak Jadwal')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Pengisian IRS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: linear-gradient(to right, #02979D, #FFBB1C); /* gradien dari teal ke amber */
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh; /* membuat tinggi halaman 100% dari viewport */
            margin: 0; /* menghapus margin default dari body */
        }
    </style>
</head>

<body class="min-h-screen bg-teal-800/80">
        <!-- Main Content -->
        <div class="bg-teal-800 text-teal-800 p-4 rounded-lg">
            <div class="overflow-x-auto rounded-xl">
                <table class="table-auto w-full text-center rounded-xl border-collapse">
                    <thead>
                        <tr class="bg-teal-100/80">
                            <th class="px-4 py-2 border-r border-teal-500">Keterangan</th>
                            <th class="px-4 py-2 border-r border-teal-500">Jadwal Mulai</th>
                            <th class="px-4 py-2 border-r border-teal-500">Jadwal Berakhir</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="jadwalTableBody">
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between mt-4">
                <button class="py-2 px-5 bg-teal-500 text-white rounded-lg" onclick="addRow()">Tambah Jadwal</button>
                <button class="py-2 px-5 bg-amber-400 text-white rounded-lg">Set Jadwal</button>
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
            <div class="flex justify-end ">
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
                    <tr data-id="${item.id}" class="bg-white">
                        <td class="px-4 py-2 border-r border-gray-300">${item.keterangan}</td>
                        <td class="px-4 py-2 border-r border-gray-300">${item.jadwalmulai}</td>
                        <td class="px-4 py-2 border-r border-gray-300">${item.jadwalberakhir}</td>
                        <td class="px-4 py-2">
                            <button class="bg-teal-500 text-white px-4 py-2 rounded-lg" onclick="editRow(${item.id})">Edit</button>
                            <button class="bg-amber-400 text-white px-4 py-2 rounded-lg" onclick="deleteRow(${item.id})">Hapus</button>
                        </td>500
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