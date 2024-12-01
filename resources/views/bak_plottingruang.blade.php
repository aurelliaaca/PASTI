@extends('layouts.app')

@section('title', 'Plotting Ruang')

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

    .table tbody tr {
      transition: opacity 0.5s, background-color 0.3s;
    }

    .btn-sm {
      transition: transform 0.2s;
    }

    .btn-sm:hover {
      transform: scale(1.1);
    }
  </style>
</head>
<body class="relative">
    <!-- Container -->
    <div class="bg-white shadow-lg rounded-lg mx-auto max-w-7xl p-6 mt-1" style="min-height: 600px;">
      <!-- Content -->
      <div id="content-ruangan" class="p-4">
        <div class="flex justify-between items-center">
          <h2 class="text-lg font-semibold text-teal-800">PLOTTING RUANG</h2>
          <button type="button" class="btn bg-teal-500 btn-icon-text hover:bg-teal-600" data-toggle="modal" data-target="#addPlottingRuangModal">
            <i class="fas fa-plus me-2 text-white"></i> <strong class="text-white">Tambah Plotting Ruang</strong>
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
                            <th class="font-bold" style="width: 20%; font-size: 1rem;">PRODI</th>
                            <th class="font-bold" style="width: 15%; font-size: 1rem;">GEDUNG</th>
                            <th class="font-bold" style="width: 20%; font-size: 1rem;">RUANG</th>
                            <th class="font-bold" style="width: 15%; font-size: 1rem;">KAPASITAS</th>
                            <th class="font-bold" style="width: 15%; padding-left: 48px; font-size: 1rem;">STATUS</th>
                            <th class="font-bold text-center" style="width: 15%; font-size: 1rem;">AKSI</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data will be inserted here -->
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

    

    <!-- Modal Form Plotting Ruang -->
<div class="modal fade" id="addPlottingRuangModal" tabindex="-1" role="dialog" aria-labelledby="addPlottingRuangModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-teal-800 text-white">
        <h5 class="modal-title" id="addPlottingRuangModalLabel">Tambah Plotting Ruang</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="plottingRuangForm">
          <div class="form-group mb-3">
            <label for="prodi">Program Studi</label>
            <select class="form-control" id="prodi" required>
              <option value="">Pilih Program Studi</option>
              <option value="1">Informatika</option>
              <option value="2">Biologi</option>
              <option value="3">Matematika</option>
              <option value="4">Fisika</option>
              <option value="5">Kimia</option>
              <option value="6">Bioteknologi</option>
              <option value="7">Statistika</option>
            </select>
          </div>
          
          <div class="form-group mb-3">
            <label>Pilih Ruangan</label>
            <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="ruang_1" name="ruangan[]" value="1">
                <label class="custom-control-label" for="ruang_1">
                  Lab Komputer 1 (Kapasitas: 30)
                </label>
              </div>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="ruang_2" name="ruangan[]" value="2">
                <label class="custom-control-label" for="ruang_2">
                  Lab Komputer 2 (Kapasitas: 25)
                </label>
              </div>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="ruang_3" name="ruangan[]" value="3">
                <label class="custom-control-label" for="ruang_3">
                  Ruang 301 (Kapasitas: 40)
                </label>
              </div>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="ruang_4" name="ruangan[]" value="4">
                <label class="custom-control-label" for="ruang_4">
                  Ruang 302 (Kapasitas: 35)
                </label>
              </div>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="ruang_5" name="ruangan[]" value="5">
                <label class="custom-control-label" for="ruang_5">
                  Lab Jaringan (Kapasitas: 20)
                </label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning text-white" data-dismiss="modal">Batal</button>
        <button type="button" class="btn bg-teal-500 text-white" onclick="submitPlottingForm()">Simpan</button>
      </div>
    </div>
  </div>
