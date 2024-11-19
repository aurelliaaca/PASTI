<html>
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-image: url('{{ asset('image/bg_PASTI.png') }}');
      background-size: cover;
      background-repeat: no-repeat;
    }
  </style>
</head>

<body class="min-h-screen bg-cover bg-center">
    <div class="grid grid-cols-9 gap-0 w-full mb-4">

        <button class="col-span-3 bg-amber-400 text-white p-2 rounded-tl-xl rounded-bl-xl">
            <span class="text-white font-semibold italic">BUAT JADWAL</span>
        </button>
        <button class="col-span-3 bg-teal-700 text-white p-2 border-r-[1px] border-amber-400">
            <span class="text-white font-semibold italic">Jadwal Kuliah</span>
        </button>
        <button class="col-span-3 bg-teal-700 text-white p-2 rounded-tr-xl rounded-br-xl">
            <span class="text-white font-semibold italic">PENETAPAN</span>
        </button>
    </div>
    
    <!-- main content -->
    <main class="flex-grow p-5">
            <!-- Form Section -->
            <div class="max-w-4xl mx-auto bg-teal-700 p-6 rounded-lg shadow-lg">
                <h2 class="text-white text-xl font-semibold mb-4">Tambah Jadwal Kuliah</h2>
                <form id="jadwalForm">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-white block font-medium mb-2">Nama Mata Kuliah</label>
                            <select id="namaMk" class="w-full p-2 border rounded">
                                <option value="" disabled selected>Pilih Mata Kuliah</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-white block font-medium mb-2">Kode Mata Kuliah</label>
                            <input type="text" id="kodeMk" class="w-full p-2 border rounded" readonly>
                        </div>
                        <div>
                            <label class="text-white block font-medium mb-2">SKS</label>
                            <input type="number" id="sksMk" class="w-full p-2 border rounded" readonly>
                        </div>
                        <div>
                            <label class="text-white block font-medium mb-2">Semester</label>
                            <input type="number" id="semesterMk" class="w-full p-2 border rounded" readonly>
                        </div>
                        <div>
                            <label class="text-white block font-medium mb-2">Kelas</label>
                            <select id="kelasMk" class="w-full p-2 border rounded">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-white block font-medium mb-2">Jam Mulai</label>
                            <input type="time" id="jamMulai" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="text-white block font-medium mb-2">Jam Selesai</label>
                            <input type="time" id="jamSelesai" class="w-full p-2 border rounded" readonly>
                        </div>
                        <div>
                            <label class="text-white block font-medium mb-2">Hari</label>
                            <select id="hari" class="w-full p-2 border rounded">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" id="addJadwal" class="mt-4 w-full bg-green-500 text-white py-2 rounded hover:bg-green-700">Tambah Jadwal</button>
                </form>
            </div>

            <!-- Jadwal Table -->
            <div class="mt-8">
                <div class="col-span-3 bg-amber-400 text-white p-2 rounded-tl rounded-tr">
                <h2 class="text-xl font-semibold mb-4 text-center">Jadwal Kuliah</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full border text-center table-auto">
                        <thead class="bg-teal-700 text-white">
                            <tr>
                                <th class="border px-4 py-2">No</th>
                                <th class="border px-4 py-2">Nama Mata Kuliah</th>
                                <th class="border px-4 py-2">Kode</th>
                                <th class="border px-4 py-2">SKS</th>
                                <th class="border px-4 py-2">Hari</th>
                                <th class="border px-4 py-2">Jam</th>
                                <th class="border px-4 py-2">Kelas</th>
                                <th class="border px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="jadwalTable" class="text-gray-800">
                            <!-- Dynamic content here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Dummy Data
        const mataKuliahData = [
            { kode: "MK001", nama: "Matematika", sks: 3, semester: 1 },
            { kode: "MK002", nama: "Fisika", sks: 2, semester: 2 },
            { kode: "MK003", nama: "Kimia", sks: 3, semester: 3 },
        ];
        const jadwalData = [];

        // Populate Mata Kuliah Dropdown
        const namaMkSelect = document.getElementById("namaMk");
        mataKuliahData.forEach((mk) => {
            const option = document.createElement("option");
            option.value = mk.kode;
            option.textContent = mk.nama;
            option.dataset.kode = mk.kode;
            option.dataset.sks = mk.sks;
            option.dataset.semester = mk.semester;
            namaMkSelect.appendChild(option);
        });

        // Populate Mata Kuliah Details on Selection
        namaMkSelect.addEventListener("change", function () {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById("kodeMk").value = selectedOption.dataset.kode;
            document.getElementById("sksMk").value = selectedOption.dataset.sks;
            document.getElementById("semesterMk").value = selectedOption.dataset.semester;
        });

        // Add Jadwal
        const addJadwalBtn = document.getElementById("addJadwal");
        const jadwalTable = document.getElementById("jadwalTable");

        addJadwalBtn.addEventListener("click", () => {
            const nama = namaMkSelect.options[namaMkSelect.selectedIndex]?.text || "";
            const kode = document.getElementById("kodeMk").value;
            const sks = document.getElementById("sksMk").value;
            const semester = document.getElementById("semesterMk").value;
            const kelas = document.getElementById("kelasMk").value;
            const hari = document.getElementById("hari").value;
            const jamMulai = document.getElementById("jamMulai").value;
            const jamSelesai = document.getElementById("jamSelesai").value;

            if (!nama || !kode || !sks || !kelas || !hari || !jamMulai) {
                Swal.fire("Error", "Semua field harus diisi!", "error");
                return;
            }

            jadwalData.push({ nama, kode, sks, semester, kelas, hari, jam: `${jamMulai} - ${jamSelesai}` });
            renderJadwal();
        });

        // Render Jadwal Table with alternating background colors
        function renderJadwal() {
            jadwalTable.innerHTML = "";
            jadwalData.forEach((jadwal, index) => {
                const row = document.createElement("tr");
                // Set alternating background colors (light gray for odd rows)
                row.classList.add(index % 2 === 0 ? "bg-gray-50" : "bg-gray-100", "hover:bg-gray-200");
                row.innerHTML = `
                    <td class="border px-4 py-2">${index + 1}</td>
                    <td class="border px-4 py-2">${jadwal.nama}</td>
                    <td class="border px-4 py-2">${jadwal.kode}</td>
                    <td class="border px-4 py-2">${jadwal.sks}</td>
                    <td class="border px-4 py-2">${jadwal.hari}</td>
                    <td class="border px-4 py-2">${jadwal.jam}</td>
                    <td class="border px-4 py-2">${jadwal.kelas}</td>
                    <td class="border px-4 py-2">
                        <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-700" onclick="deleteJadwal(${index})">Hapus</button>
                    </td>
                `;
                jadwalTable.appendChild(row);
            });
        }

        // Delete Jadwal
        function deleteJadwal(index) {
            jadwalData.splice(index, 1);
            renderJadwal();
        }
    </script>
</body>
</html>
