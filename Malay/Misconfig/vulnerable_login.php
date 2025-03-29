<?php
session_start();

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vulnerable Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-red-600">Vulnerable Login</h2>
        
        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <!-- Example of how to use URL parameters -->
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
</body>
</html>