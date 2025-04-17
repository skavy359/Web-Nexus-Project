<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /Web-Nexus-Project/Kartavya/Login_Pages/login_page.php");
    exit;
}



// Extremely insecure user "database"
$users = [
    'john' => ['password' => '123', 'role' => 'user', 'id' => 1234],
    'admin' => ['password' => '123', 'role' => 'admin', 'id' => 9999]
];

$error = '';

// Check for URL parameters
if (isset($_GET['username']) && isset($_GET['password'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];

    // VULNERABLE: Simple direct comparison via URL parameters
    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $_SESSION['user'] = $users[$username];
        header("Location: vulnerable_dashboard.php?username=$username&password=$password");
        exit();
    } else {
        $error = 'Invalid credentials';
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">


</head>
<body class="bg-[#020617] font-['Lexend'] selection:text-yellow-400 cursor-[url('/Assets/Images/cursor_01.png'),_auto]">
    <div class="flex flex-row max-md:flex-col items-center justify-center">
        <div class="bg-green-400">
        <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-red-600">Vulnerable Login</h2>
        
        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        
        <div class="text-sm text-red-600 mb-4">
            Example URLs:
            <br>
            <a href="?username=john&password=123">Login as John</a>
            <br>
            <a href="?username=admin&password=123">Login as Admin</a>
        </div>

        <form method="GET" class="space-y-4">
            <input 
                type="text" 
                name="username" 
                placeholder="Username" 
                required 
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
            >
            <input 
                type="password" 
                name="password" 
                placeholder="Password" 
                required 
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
            >
            <button 
                type="submit" 
                class="w-full bg-red-500 text-white py-2 rounded-md hover:bg-red-600 transition duration-300"
            >
                Login
            </button>
        </form>
        
        <div class="mt-4 text-center text-sm text-red-600">
            Warning: This login system has MULTIPLE security vulnerabilities!
        </div>
    </div>
        </div>
        <div class="bg-red-400">2</div>
    </div>
</body>
</html>