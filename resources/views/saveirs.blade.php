@extends('layouts.app')

@section('title', 'PengisianIRS')

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
    <!-- Existing header and navigation remains the same -->

    <div class="flex justify-center grid grid-cols-8 gap-4 w-full">
      <!-- Left Section (Profile) -->
      <div class="col-span-2 bg-teal-800/80 text-white p-4 rounded-lg">
        <!-- Profile Info ... (unchanged) -->

        <div class="w-full mt-4">
          <select id="matkul-dropdown" class="w-full p-4 rounded bg-white text-teal-800 text-xs">
            <option value="">-- Pilih Mata Kuliah --</option>
            @foreach($matkul as $mk)
              <option value="{{ $mk->kode }}" data-name="{{ $mk->nama }}" data-sks="{{ $mk->sks }}">{{ $mk->nama }}</option>
            @endforeach
          </select>
        </div>

        <div id="selected-matkul" class="w-full mt-4">
            <!-- Info for selected courses will be added dynamically here -->
        </div>
      </div>

      <!-- Jadwal Table -->
      <div class="col-span-6">
        <div class="bg-teal-800/80 text-teal-900 p-4 rounded-lg">
            <div class="overflow-x-auto rounded-lg">
                <table class="table-auto w-full text-center rounded-lg border-collapse">
                    <thead>
                        <tr class="bg-teal-100/80">
                            <th class="px-4 py-2 border-r border-teal-500">Nama Mata Kuliah</th>
                            <th class="px-4 py-2 border-r border-teal-500">Kode</th>
                            <th class="px-4 py-2 border-r border-teal-500">SKS</th>
                            <th class="px-4 py-2 border-r border-teal-500">Hari</th>
                            <th class="px-4 py-2 border-r border-teal-500">Jam</th>
                            <th class="px-4 py-2 border-r border-teal-500">Kelas</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="jadwalTableBody">
                        <!-- Jadwal akan ditampilkan di sini setelah pemilihan mata kuliah -->
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>

  <script>
  document.getElementById('matkul-dropdown').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const courseId = this.value;
    const courseName = selectedOption.getAttribute('data-name');
    const courseSks = selectedOption.getAttribute('data-sks');

    const jadwalTableBody = document.getElementById('jadwalTableBody');

    // Kosongkan tabel sebelumnya
    jadwalTableBody.innerHTML = '';

    // Jika ada mata kuliah yang dipilih
    if (courseId && courseName) {
        const selectedMatkulDiv = document.createElement('div');
        selectedMatkulDiv.classList.add('flex', 'items-center', 'bg-teal-500', 'p-2', 'rounded', 'mb-2');
        selectedMatkulDiv.id = `course-${courseId}`;

        selectedMatkulDiv.innerHTML = `
            <div class="flex-grow overflow-hidden break-words">
                <p class="text-[12px] text-justify">${courseName}</p>
            </div>
            <div class="flex items-center justify-end min-w-[120px] max-w-[120px]">
                <p class="text-[12px] text-right font-semibold pr-2">${courseId} (${courseSks} SKS)</p>
            </div>
        `;
        document.getElementById('selected-matkul').appendChild(selectedMatkulDiv);

        // Filter jadwal yang sesuai dengan mata kuliah yang dipilih
        // Fetch data jadwal berdasarkan kode mata kuliah
        fetch(`/get-jadwal-mk/${courseId}`)
                        .then(response => response.json())
                        .then(data => {
                            jadwalTableBody.innerHTML = '';

                            if (data.length > 0) {
                                data.forEach(jadwal => {
                                    const row = `
                                        <tr class="bg-white">
                                            <td class="border px-4 py-2">${jadwal.matkul.nama}</td>
                                            <td class="border px-4 py-2">${jadwal.kodemk}</td>
                                            <td class="border px-4 py-2">${jadwal.matkul.sks}</td>
                                            <td class="border px-4 py-2">${jadwal.hari}</td>
                                            <td class="border px-4 py-2">${jadwal.jam_mulai}</td>
                                            <td class="border px-4 py-2">${jadwal.kelas}</td>
                                            <td class="border px-4 py-2">
                                                <button class="bg-teal-500 text-white px-4 py-1 rounded">Pilih</button>
                                            </td>
                                        </tr>
                                    `;
                                    jadwalTableBody.innerHTML += row;
                                });
                            } else {
                                jadwalTableBody.innerHTML = '<tr><td colspan="7">Jadwal tidak ditemukan</td></tr>';
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching jadwal:', error);
                            jadwalTableBody.innerHTML = '<tr><td colspan="7">Terjadi kesalahan saat mengambil data jadwal.</td></tr>';
                        });
                }
            });
            
        </script> 
</body>
</html>
@endsection
