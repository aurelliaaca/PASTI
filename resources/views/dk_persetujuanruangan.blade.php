@extends('layouts.app')

@section('title', 'Persetujuan Ruangan')

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
      background-color: #f9f9fa;
    }

    .flex {
      -webkit-box-flex: 1;
      -ms-flex: 1 1 auto;
      flex: 1 1 auto;
    }

    .table-responsive {
      display: block;
      width: 100%;
      padding-right: 0%;
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
  </style>
</head>

<body class="relative">
  <!-- Container -->
  <div class="bg-white shadow-lg rounded-lg mx-auto max-w-7xl p-6 mt-1" style="min-height: 600px;">
    <!-- Content -->
    <div id="content-ruangan" class="p-4">
      <div class="flex justify-between items-center">
        <h2 class="text-lg font-semibold text-teal-800">PERSETUJUAN RUANGAN</h2>
        <button type="button" class="btn bg-teal-500 btn-icon-text hover:bg-teal-600" id="approveAllButton">
          <i class="fa fa-check me-2 text-white"></i> <strong class="text-white">Setujui Semua</strong>
        </button>
      </div>
      <div class="border rounded-md mt-2 p-4">
        <div class="row container d-flex justify-content-center">
          <div class="col-lg-12 grid-margin">
            <div class="card border-0 shadow-none m-0 p-0">
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped" style="width: 100%;">
                    <tbody>
                      <tr>
                        <td style="padding-left: 15px;">
                          <button class="toggle-button btn btn-primary" data-id="0">+</button>
                          INFORMATIKA
                        </td>
                      </tr>
                      <tr class="course-table" id="courses-0" style="display: none;">
                        <td colspan="4">
                          <div class="table-responsive" style="margin: 0; padding: 0;">
                            <table class="table table-bordered" style="width: calc(100% + 30px);">
                              <thead>
                                <tr>
                                  <th>GEDUNG</th>
                                  <th>RUANG</th>
                                  <th>KAPASITAS</th>
                                  <th>STATUS</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td style="background-color: white;">A</td>
                                  <td style="background-color: white;">A101</td>
                                  <td style="background-color: white;">30</td>
                                  <td class="status" style="background-color: white;">Belum Disetujui</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding-left: 15px;">
                          <button class="toggle-button btn btn-primary" data-id="1">+</button>
                          BIOLOGI
                        </td>
                      </tr>
                      <tr class="course-table" id="courses-1" style="display: none;">
                        <td colspan="4">
                          <div class="table-responsive" style="margin: 0; padding: 0;">
                            <table class="table table-bordered" style="width: 100%;">
                              <thead>
                                <tr>
                                  <th>GEDUNG</th>
                                  <th>RUANG</th>
                                  <th>KAPASITAS</th>
                                  <th>STATUS</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td style="background-color: white;">B</td>
                                  <td style="background-color: white;">B201</td>
                                  <td style="background-color: white;">40</td>
                                  <td class="status" style="background-color: white;">Belum Disetujui</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </td>
                      </tr>
                      <!-- Tambahkan data lainnya sesuai kebutuhan -->
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

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const buttons = document.querySelectorAll('.toggle-button');

      buttons.forEach(button => {
        button.addEventListener('click', function () {
          const id = this.getAttribute('data-id');
          const table = document.getElementById(`courses-${id}`);

          if (table.style.display === 'none' || table.style.display === '') {
            table.style.display = 'table-row';
            this.textContent = '-';
          } else {
            table.style.display = 'none';
            this.textContent = '+';
          }
        });
      });

      // Fungsi untuk Setujui Semua
      document.getElementById('approveAllButton').addEventListener('click', function () {
        const statuses = document.querySelectorAll('.status');
        statuses.forEach(status => {
          status.textContent = 'Disetujui'; // Mengubah status menjadi Disetujui
        });
      });
    });
  </script>
</body>

</html>

@endsection
