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
            <!-- Header dan Tombol -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-semibold text-teal-800 mb-0">PERSETUJUAN JADWAL MATA KULIAH</h1>
            </div>

            <!-- Tabel -->
            <div class="border rounded-md p-2">
                <div class="table-responsive">
                    <table class="table table-striped w-full text-teal-800 font-black flex items-center">
                        <tbody>
                        @foreach($programStudiList as $index => $programStudi)
                        <tr>
                            <td class="pb-2 pt-0">
                                <button class="toggle-button btn btn-primary bg-teal-500 text-white w-10 py-2 rounded-lg mr-1" data-id="{{ $index }}" onclick="toggleApproveButton(this)">+</button>
                                {{ $programStudi }}
                            </td>
                            <td class="pb-2 pt-0 text-right">
                                <!-- Tombol Setujui Semua disembunyikan oleh default -->
                                <button class="btn bg-teal-500 btn-icon-text p-2 rounded-lg" id="approveBtn-{{ $index }}" style="display: none;" onclick="approveAll({{ $index }})">
                                    <i class="fa fa-check mr-1 ml-1 text-white"></i>
                                    <strong class="text-white">Setujui Semua</strong>
                                </button>
                            </td>
                        </tr>
                        <tr class="ruangan-table" id="ruangan-{{ $index }}" style="display: none;">
                            <td colspan="4">
                                <div class="border rounded-md">
                                    <div class="table-responsive p-2 table-striped">
                                        <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse">
                                            <thead>
                                                <tr>
                                                    <th class="font-normal" style="width: 20%;">Gedung</th>
                                                    <th class="font-normal" style="width: 20%;">Ruang</th>
                                                    <th class="font-normal" style="width: 20%;">Kapasitas</th>
                                                    <th class="font-normal" style="width: 20%;">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="ruanganTableBody-{{ $index }}">
                                                @foreach($plottingRuangData[$programStudi] as $plotting)
                                                <tr>
                                                    <td>{{ $plotting->ruangan->gedung }}</td>
                                                    <td>{{ $plotting->ruangan->ruang }}</td>
                                                    <td>{{ $plotting->ruangan->kapasitas }}</td>
                                                    <td>
                                                        <span class="badge text-white {{ $plotting->status == 'belum disetujui' ? 'bg-danger' : 'bg-success' }}">
                                                            {{ ucfirst($plotting->status) }}
                                                        </span>
                                                        @if($plotting->status == 'belum disetujui')
                                                            <form action="{{ route('plotting-ruang.approve', $plotting->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                                            </form>
                                                        @endif
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
                    approveButton.style.display = 'inline-block';
                    this.textContent = '-';
                } else {
                    table.style.display = 'none';
                    approveButton.style.display = 'none';
                    this.textContent = '+';
                }
            });
        });
    });

    function approveAll(id) {
        const programStudi = ['INFORMATIKA', 'BIOLOGI', 'MATEMATIKA', 'FISIKA', 'KIMIA', 'BIOTEKNOLOGI', 'STATISTIKA'];
        const url = `/approve-ruangan/${id}`; // URL untuk permintaan AJAX

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}' // Kirim token CSRF untuk keamanan
            },
            success: function(response) {
                if (response.success) {
                    alert('Sukses: ' + response.message);
                    // Update tampilan jika perlu, misalnya ubah status di tabel
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error: Terjadi kesalahan saat memproses permintaan.');
            }
        });
    }
</script>

</body>
</html>
@endsection