</div>

    

    <script>
      function submitPlottingForm() {
        const form = document.getElementById('plottingRuangForm');
        if (!form.checkValidity()) {
          form.reportValidity();
          return;
        }

        const prodiSelect = document.getElementById('prodi');
        const prodiId = prodiSelect.value;
        const prodiName = prodiSelect.options[prodiSelect.selectedIndex].text;
        
        const selectedRuangan = Array.from(document.querySelectorAll('input[name="ruangan[]"]:checked'));
        
        if (selectedRuangan.length === 0) {
          alert('Pilih minimal satu ruangan');
          return;
        }

        // Add rows to table for each selected room
        selectedRuangan.forEach(ruang => {
          const ruangLabel = ruang.nextElementSibling.textContent;
          const [namaRuang, kapasitas] = ruangLabel.split('(Kapasitas:');
          
          const newRow = document.createElement('tr');
          newRow.innerHTML = `
            <td style="font-size: 1rem;">${prodiName}</td>
            <td style="font-size: 1rem;">Gedung A</td>
            <td style="font-size: 1rem;">${namaRuang.trim()}</td>
            <td style="font-size: 1rem;">${kapasitas.replace(')', '')}</td>
            <td style="padding-left: 48px;">
              <span class="badge bg-danger text-white px-2 py-1">Belum Disetujui</span>
            </td>
            <td class="text-center">
              <button onclick="editPlotting(this)" class="btn btn-warning btn-sm text-white mx-1">
                <i class="fas fa-edit"></i>
              </button>
              <button onclick="deletePlotting(this)" class="btn btn-danger btn-sm mx-1">
                <i class="fas fa-trash"></i>
              </button>
            </td>
          `;

          // Add hover effect
          newRow.classList.add('hover:bg-gray-100');
          
          // Find table body and append new row
          const tableBody = document.querySelector('.table tbody');
          if (!tableBody) {
            const tbody = document.createElement('tbody');
            document.querySelector('.table').appendChild(tbody);
          }
          document.querySelector('.table tbody').appendChild(newRow);
        });

        // Close modal and reset form
        $('#addPlottingRuangModal').modal('hide');
        form.reset();

        // Success alert
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-success d-flex align-items-center';
        alertDiv.setAttribute('role', 'alert');
        alertDiv.innerHTML = `
          <i class="fas fa-check-circle me-2"></i>
          <a href="#" class="alert-link">Plotting ruangan berhasil ditambahkan!</a>
        `;

        const contentRuangan = document.getElementById('content-ruangan');
        contentRuangan.insertBefore(alertDiv, contentRuangan.firstChild);

        setTimeout(() => {
          alertDiv.remove();
        }, 2000);
      }

      function editPlotting(button) {
        const row = button.closest('tr');
        const cells = row.cells;
        
        // Get current values
        const prodi = cells[0].textContent;
        const gedung = cells[1].textContent;
        const ruang = cells[2].textContent;
        const kapasitas = cells[3].textContent;

        // Populate modal with current values
        const prodiSelect = document.getElementById('prodi');
        Array.from(prodiSelect.options).forEach(option => {
          if (option.text === prodi) {
            option.selected = true;
          }
        });

        // Check the corresponding room checkbox
        const checkboxes = document.querySelectorAll('input[name="ruangan[]"]');
        checkboxes.forEach(checkbox => {
          const label = checkbox.nextElementSibling.textContent;
          if (label.includes(ruang)) {
            checkbox.checked = true;
          } else {
            checkbox.checked = false;
          }
        });

        // Open modal
        $('#addPlottingRuangModal').modal('show');

        // Remove old row
        row.remove();
      }

      function deletePlotting(button) {
        if (confirm('Apakah Anda yakin ingin menghapus plotting ruangan ini?')) {
          const row = button.closest('tr');
          
          // Add fade out animation
          row.style.transition = 'opacity 0.5s';
          row.style.opacity = '0';
          
          setTimeout(() => {
            row.remove();
            
            // Show success message
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-success d-flex align-items-center';
            alertDiv.setAttribute('role', 'alert');
            alertDiv.innerHTML = `
              <i class="fas fa-check-circle me-2"></i>
              <a href="#" class="alert-link">Plotting ruangan berhasil dihapus!</a>
            `;

            const contentRuangan = document.getElementById('content-ruangan');
            contentRuangan.insertBefore(alertDiv, contentRuangan.firstChild);

            setTimeout(() => {
              alertDiv.remove();
            }, 2000);
          }, 500);
        }
      }
    </script>
</body>
</html>
@endsection
