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
<body class="min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('image/bg_PASTI.png') }}'); background-size: cover; background-repeat: no-repeat;">
  <div class="max-w-7xl mx-auto p-4 min-h-screen">
    
    <!-- Main Content Section -->
    <div class="flex justify-center items-center bg-teal-800 bg-opacity-80 p-8 rounded-lg shadow-lg w-full mt-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
        
        <!-- Left Section (Profile) -->
        <div class="col-span-1 bg-teal-900 text-white p-4 rounded-lg">
            <div class="flex flex-col items-center">
            <img alt="Profile Picture" class="rounded-full mb-4" src="https://storage.googleapis.com/a1aa/image/jEeIR1lbHdSRFyx09qwUYuweRpeBrz74XEEmmYOUVr1iAzdnA.jpg" width="100" height="100"/>
            <h2 class="text-center text-lg font-semibold mb-2">Profil</h2>
            <div class="text-left w-full">
                <div class="space-y-2">
                <div class="flex">
                    <p class="w-24 font-semibold">NAMA</p>
                    <p>: Muhammad Faiq As-sajad</p>
                </div>
                <div class="flex">
                    <p class="w-24 font-semibold">NIM</p>
                    <p>: 14050122120168</p>
                </div>
                <div class="flex">
                    <p class="w-24 font-semibold">EMAIL</p>
                    <p>: mfaiq@student.undip.ac.id</p>
                </div>
                <div class="flex">
                    <p class="w-24 font-semibold">NO. TELP</p>
                    <p>: 086934762034</p>
                </div>
                <div class="flex">
                    <p class="w-24 font-semibold">PRODI</p>
                    <p>: S1 Informatika</p>
                </div>
                </div>
            </div>

                <div class="flex justify-between mt-4 space-x-10">
                <div>
                    <p class="text-center font-bold text-2xl">IPK</p>
                    <p class="text-center text-2xl">3.67</p>
                </div>
                <div>
                    <p class="text-center font-bold text-2xl">SKS</p>
                    <p class="text-center text-2xl">90</p>
                </div>
                </div>
            </div>
        </div>
        
        <!-- Right Section (Notifications) -->
        <div class="col-span-2 bg-teal-900 text-white p-4 rounded-lg">
          <div class="space-y-4">
            <div class="bg-teal-800 p-4 rounded-lg flex justify-between items-center">
              <div>
                <i class="far fa-envelope text-2xl"></i>
              </div>
              <div>
                <p class="text-sm text-justify pl-3.5 pr-4">[21/07 - 11.31] Pengajuan IRS Anda telah berhasil disetujui. Silakan periksa kembali jadwal kuliah dan pastikan semua mata kuliah yang dipilih sudah sesuai.</p>
              </div>
              <div class="flex space-x-2">
                <button class="bg-white text-teal-800 p-2 rounded-lg flex items-center space-x-2">
                  <span class="text-sm">Hapus</span>
                  <i class="far fa-trash-alt"></i>
                </button>
                <button class="bg-white text-teal-800 p-2 rounded-lg flex items-center space-x-2">
                  <span class="text-sm">Tinjau</span>
                  <i class="far fa-paper-plane"></i> 
                </button>
              </div>
            </div>
            
            <div class="bg-teal-800 p-4 rounded-lg flex justify-between items-center">
              <div>
                <i class="far fa-envelope text-2xl"></i>
              </div>
              <div>
                <p class="text-sm text-justify pl-3.5 pr-4">[20/07 - 20.28] Pengajuan IRS Anda telah berhasil diproses. Mohon untuk menunggu proses verifikasi dari pihak akademik. Silahkan pantau status pengajuan Anda secara berkala melalui sistem.</p>
              </div>
              <div class="flex space-x-2">
                <button class="bg-white text-teal-800 p-2 rounded-lg flex items-center space-x-2">
                  <span class="text-sm">Hapus</span>
                  <i class="far fa-trash-alt"></i>
                </button>
                <button class="bg-white text-teal-800 p-2 rounded-lg flex items-center space-x-2">
                  <span class="text-sm">Tinjau</span>
                  <i class="far fa-paper-plane"></i> 
                </button>
              </div>
            </div>
            
            <div class="bg-teal-800 p-4 rounded-lg flex justify-between items-center">
              <div>
                <i class="far fa-envelope text-2xl"></i>
              </div>
              <div>
                <p class="text-sm text-justify pl-3.5 pr-4">[19/07 - 12.48] Terima kasih, pembayaran UKT Anda telah berhasil. Simpan bukti pembayaran ini untuk keperluan administrasi lebih lanjut.</p>
              </div>
              <div class="flex space-x-2">
                <button class="bg-white text-teal-800 p-2 rounded-lg flex items-center space-x-2">
                  <span class="text-sm">Hapus</span>
                  <i class="far fa-trash-alt"></i>
                </button>
                <button class="bg-white text-teal-800 p-2 rounded-lg flex items-center space-x-2">
                  <span class="text-sm">Tinjau</span>
                  <i class="far fa-paper-plane"></i> 
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Container for Centered Buttons -->
        <div class="col-span-3 flex justify-center space-x-4 mt-4">
            <!-- IRS Button -->
            <button class="bg-yellow-500 text-white px-16 py-5 rounded-lg flex items-center space-x-2">
                <i class="far fa-file-alt text-3xl"></i>
                <span class="text-2xl">IRS</span>
            </button>
        </div>

      </div>
    </div>
  </div>
</body>
</html>