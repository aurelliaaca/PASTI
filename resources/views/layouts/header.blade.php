<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<body class="bg-gradient-to-r from-teal-600 to-amber-500 bg-opacity-100 flex">
    <div class="p-4 pb-0">
        <!-- Header Component -->
        <header class="bg-gradient-to-r from-teal-800 to-teal-600 p-4 flex justify-between rounded-xl">
            <div class="flex items-center">
                <!-- Logo and Title as a Button -->
                <a href="{{ url()->previous() }}" class="flex items-center">
                    <img alt="University logo" class="h-12 w-11 mr-4 cursor-pointer" src="{{ asset('image/LogoUNDIP.png') }}"/>
                    <div>
                        <div class="text-amber-400 font-black italic text-xl cursor-pointer">
                            PASTI
                        </div>
                        <div class="text-white text-sm cursor-pointer">
                            Universitas Diponegoro
                        </div>
                    </div>
                </a>
            </div>
            <div class="flex items-center">
            <!-- Page Route Display -->
            <div class="text-white italic mr-4">
                <span>Dashboard / {{ ucwords(str_replace('_', ' ', Route::currentRouteName())) }}</span>
            </div>

            <!-- Profile Icon with Dropdown -->
            <div class="relative">
                <!-- Profile Icon (you can replace this with an actual icon or SVG) -->
                <button class="flex items-center text-white" id="profile-btn">
                    <!-- Using Font Awesome for outline user icon -->
                    <div class="bg-teal-700 py-3 px-4  rounded-full">
                        <i class="far fa-user text-white text-2xl"></i>
                    </div>
                </button>

                <!-- Dropdown Menu -->
                <div id="dropdown-menu" class="absolute right-0 mt-2 w-40 bg-white text-teal-800 rounded-lg shadow-lg opacity-20 invisible transition-opacity duration-300">
                    <!-- Akun Saya -->
                    <a href="{{ route('profile') }}" class="block py-2 px-4 text-sm font-semibold hover:bg-teal-100 rounded-t-lg">
                        <i class="far fa-user mr-2"></i> Akun Saya
                    </a>
                    <!-- Logout -->
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="block py-2 px-4 text-sm hover:bg-teal-100 rounded-b-lg">
                            <i class="fa fa-sign-out text-xs mr-2"></i> Logout
                        </button>
                    </form>                    
                </div>
            </div>
        </header>
    </div>

    <div class="content bg-transparent">
        <!-- Your page-specific content goes here -->
    </div>

    <script>
        // JavaScript to toggle dropdown visibility
        const profileBtn = document.getElementById('profile-btn');
        const dropdownMenu = document.getElementById('dropdown-menu');

        profileBtn.addEventListener('click', function() {
            // Toggle visibility of the dropdown menu
            dropdownMenu.classList.toggle('opacity-0');
            dropdownMenu.classList.toggle('invisible');
            dropdownMenu.classList.toggle('opacity-100');
            dropdownMenu.classList.toggle('visible');
        });

        // Optionally close dropdown when clicking outside
        window.addEventListener('click', function(event) {
            if (!profileBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('opacity-0');
                dropdownMenu.classList.add('invisible');
                dropdownMenu.classList.remove('opacity-100');
                dropdownMenu.classList.remove('visible');
            }
        });
    </script>
</body>