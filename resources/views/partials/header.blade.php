<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-teal-800">
    <?php
    // Start the session
    session_start();

    // Assuming you have a database connection file
    include 'db_connection.php';

    // Fetch the logged-in user's name from the database
    $userId = $_SESSION['user_id']; // Assuming user_id is stored in session
    $query = "SELECT name FROM users WHERE id = $userId";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    $userName = $user['name'];
    ?>
    <header class="flex items-center justify-between p-4 bg-teal-800">
        <div class="flex items-center">
            <img alt="University logo" class="h-12 w-12" height="50" src="{{ asset('image/LogoUNDIP.png') }}" width="50"/>
            <div class="ml-2">
                <h1 class="text-yellow-500 font-bold text-lg">PASTI</h1>
                <p class="text-white text-sm">Universitas Diponegoro</p>
            </div>
        </div>
        <div class="flex items-center text-white">
            <i class="fas fa-user-circle text-xl"></i>
            <span class="ml-2"><?php echo $userName; ?></span>
            <i class="fas fa-chevron-down ml-2"></i>
        </div>
    </header>
</body>
</html>