@extends('layouts.app')

@section('title', 'Persetujuan Ruangan')

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
    </style>
</head>
<body class="min-h-screen">
    <div class="bg-white shadow-lg rounded-lg">
        <div id="content-jadwal" class="p-4">
            <!-- Alert Sukses -->
            <div id="success-alert" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">Semua ruangan untuk program studi tersebut telah disetujui.</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.classList.add('hidden')">
                        <title>Close</title>
                        <path d="M14.348 5.652a1 1 0 0 0-1.414 0L10 8.586 7.066 5.652a1 1 0 1 0-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 1 0 1.414 1.414L10 11.414l2.934 2.934a1 1 0 0 0 1.414-1.414L11.414 10l2.934-2.934a1 1 0 0 0 0-1.414z"/>
                    </svg>
                </span>
            </div>

            <!-- Header dan Tombol -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-semibold text-teal-800 mb-0">PERSETUJUAN RUANGAN</h1>
            </div>

            <!-- Tabel -->
            <div class="border rounded-md p-2">
                <div class="table-responsive">
                    <table class="table table-striped w-full text-teal-800 font-black">
                        <tbody>
                        @foreach($programStudiList as $index => $programStudi)
                        <tr>
                            <td class="pb-2 pt-0">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <button class="toggle-button bg-teal-500 text-white w-10 py-2 rounded-lg mr-1" data-id="{{ $index }}">+</button>
                                        {{ $programStudi }}
                                    </div>
                                    <!-- Form untuk Tombol Setujui Semua -->
                                    <form action="{{ route('setujuiSemua') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="program_studi_id" value="{{ $index }}">
                                        <button type="submit" id="approveBtn-{{ $index }}" class="btn bg-teal-500 btn-icon-text mr-2 p-2 rounded-lg flex justify-end items-center hidden">
                                            <i class="fa fa-check text-white mr-2"></i>
                                            <strong class="text-white">SETUJUI SEMUA</strong>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="ruangan-table" id="ruangan-{{ $index }}" style="display: none;">
                            <td colspan="4">
                                <div class="border rounded-md">
                                    <div class="table-responsive p-2">
                                        <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse border border-gray-300">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="font-normal border border-gray-300" style="width: 20%;">Gedung</th>
                                                    <th class="font-normal border border-gray-300" style="width: 20%;">Ruang</th>
                                                    <th class="font-normal border border-gray-300" style="width: 20%;">Kapasitas</th>
                                                    <th class="font-normal border border-gray-300" style="width: 20%;">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="ruanganTableBody-{{ $index }}">
                                                @foreach($ruangans as $ruangan)
                                                <tr class="border-b border-gray-200">
                                                    <td class="border border-gray-300">{{ $ruangan->gedung }}</td>
                                                    <td class="border border-gray-300">{{ $ruangan->namaruang }}</td>
                                                    <td class="border border-gray-300">{{ $ruangan->kapasitas }}</td>
                                                    <td class="text-center py-2 border border-gray-300">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                            {{ $ruangan->status == 'belum disetujui' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                            {{ ucfirst($ruangan->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.toggle-button');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const table = document.getElementById(`ruangan-${id}`);
                const approveButton = document.getElementById(`approveBtn-${id}`);

                // Toggle visibility of ruangan table and approve button
                if (table.style.display === 'none' || table.style.display === '') {
                    table.style.display = 'table-row';
                    approveButton.classList.remove('hidden');
                    this.textContent = '-';
                } else {
                    table.style.display = 'none';
                    approveButton.classList.add('hidden');
                    this.textContent = '+';
                }
            });
        });
    });

    function showApprovalAlert(message, type) {
        const alertBox = $('#approval-alert');
        const alertMessage = $('#approval-alert-message');
        
        alertMessage.text(message);
        
        // Set warna berdasarkan tipe alert
        if (type === 'success') {
            alertBox.removeClass('bg-red-100 border-red-400 text-red-700')
                    .addClass('bg-green-100 border-green-400 text-green-700');
        } else if (type === 'danger') {
            alertBox.removeClass('bg-green-100 border-green-400 text-green-700')
                    .addClass('bg-red-100 border-red-400 text-red-700');
        }
        
        alertBox.removeClass('hidden'); // Menampilkan alert
        setTimeout(() => alertBox.addClass('hidden'), 3000); // Menyembunyikan alert setelah 3 detik
    }

    function setujuisemua(url, namaprodi) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                namaprodi: namaprodi,
                _token: $('meta[name="csrf-token"]').attr('content') // Pastikan CSRF token disertakan
            },
            success: function(response) {
                console.log(response); // Log respons untuk debugging
                if (response.success === true) {
                    showAlert(response.message, 'success');

                    // Perbarui status di tabel untuk semua entri dengan namaprodi yang sama
                    $(`#plottingRuangTableBody tr`).each(function() {
                        const row = $(this);
                        const prodiCell = row.find('td:first'); // Asumsikan kolom pertama adalah prodi

                        if (prodiCell.data('namaprodi') === namaprodi) {
                            row.find('span').removeClass('bg-red-100 text-red-800').addClass('bg-green-100 text-green-800').text('telah disetujui');
                        }
                    });
                } else {
                    showAlert(response.message, 'danger');
                }
            },
            error: function() {
                showAlert('Terjadi kesalahan saat menyetujui semua plotting ruang.', 'danger');
            }
        });
    }

    function toggleApproveButton() {
    const approveButton = document.getElementById('approveAllButton');
    if (approveButton.classList.contains('hidden')) {
        approveButton.classList.remove('hidden');
    } else {
        approveButton.classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-button');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetElement = document.querySelector(targetId);

            if (targetElement.classList.contains('hidden')) {
                targetElement.classList.remove('hidden');
            } else {
                targetElement.classList.add('hidden');
            }
        });
    });
});

</script>

</body>
</html>
@endsection