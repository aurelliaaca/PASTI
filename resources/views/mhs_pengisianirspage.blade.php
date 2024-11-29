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
    <!-- Header dengan Tombol -->
    <div class="flex w-full mb-4">
      <button class="btn flex-1 bg-amber-400 text-white p-2 rounded-tl-xl rounded-bl-xl shadow-sm hover:bg-orange-400 whitespace-nowrap flex justify-center items-center" data-filter=".IRS">
        <span class="font-semibold italic text-center">IRS</span>
      </button>
      <button class="btn flex-1 bg-teal-700 text-white p-2 rounded-tr-xl rounded-br-xl shadow-sm hover:bg-orange-400 whitespace-nowrap flex justify-center items-center" data-filter=".KRS">
        <span class="font-semibold italic text-center">KRS</span>
      </button>
    </div>
    
    <div class="IRS">
    <!-- Main Content Section -->
    <div class="flex justify-center grid grid-cols-8 gap-4 w-full">
      <!-- Left Section (Profile) -->
      <div class="col-span-2 bg-teal-800/80 text-white p-4 rounded-lg">
        <div class="flex flex-col items-center space-y-2">
          <!-- Existing profile information remains the same -->
          <div class="text-left w-full">
                <div class="space-y-0">
                <div class="flex">
                    <p class="text-sm align-top w-[100px] font-semibold">NAMA</p>
                    <p class="text-sm align-top w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle text-justify w-full">Muhammad Faiq As-sajad</p>
                </div>

                <div class="flex">
                    <p class="text-sm align-top w-[100px] font-semibold">NIM</p>
                    <p class="text-sm align-top w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">14050122120168</p>
                </div>
                </div>
            </div>

            <div class="w-full h-px bg-white rounded-lg">
            </div>

            <div class="text-left w-full">
                <div class="space-y-0">
                <div class="flex">
                    <p class="text-sm align-top w-[300px] font-semibold">TAHUN AJARAN</p>
                    <p class="text-sm align-top w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">2024/2025</p>
                </div>

                <div class="flex">
                    <p class="text-sm align-top  w-[300px] font-semibold">GANJIL/GENAP</p>
                    <p class="text-sm align-top  w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">Ganjil</p>
                </div>

                <div class="flex">
                    <p class="text-sm align-top w-[300px] font-semibold">SEMESTER</p>
                    <p class="text-sm align-top  w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">5</p>
                </div>
                
                <div class="flex">
                    <p class="text-sm align-top  w-[300px] font-semibold">IPK</p>
                    <p class="text-sm align-top  w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">3,67</p>
                </div>
                
                <div class="flex">
                    <p class="text-sm align-top w-[300px] font-semibold">IPS</p>
                    <p class="text-sm align-top w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">3,75</p>
                </div>

                <div class="flex">
                    <p class="text-sm align-top w-[300px] font-semibold">MAX BEBAN SKS</p>
                    <p class="text-sm align-top w-[20px] font-semibold">:</p>
                    <p class="text-sm align-middle w-full">24</p>
                </div>
                </div>
            </div>

          <!-- Course Dropdown -->
          <div class="w-full mt-4">
            <select id="matkul-dropdown" class="w-full p-4 rounded bg-white text-teal-800 text-xs">
              <option value="">-- Pilih Mata Kuliah --</option>
              <!-- Options will be populated dynamically -->
            </select>
          </div>

          <div id="selected-course-info" class="w-full">
            <!-- Info for selected courses will be added dynamically here -->
          </div>

          <div class="grid grid-cols-2 w-full flex-grow space-x-2">
            <button id="reset-btn" class="bg-white text-teal-700 p-2 rounded-lg items-center space-x-2">
              <span class="text-base font-semibold italic">RESET</span>
            </button>
            <button id="ajukan-btn" class="bg-amber-400 text-white p-2 rounded-lg items-center space-x-2">
              <span class="text-base font-semibold italic">AJUKAN</span>
            </button>
          </div>
        </div>
      </div>
      
      <!-- Right Section -->
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
                  <!-- Courses will be dynamically added here -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- KRS -->
  <div class="KRS">

  </div>

  

  <script>
  document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.btn');
            const sections = document.querySelectorAll('.IRS, .KRS');

            function toggleContent(filter) {
                sections.forEach(section => {
                    section.style.display = 'none';
                });

                const activeSection = document.querySelector(filter);
                if (activeSection) {
                    activeSection.style.display = 'block';
                }
            }

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    const filter = this.getAttribute('data-filter');

                    buttons.forEach(btn => {
                        btn.classList.remove('bg-amber-400');
                        btn.classList.add('bg-teal-700');
                    });

                    this.classList.remove('bg-teal-700');
                    this.classList.add('bg-amber-400');

                    toggleContent(filter);
                });
            });

            const defaultButton = document.querySelector('.btn[data-filter=".IRS"]');
            if (defaultButton) {
                defaultButton.classList.add('bg-amber-400');
                toggleContent('.IRS');
            }
        });

  $(document).ready(function() {
  // Dummy course data
  const courseData = [
    {
      id: 'PBP001',
      name: 'Pengembangan Berbasis Platform',
      kode: 'IF-404',
      sks: 3,
      hari: 'Senin',
      jam: '08:00 - 10:30',
      kelas: 'A'
    },
    {
      id: 'KTP001',
      name: 'Komputasi Tersebar Paralel',
      kode: 'IF-405',
      sks: 3,
      hari: 'Selasa',
      jam: '10:00 - 12:30',
      kelas: 'B'
    }
  ];

  // Populate dropdown
  const $dropdown = $('#matkul-dropdown');
  courseData.forEach(course => {
    $dropdown.append(`
      <option value="${course.id}">
        ${course.name} (${course.kode})
      </option>
    `);
  });

  // Track selected courses
  const selectedCourses = new Set();

  // Dropdown change event
  $('#matkul-dropdown').change(function() {
    const selectedCourseId = $(this).val();
    
    if (selectedCourseId) {
      const course = courseData.find(c => c.id === selectedCourseId);
      
      // Add selected course to the left panel
      if (!selectedCourses.has(selectedCourseId)) {
        selectedCourses.add(selectedCourseId);

        // Append the course information to the #selected-course-info section
        $('#selected-course-info').append(`
  <div id="selected-course-${course.id}" class="flex items-center bg-orange-200 text-teal-700 p-1 rounded mb-2">
    <!-- Nama mata kuliah -->
    <div class="flex-grow overflow-hidden break-words">
      <p class="text-[12px] text-justify">${course.name}</p>
    </div>
    <!-- Kode SKS dan tombol trash -->
    <div class="flex items-center justify-end min-w-[120px] max-w-[120px]">
      <p class="text-[12px] text-right font-semibold pr-2">${course.kode} (${course.sks} SKS)</p>
      <button onclick="removeCourse('${course.id}')" class="text-red-500 hover:text-red-700">
        <i class="fas fa-trash-alt"></i>
      </button>
    </div>
  </div>
`);


        // Add the course to the table in the right panel
        $('#jadwalTableBody').append(`
          <tr id="course-row-${course.id}" class="bg-white hover:bg-teal-50">
            <td class="px-4 py-2 border">${course.name}</td>
            <td class="px-4 py-2 border">${course.kode}</td>
            <td class="px-4 py-2 border">${course.sks}</td>
            <td class="px-4 py-2 border">${course.hari}</td>
            <td class="px-4 py-2 border">${course.jam}</td>
            <td class="px-4 py-2 border">${course.kelas}</td>
            <td class="px-4 py-2 border">
              <button onclick="removeCourseFromTable('${course.id}')" class="text-red-500 hover:text-red-700">
                <i class="fas fa-trash-alt"></i>
              </button>
              <button onclick="ambilCourse('${course.id}')" class="text-green-500 hover:text-green-700">
                <i class="fas fa-check-circle"></i> Ambil
              </button>
            </td>
          </tr>
        `);

        // Clear the dropdown selection
        $(this).val('');
      }
    }
  });

  // Remove course from the left panel (selected courses info)
  window.removeCourse = function(courseId) {
    $(`#selected-course-${courseId}`).remove();
    selectedCourses.delete(courseId);
    // Also remove from the right panel (table)
    $(`#course-row-${courseId}`).remove();
  };

  // Remove course from the right panel (jadwalTable)
  window.removeCourseFromTable = function(courseId) {
    $(`#course-row-${courseId}`).remove();
    selectedCourses.delete(courseId);
    // Also remove from the left panel (selected courses info)
    $(`#selected-course-${courseId}`).remove();
  };

  // Ambil course function
  window.ambilCourse = function(courseId) {
    alert(`Mata kuliah ${courseData.find(c => c.id === courseId).name} diambil!`);
  };

  // Reset button
  $('#reset-btn').click(function() {
    $('#selected-course-info').empty();
    $('#jadwalTableBody').empty();
    selectedCourses.clear();
  });

  // Ajukan button
  // Ajukan button
$('#ajukan-btn').click(function() {
    if (selectedCourses.size > 0) {
        // Menampilkan mata kuliah yang diajukan di bagian KRS
        const krsContent = Array.from(selectedCourses).map(id => {
            const course = courseData.find(c => c.id === id);
            return `
            <div class="flex items-center bg-teal-100 text-teal-700 p-2 mb-2 rounded-lg">
                <div class="flex-grow">
                    <p class="text-sm">${course.name} (${course.kode})</p>
                </div>
                <div class="flex items-center justify-end">
                    <p class="text-sm font-semibold pr-2">${course.sks} SKS</p>
                </div>
            </div>
            `;
        }).join('');

        // Menampilkan daftar mata kuliah yang diajukan di KRS
        $('.KRS').html(`
            <div class="bg-teal-800/80 text-white p-4 rounded-lg">
                <h3 class="text-xl font-semibold">Mata Kuliah yang Diajukan:</h3>
                <div class="mt-4">
                    ${krsContent}
                </div>
            </div>
        `);
    } else {
        alert('Pilih mata kuliah terlebih dahulu');
    }
});

  });

  </script>
</body>
</html>
@endsection