@extends('layouts.app')

@section('title', 'Ruangan')

@section('content')
<html>
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-image: url('{{ asset('image/bg_PASTI1.png') }}');
      background-size: cover;
      background-repeat: no-repeat;
      background-color: #f9f9fa
    }

    .flex {
      -webkit-box-flex: 1;
      -ms-flex: 1 1 auto;
      flex: 1 1 auto
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
    <div class="bg-white shadow-lg rounded-lg mx-auto max-w-7xl p-6 mt-5">
      <!-- Content -->
      <div id="content-ruangan" class="p-4">
        <div class="flex justify-between items-center">
          <h2 class="text-lg font-semibold text-teal-800">RUANG KELAS</h2>
          <button type="button" class="btn btn-warning btn-icon-text" data-toggle="modal" data-target="#addRuanganModal">
            <i class="fas fa-sliders-h me-2 text-teal-800"></i> <strong class="text-teal-800">ADD</strong>
          </button>
        </div>
        <div class="border rounded-md mt-2 p-4">
          <!-- Tempat untuk data ruangan -->
          <div class="page-content page-container" id="page-content">
            <div class="row container d-flex justify-content-center">
              <div class="col-lg-12 grid-margin">
                <div class="card border-0 shadow-none m-0 p-0">
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th style="width: 32%;">
                              KAPRODI
                            </th>
                            <th style="width: 18%;">
                              DEPARTEMEN
                            </th>
                            <th style="width: 17%;">
                              RUANG
                            </th>
                            <th style="width: 20%;">
                              KAPASITAS
                            </th>
                            <th style="width: 12%;">
                              AKSI
                            </th>
                          </tr>
                        </thead>
                        <tbody id="ruanganTableBody">
                          @foreach($ruangkelas as $r)
                          <tr>
                            <td>{{ $r->kaprodi }}</td>
                            <td>{{ $r->departemen }}</td>
                            <td>{{ $r->ruang }}</td>
                            <td style="padding-left: 35px;">{{ $r->kapasitas }}</td>
                            <td>
                              <button onclick="deleteRuangan({{ $r->id }})" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
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
          </div>
        </div>
      </div>

    <!-- Modal Form -->
    <div class="modal fade" id="addRuanganModal" tabindex="-1" role="dialog" aria-labelledby="addRuanganModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-teal-800 text-white">
            <h5 class="modal-title" id="addRuanganModalLabel">Tambah Data Ruangan</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="ruanganForm">
              @csrf
              <div class="form-group mb-3">
                <label for="kaprodi">Kaprodi</label>
                <select class="form-control" id="kaprodi" required>
                  <option value="">Pilih Kaprodi</option>
                  <option value="1">Saddam Dharmawan, S.Kom, M.Kom</option>
                  <option value="2">Dr. Azzam Muhammad, M.Si</option>
                  <option value="3">Dr. Baskoro Mulyana, S.Si, M.Si</option>
                  <option value="4">Drs. Emir Habibie, M.Si</option>
                  <option value="5">Fianita Sari, M.SI</option>
                </select>
              </div>
              <div class="form-group mb-3">
                <label for="departemen">Departemen</label>
                <select class="form-control" id="departemen" required>
                  <option value="">Pilih Departemen</option>
                  <option value="Informatika">Informatika</option>
                  <option value="Biologi">Biologi</option>
                  <option value="Matematika">Matematika</option>
                  <option value="Fisika">Fisika</option>
                  <option value="Kimia">Kimia</option>
                  <option value="Statistika">Statistika</option>
                  <option value="Bioteknologi">Bioteknologi</option>
                </select>
              </div>
              <div class="form-group mb-3">
                <label for="ruangan">Ruang</label>
                <input type="text" class="form-control" id="ruang" placeholder="Masukkan Nama Ruang" required>
              </div>
              <div class="form-group mb-3">
                <label for="kapasitas">Kapasitas</label>
                <input type="number" class="form-control" id="kapasitas" placeholder="Masukkan Jumlah Kapasitas" required>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-success" onclick="submitForm()">Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Konfirmasi Delete -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-teal-800 text-white">
            <h5 class="modal-title" id="deleteConfirmModalLabel">Konfirmasi Hapus Data</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apakah Anda ingin menghapus data ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-success" id="confirmDelete">Hapus</button>
          </div>
        </div>
      </div>
    </div>

    <script>

      function submitForm() {
        const form = document.getElementById('ruanganForm');
        if (!form.checkValidity()) {
          form.reportValidity();
          return;
        }

        const kaprodiSelect = document.getElementById('kaprodi');
        const departemenSelect = document.getElementById('departemen');
        const ruangan = document.getElementById('ruang').value;
        const kapasitas = document.getElementById('kapasitas').value;

        const formData = {
          kaprodi: kaprodiSelect.options[kaprodiSelect.selectedIndex].text,
          departemen: departemenSelect.value,
          ruangan: ruangan,
          kapasitas: kapasitas,
          _token: '{{ csrf_token() }}'
        };

        $.ajax({
          url: '{{ route("ruangan.store") }}',
          type: 'POST',
          data: formData,
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              const newRow = document.createElement('tr');
              newRow.innerHTML = `
                <td>${formData.kaprodi}</td>
                <td>${formData.departemen}</td>
                <td>${formData.ruangan}</td>
                <td style="padding-left: 35px;">${formData.kapasitas}</td>
                <td>
                  <button onclick="deleteRuangan(${response.data.id})" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              `;

              document.getElementById('ruanganTableBody').appendChild(newRow);
              $('#addRuanganModal').modal('hide');
              form.reset();

              // Alert Sukses
              const alertDiv = document.createElement('div');
              alertDiv.className = 'alert alert-success d-flex align-items-center';
              alertDiv.setAttribute('role', 'alert');
              alertDiv.innerHTML = `
                <i class="fas fa-check-circle me-2"></i>
                <a href="#" class="alert-link">Data berhasil ditambahkan!</a>
              `;

              const contentRuangan = document.getElementById('content-ruangan');
              contentRuangan.insertBefore(alertDiv, contentRuangan.firstChild);

              setTimeout(() => {
                alertDiv.remove();
              }, 2000);
            }
          },
          error: function(xhr) {
            console.error(xhr);
            // Alert Error
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger d-flex align-items-center';
            alertDiv.setAttribute('role', 'alert');
            alertDiv.innerHTML = `
              <i class="fas fa-exclamation-circle me-2"></i>
              <a href="#" class="alert-link">Terjadi kesalahan! ${xhr.responseJSON?.message || 'Silakan coba lagi.'}</a>
            `;
            const contentRuangan = document.getElementById('content-ruangan');
            contentRuangan.insertBefore(alertDiv, contentRuangan.firstChild);
            setTimeout(() => {
              alertDiv.remove();
            }, 2000);
          }
        });
      }

      let deleteId = null;

      function deleteRuangan(id) {
        deleteId = id;
        $('#deleteConfirmModal').modal('show');
      }

      $('#confirmDelete').click(function() {
        if(deleteId !== null) {
          $('#deleteConfirmModal').modal('hide');
          
          $.ajax({
            url: `/ruangan/${deleteId}`,
            type: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              if(response.success) {
                // Tampilkan alert sukses 
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success d-flex align-items-center';
                alertDiv.setAttribute('role', 'alert');
                alertDiv.innerHTML = `
                  <i class="fas fa-check-circle me-2"></i>
                  <a href="#" class="alert-link">Data berhasil dihapus!</a>
                `;
                
                const contentRuangan = document.getElementById('content-ruangan');
                contentRuangan.insertBefore(alertDiv, contentRuangan.firstChild);
                
                // Setelah alert muncul, tampilkan spinner dan update data
                setTimeout(() => {
                  alertDiv.remove();
                  // Tampilkan spinner loading 
                  const loadingSpinner = document.createElement('div');
                  loadingSpinner.className = 'alert alert-info d-flex align-items-center justify-content-center';
                  loadingSpinner.setAttribute('role', 'alert');
                  loadingSpinner.style.backgroundColor = '#e2f6e9'; 
                  loadingSpinner.innerHTML = `
                    <div class="d-flex align-items-center">
                      <div class="spinner-border text-success me-2" role="status" style="width: 1rem; height: 1rem;">
                        <span class="visually-hidden"></span>
                      </div>
                      <span class="text-success">Memperbarui data...</span>
                    </div>
                  `;
                  
                  contentRuangan.insertBefore(loadingSpinner, contentRuangan.firstChild);
                  
                  // Ambil data terbaru dari server
                  $.get('{{ route("ruangan.index") }}', function(data) {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(data, 'text/html');
                    const newTableBody = doc.getElementById('ruanganTableBody');
                    // Update tabel dengan data baru
                    document.getElementById('ruanganTableBody').innerHTML = newTableBody.innerHTML;
                    loadingSpinner.remove();
                  });
                }, 1000);
              }
            },
            error: function(xhr) {
              console.error('Error:', xhr);
              // Alert Error
              const alertDiv = document.createElement('div');
              alertDiv.className = 'alert alert-danger d-flex align-items-center';
              alertDiv.setAttribute('role', 'alert');
              alertDiv.innerHTML = `
                <i class="fas fa-exclamation-circle me-2"></i>
                <a href="#" class="alert-link">Terjadi kesalahan saat menghapus data!</a>
              `;
              
              const contentRuangan = document.getElementById('content-ruangan');
              contentRuangan.insertBefore(alertDiv, contentRuangan.firstChild);
              
              setTimeout(() => {
                alertDiv.remove();
              }, 3000);
            }
          });
        }
      });
    </script>
</body>
</html>
@endsection
