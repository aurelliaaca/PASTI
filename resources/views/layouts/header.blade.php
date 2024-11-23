<body class="bg-gradient-to-r from-teal-600 to-amber-500 bg-opacity-100">
    <div class="p-4 pb-0">
        <!-- Header Component -->
        <header class="bg-gradient-to-r from-teal-800 to-teal-600 p-4 flex items-center justify-between rounded-xl">
            <div class="flex items-center">
                <!-- Logo and Title -->
                <img alt="University logo" class="h-12 w-11 mr-4" src="{{ asset('image/LogoUNDIP.png') }}"/>
                <div>
                    <div class="text-amber-400 font-black italic text-xl">
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
        </header>
    </div>

    <!-- Content Section with Specific Background -->
    <div class="content bg-transparent"> <!-- Ensure this section has no conflicting background -->
        <!-- Your page-specific content goes here -->
    </div>

    <script>
        // Toggle Dropdown Menu
        document.getElementById("menu-btn").addEventListener("click", function() {
            var dropdown = document.getElementById("dropdown");
            dropdown.classList.toggle("hidden");
        });
    </script>
</body>
