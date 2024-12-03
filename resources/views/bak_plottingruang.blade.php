@extends('layouts.app')

@section('title', 'Plotting Ruang')

@section('content')
<html>
<head>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
      background-color: #f9f9fa;
    }

    .table-responsive {
      display: block;
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      -ms-overflow-style: -ms-autohiding-scrollbar;
    }

    .table,
    .jsgrid .jsgrid-table {
      width: 100%;
      max-width: 100%;
      margin-bottom: 1rem;
      background-color: transparent;
    }

    .table thead th,
    .jsgrid .jsgrid-table thead th {
      border-top: 0;
      border-bottom-width: 1px;
      font-weight: 500;
      font-size: .875rem;
      text-transform: uppercase;
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
  <!-- Container -->
  <div class="bg-white shadow-lg rounded-lg mx-auto max-w-7xl p-6 mt-1" style="min-height: 600px;">
    <!-- Content -->
    <div id="content-ruangan" class="p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-lg font-semibold text-teal-800">PLOTTING RUANG</h2>
        <button type="button" class="btn bg-teal-500 btn-icon-text hover:bg-teal-600" data-toggle="modal" data-target="#plottingRuangModal">
          <i class="fas fa-plus me-2 text-white"></i> <strong class="text-white">Tambah Plotting Ruang</strong>
        </button>
      </div>
      <div class="border rounded-md mt-2 p-4">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="font-bold">Program Studi</th>
                <th class="font-bold">Gedung</th>
                <th class="font-bold">Ruangan</th>
                <th class="font-bold">Kapasitas</th>
                <th class="font-bold">Status</th>
              </tr>
            </thead>
            <tbody id="plottingRuangTableBody">
              @foreach($plottingRuang as $plotting)
              <tr>
                <td>{{ $plotting->prodi_id }}</td>
                <td>{{ $plotting->ruangan->gedung ?? 'N/A' }}</td>
                <td>{{ $plotting->ruangan->ruang ?? 'N/A' }}</td>
                <td>{{ $plotting->ruangan->kapasitas ?? 'N/A' }}</td>
                <td>
                  <span class="badge text-white
                    {{ $plotting->status == 'belum disetujui' ? 'bg-danger' : 'bg-success' }}">
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

    <!-- Modal Form Plotting Ruang -->
    <div class="modal fade" id="plottingRuangModal" tabindex="-1" role="dialog" aria-labelledby="plottingRuangModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-teal-800 text-white">
            <h5 class="modal-title" id="plottingRuangModalLabel">Tambah Plotting Ruang</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="plottingRuangForm" method="POST" action="{{ route('plotting-ruang.store') }}">
              @csrf
              <div class="form-group">
                <label for="prodi">Program Studi</label>
                <select class="form-control" id="prodi" name="prodi" required>
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
              <div class="form-group">
                <label for="ruangan_id">Ruangan</label>
                @foreach($ruangan as $r)
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="ruangan_{{ $r->id }}" name="ruangan_id[]" value="{{ $r->id }}">
                  <label class="form-check-label" for="ruangan_{{ $r->id }}">
                    {{ $r->ruang }} - Kapasitas: {{ $r->kapasitas }}
                  </label>
                </div>
                @endforeach
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning text-white" data-dismiss="modal">Batal</button>
            <button type="button" class="btn bg-teal-500 text-white" onclick="submitPlottingRuang()">Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function submitPlottingRuang() {
      const form = document.getElementById('plottingRuangForm');

      if (!form.checkValidity()) {
        form.reportValidity();
        return;
      }

      const formData = new FormData(form);

      $.ajax({
        url: '{{ route("plotting-ruang.store") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if (response.success) {
            $('#plottingRuangModal').modal('hide');
            form.reset();
            $('#ruangan_id').val(null).trigger('change');

            // Tampilkan alert sukses
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-success d-flex align-items-center';
            alertDiv.setAttribute('role', 'alert');
            alertDiv.innerHTML = `
              <i class="fas fa-check-circle me-2"></i>
              <span>Data plotting ruang berhasil ditambahkan!</span>
            `;

            document.getElementById('content-ruangan').insertBefore(alertDiv, document.getElementById('content-ruangan').firstChild);

            setTimeout(() => {
              alertDiv.remove();
              location.reload();
            }, 2000);
          }
        },
        error: function(xhr) {
          console.error(xhr);
          // Tampilkan alert error
          const alertDiv = document.createElement('div');
          alertDiv.className = 'alert alert-danger d-flex align-items-center';
          alertDiv.setAttribute('role', 'alert');
          alertDiv.innerHTML = `
            <i class="fas fa-exclamation-circle me-2"></i>
            <span>Terjadi kesalahan! Silakan coba lagi.</span>
          `;

          document.getElementById('content-ruangan').insertBefore(alertDiv, document.getElementById('content-ruangan').firstChild);

          setTimeout(() => {
            alertDiv.remove();
          }, 2000);
        }
      });
    }
  </script>
</body>
</html>
@endsection
