@extends('layouts.app')

@section('title', 'Plotting Ruang')

@section('content')
<html>
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

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

<body class="min-h-screen relative">
  <div id="success-alert" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
      <strong class="font-bold">Sukses!</strong>
      <span class="block sm:inline" id="alert-message">Ruangan berhasil diproses!</span>
      <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
          <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.classList.add('hidden')">
              <title>Close</title>
              <path d="M14.348 5.652a1 1 0 0 0-1.414 0L10 8.586 7.066 5.652a1 1 0 1 0-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 1 0 1.414 1.414L10 11.414l2.934 2.934a1 1 0 0 0 1.414-1.414L11.414 10l2.934-2.934a1 1 0 0 0 0-1.414z"/>
          </svg>
      </span>
  </div>
  <div class="bg-white shadow-lg rounded-lg">
      <div id="content-ruangan" class="p-4">
          <!-- Header dan Tombol -->
          <div class="flex justify-between items-center mb-4">
              <h1 class="text-xl font-semibold text-teal-800 mb-0">PLOTTING RUANG</h1>
              <div class="flex items-center">
                  <button class="btn bg-teal-500 btn-icon-text mr-2 p-2 rounded-lg" onclick="openPlottingModal()">
                      <i class="fas fa-plus text-white"></i>
                      <strong class="text-white">Tambah Plotting Ruang</strong>
                  </button>
              </div>
          </div>
      <div class="border rounded-md">
        <div class="table-responsive p-2 table-striped">
          <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse">
            <thead>
              <tr>
                <th class="font-bold" style="width: 20%;">Program Studi</th>
                <th class="font-bold" style="width: 20%;">Gedung</th>
                <th class="font-bold" style="width: 20%;">Ruang</th>
                <th class="font-bold" style="width: 20%;">Kapasitas</th>
                <th class="font-bold" style="width: 20%;">Status</th>
              </tr>
            </thead>
            <tbody id="plottingRuangTableBody">
              @foreach($plottingRuang as $plotting)
              <tr id="plotting_{{ $plotting->id }}" class="odd:bg-teal-800/10 even:bg-white mb-2 hover:bg-green-200 cursor-pointer">
                <td>{{ $plotting->prodi_id }}</td>
                <td>{{ $plotting->ruangan->gedung ?? 'N/A' }}</td>
                <td>{{ $plotting->ruangan->ruang ?? 'N/A' }}</td>
                <td>{{ $plotting->ruangan->kapasitas ?? 'N/A' }}</td>
                <td class="text-center py-2">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                    {{ $plotting->status == 'belum disetujui' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                    {{ $plotting->status }}
                  </span>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Overlay untuk popup -->
    <div id="plottingRuangModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3 relative">
            <div class="bg-teal-800 text-white p-4 rounded-t-lg flex justify-between items-center">
                <h5 class="text-lg font-semibold">Tambah Plotting Ruang</h5>
                <button type="button" class="text-white" onclick="closePlottingModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-6">
                <form id="plottingRuangForm" method="POST" action="{{ route('plotting-ruang.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="prodi" class="block">Program Studi</label>
                        <select class="w-full px-4 py-2 border rounded-lg" id="prodi" name="prodi" required>
                            <option value="">Pilih Program Studi</option>
                            <option value="INFORMATIKA">INFORMATIKA</option>
                            <option value="BIOLOGI">BIOLOGI</option>
                            <option value="MATEMATIKA">MATEMATIKA</option>
                            <option value="KIMIA">KIMIA</option>
                            <option value="FISIKA">FISIKA</option>
                            <option value="BIOTEKNOLOGI">BIOTEKNOLOGI</option>
                            <option value="STATISTIKA">STATISTIKA</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="ruangan_id" class="block">Ruangan</label>
                        @foreach($ruangan as $r)
                        <div class="flex items-center mb-2">
                            <input class="form-check-input h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500" type="checkbox" id="ruangan_{{ $r->id }}" name="ruangan_id[]" value="{{ $r->id }}">
                            <label class="ml-2 text-sm text-gray-700" for="ruangan_{{ $r->id }}">
                                {{ $r->ruang }} - Kapasitas: {{ $r->kapasitas }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </form>
            </div>
            <div class="bg-gray-50 p-4 flex justify-end rounded-b-lg">
                <button type="button" class="mr-2 px-4 py-2 bg-teal-500 text-white rounded-lg" onclick="closePlottingModal()">Batal</button>
                <button type="button" class="mr-2 px-4 py-2 bg-amber-400 text-white rounded-lg" onclick="submitPlottingRuang()">Simpan</button>
            </div>
        </div>
    </div>

    <div id="success-alert" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline" id="alert-message">Ruangan berhasil diproses!</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.classList.add('hidden')">
                <title>Close</title>
                <path d="M14.348 5.652a1 1 0 0 0-1.414 0L10 8.586 7.066 5.652a1 1 0 1 0-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 1 0 1.414 1.414L10 11.414l2.934 2.934a1 1 0 0 0 1.414-1.414L11.414 10l2.934-2.934a1 1 0 0 0 0-1.414z"/>
            </svg>
        </span>
    </div>

    <script>
        function closePlottingModal() {
            document.getElementById('plottingRuangModal').classList.add('hidden');
        }

        function openPlottingModal() {
            document.getElementById('plottingRuangModal').classList.remove('hidden');
        }

        function showAlert(message, type) {
            const alertBox = $('#success-alert');
            const alertMessage = $('#alert-message');
            
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
            setTimeout(() => alertBox.addClass('hidden'), 3000);
        }

        function closeModal() {
            $('#plottingRuangModal').addClass('hidden'); // Pastikan ID modal benar
        }

        function submitPlottingRuang() {
            const formData = new FormData(document.getElementById('plottingRuangForm'));

            $.ajax({
                url: '/plotting-ruang/store',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        closeModal(); // Tutup modal setelah berhasil
                        showAlert(response.message, 'success');
                        loadPlottingRuangData(); // Muat ulang data tabel
                    } else {
                        showAlert('Terjadi kesalahan saat memproses ruangan.', 'danger');
                    }
                },
                error: function() {
                    showAlert('Terjadi kesalahan saat memproses ruangan.', 'danger');
                }
            });
        }

        function loadPlottingRuangData() {
            $.ajax({
                url: '/plotting-ruang/data', // Pastikan rute ini mengembalikan data terbaru
                type: 'GET',
                success: function(data) {
                    const tableBody = $('#plottingRuangTableBody');
                    tableBody.empty(); // Kosongkan tabel sebelum menambahkan data baru

                    data.forEach(plotting => {
                        const newRow = `<tr id="plotting_${plotting.id}" class="odd:bg-teal-800/10 even:bg-white mb-2 hover:bg-green-200 cursor-pointer">
                            <td>${plotting.prodi_id}</td>
                            <td>${plotting.ruangan.gedung || 'N/A'}</td>
                            <td>${plotting.ruangan.ruang || 'N/A'}</td>
                            <td>${plotting.ruangan.kapasitas || 'N/A'}</td>
                            <td class="text-center py-2">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    ${plotting.status === 'belum disetujui' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'}">
                                    ${plotting.status}
                                </span>
                            </td>
                        </tr>`;
                        tableBody.append(newRow);
                    });
                },
                error: function() {
                    showAlert('Gagal memuat data plotting ruang.', 'danger');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const openModalButton = document.getElementById('yourButtonId');
            const closeModalButton = document.getElementById('closeModal');
            const modal = document.getElementById('plottingModal');

            openModalButton.addEventListener('click', function() {
                modal.classList.remove('hidden');
            });

            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        });
    </script>
</body>
</html>
@endsection
