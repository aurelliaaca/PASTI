<!DOCTYPE html>
<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Rubik&display=swap');

        .error-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .error-card {
            background: white;
            border-radius: 8px;
            width: 475px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.8);
            font-family: 'Rubik', sans-serif;
        }

        .error-header {
            padding: 1.5rem;
            text-align: center;
        }

        .error-body {
            padding: 1.5rem;
        }

        .error-btn {
            background: #EAB308;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
        }

        .error-btn:hover {
            background: #CA8A04;
        }

        .inner li {
            list-style-type: disc !important;
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div id="errorContainer" class="error-container">
        <div class="error-card">
            <div class="error-header bg-teal-800 bg-opacity-80 rounded-t-lg">
                <h6 class="font-bold mb-4 text-white">
                    <i class="fas fa-broadcast-tower text-2xl mr-3"></i>
                    No Internet Connection
                </h6>
                <div class="bg-teal-800 p-4 rounded-lg">
                    <img src="{{ asset('image/no_internet.png') }}" class="w-70 my-8 mx-auto" alt="No Internet"/>
                </div>
            </div>
            <div class="error-body">
                <ul class="text-gray-600">
                    <li>Please re-connect to the internet to continue use Footsteps.</li>
                    <li>If you encounter problems:</li>
                    <ul class="mt-2 inner">
                        <li>Try restarting wireless connection on this device.</li>
                        <li>Move close to your wireless access point.</li>
                    </ul>
                </ul>
                <div class="text-right mt-4">
                    <button onclick="window.location.reload()" class="error-btn">
                        Try Again
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Check internet connection
        function checkConnection() {
            const errorContainer = document.getElementById('errorContainer');
            
            if (!navigator.onLine) {
                errorContainer.style.display = 'flex';
            } else {
                errorContainer.style.display = 'none';
            }
        }

        // Listen for online/offline events
        window.addEventListener('online', checkConnection);
        window.addEventListener('offline', checkConnection);

        // Initial check
        checkConnection();
    </script>
</body>
</html>