@extends('layouts.app')

@section('title', 'Persetujuan')

@section('content')
<html>
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-image: url('{{ asset('image/bg_PASTI1.png') }}');
      background-size: cover;
      background-repeat: no-repeat;
    }
  </style>
</head>
<body class="relative">
    <!-- Back Button -->
    <a href="{{ url()->previous()}}" class="absolute top-15 left-7 bg-teal-800 text-white p-2 rounded-full hover:bg-teal-700">
      <i class="fas fa-arrow-left text-xl"></i>
    </a>
<div class="bg-white shadow-lg rounded-lg mx-auto max-w-7xl p-6 mt-4">
    <!-- Konten Header -->
    <h1 class="text-2xl font-semibold text-teal-800 mb-4 text-center flex items-center justify-center space-x-2">
        <i class="fas fa-laptop text-teal-800"></i>
        <span>PERSETUJUAN JADWAL KULIAH</span>
    </h1>
    <!-- Tabel -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <!-- Table Header -->
            <thead>
                <tr class="bg-gradient-to-r from-green-400 to-yellow-300 text-teal-800 text-center font-bold">
                    <th class="py-4 px-4 border-b border-gray-300">NO</th>
                    <th class="py-4 px-4 border-b border-gray-300">NAMA KAPRODI</th>
                    <th class="py-4 px-4 border-b border-gray-300">JURUSAN</th>
                    <th class="py-4 px-4 border-b border-gray-300">STATUS</th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody class="text-center">
                <!-- Row 1 -->
                <tr class="hover:bg-gray-100">
                    <td class="py-6 px-4 border-b">1</td>
                    <td class="py-6 px-4 border-b">Saddam Dharmawan, S.Kom, M.Kom</td>
                    <td class="py-6 px-4 border-b">Informatika</td>
                    <td class="py-6 px-4 border-b">
                        <div class="flex items-center justify-center space-x-2">
                            <button class="bg-orange-300 text-teal-800 px-4 py-1 rounded-lg shadow-sm hover:bg-yellow-200 whitespace-nowrap">
                                Lihat Jadwal Kuliah
                            </button>
                            <button class="bg-orange-300 text-teal-800 px-4 py-1 rounded-lg shadow-sm hover:bg-yellow-200 flex items-center">
                                <i class="fa fa-tasks"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- Row 2 -->
                <tr class="hover:bg-gray-100">
                    <td class="py-6 px-4 border-b">2</td>
                    <td class="py-6 px-4 border-b">Dr. Azzam Muhammad, M.Si.</td>
                    <td class="py-6 px-4 border-b">Biologi</td>
                    <td class="py-6 px-4 border-b">
                        <div class="flex items-center justify-center space-x-2">
                            <button class="bg-orange-300 text-teal-800 px-4 py-1 rounded-lg shadow-sm hover:bg-yellow-200 whitespace-nowrap">
                                Lihat Jadwal Kuliah
                            </button>
                            <button class="bg-orange-300 text-teal-800 px-4 py-1 rounded-lg shadow-sm hover:bg-yellow-200 flex items-center">
                                <i class="fa fa-tasks"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- Row 3 -->
                <tr class="hover:bg-gray-100">
                    <td class="py-6 px-4 border-b">3</td>
                    <td class="py-6 px-4 border-b">Drs. Emir Habibie, M.Si</td>
                    <td class="py-6 px-4 border-b">Fisika</td>
                    <td class="py-6 px-4 border-b">
                        <div class="flex items-center justify-center space-x-2">
                            <button class="bg-orange-300 text-teal-800 px-4 py-1 rounded-lg shadow-sm hover:bg-yellow-200 whitespace-nowrap">
                                Lihat Jadwal Kuliah
                            </button>
                            <button class="bg-orange-300 text-teal-800 px-4 py-1 rounded-lg shadow-sm hover:bg-yellow-200 flex items-center">
                                <i class="fa fa-tasks"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- Row 4 -->
                <tr class="hover:bg-gray-100">
                    <td class="py-6 px-4 border-b">4</td>
                    <td class="py-6 px-4 border-b">Fianita Sari, M.SI</td>
                    <td class="py-6 px-4 border-b">Matematika</td>
                    <td class="py-6 px-4 border-b">
                        <div class="flex items-center justify-center space-x-2">
                            <button class="bg-orange-300 text-teal-800 px-4 py-1 rounded-lg shadow-sm hover:bg-yellow-200 whitespace-nowrap">
                                Lihat Jadwal Kuliah
                            </button>
                            <button class="bg-orange-300 text-teal-800 px-4 py-1 rounded-lg shadow-sm hover:bg-yellow-200 flex items-center">
                                <i class="fa fa-tasks"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- Row 5 -->
                <tr class="hover:bg-gray-100">
                    <td class="py-6 px-4 border-b">5</td>
                    <td class="py-6 px-4 border-b">Dr. Baskoro Mulyana, S.Si, M.Si</td>
                    <td class="py-6 px-4 border-b">Kimia</td>
                    <td class="py-6 px-4 border-b">
                        <div class="flex items-center justify-center space-x-2">
                            <button class="bg-orange-300 text-teal-800 px-4 py-1 rounded-lg shadow-sm hover:bg-yellow-200 whitespace-nowrap">
                                Lihat Jadwal Kuliah
                            </button>
                            <button class="bg-orange-300 text-teal-800 px-4 py-1 rounded-lg shadow-sm hover:bg-yellow-200 flex items-center">
                                <i class="fa fa-tasks"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- Row 6 -->
                <tr class="hover:bg-gray-100">
                    <td class="py-6 px-4 border-b">6</td>
                    <td class="py-6 px-4 border-b">Dr. Azzam Muhammad, M.Si.</td>
                    <td class="py-6 px-4 border-b">Bioteknologi</td>
                    <td class="py-6 px-4 border-b">
                        <div class="flex items-center justify-center space-x-2">
                            <button class="bg-orange-300 text-teal-800 px-4 py-1 rounded-lg shadow-sm hover:bg-yellow-200 whitespace-nowrap">
                                Lihat Jadwal Kuliah
                            </button>
                            <button class="bg-orange-300 text-teal-800 px-4 py-1 rounded-lg shadow-sm hover:bg-yellow-200 flex items-center">
                                <i class="fa fa-tasks"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- Row 7 -->
                <tr class="hover:bg-gray-100">
                    <td class="py-6 px-4 border-b">7</td>
                    <td class="py-6 px-4 border-b">Fianita Sari, M.SI</td>
                    <td class="py-6 px-4 border-b">Statistika</td>
                    <td class="py-6 px-4 border-b">
                        <div class="flex items-center justify-center space-x-2">
                            <button class="bg-orange-300 text-teal-800 px-4 py-1 rounded-lg shadow-sm hover:bg-yellow-200 whitespace-nowrap">
                                Lihat Jadwal Kuliah
                            </button>
                            <button class="bg-orange-300 text-teal-800 px-4 py-1 rounded-lg shadow-sm hover:bg-yellow-200 flex items-center">
                                <i class="fa fa-tasks"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
     <!-- Pagination -->
     <div class="flex items-center justify-between mt-4">
        <div class="text-gray-600">
            Rows per page:
            <select class="border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option>10</option>
                <option>15</option>
                <option>20</option>
            </select>
        </div>
        <div class="text-gray-600">
            1 to 10 of 7
        </div>
        <div class="flex space-x-2">
            <button class="text-gray-500 hover:text-teal-500">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="text-gray-500 hover:text-teal-500">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>
</body>
@endsection
</html>
