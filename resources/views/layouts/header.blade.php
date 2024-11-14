<!-- Header Component -->
<header class="bg-gradient-to-r from-teal-700 to-teal-600 p-4 flex items-center justify-between">
  <div class="flex items-center">
    <!-- Logo and Title -->
    <img alt="University logo" class="h-12 w-12 mr-4" src="{{ asset('image/LogoUNDIP.png') }}"/>
    <div>
      <div class="text-yellow-500 font-bold text-xl">
        PASTI
      </div>
      <div class="text-white text-sm">
        Universitas Diponegoro
      </div>
    </div>
  </div>

  <!-- Page Route Display -->
  <div class="text-white italic">
    <span>Dashboard / {{ ucwords(str_replace('_', ' ', Route::currentRouteName())) }}</span>
  </div>

  <!-- Mobile Menu Icon -->
  <div class="md:hidden">
    <button id="menu-btn" class="text-white focus:outline-none">
      <i class="fas fa-bars text-2xl"></i>
    </button>
  </div>
</header>

<script>
  // Toggle Dropdown Menu
  document.getElementById("menu-btn").addEventListener("click", function() {
    var dropdown = document.getElementById("dropdown");
    dropdown.classList.toggle("hidden");
  });
</script>
