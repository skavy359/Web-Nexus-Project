<?php
session_start();

// More secure user "database"
$users = [
    'john' => [
        'password' => password_hash('123', PASSWORD_BCRYPT), 
        'role' => 'user', 
        'id' => 1234
    ],
    'admin' => [
        'password' => password_hash('123', PASSWORD_BCRYPT), 
        'role' => 'admin', 
        'id' => 9999
    ]
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // SECURE: Proper password verification
    if (isset($users[$username]) && 
        password_verify($password, $users[$username]['password'])) {
        
        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);
        
        // Store only necessary, non-sensitive information
        $_SESSION['user_id'] = $users[$username]['id'];
        $_SESSION['role'] = $users[$username]['role'];
        $_SESSION['username'] = $username;
        
        // Use random token for CSRF protection
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        
        header("Location: secure_dashboard.php");
        exit();
    } else {
        // Deliberate delay to prevent timing attacks
        sleep(1);
        $error = 'Invalid credentials';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-green-600">Secure Login</h2>
        
        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <input 
                type="text" 
                name="username" 
                placeholder="Username" 
                required 
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
            >
            <input 
                type="password" 
                name="password" 
                placeholder="Password" 
                required 
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
            >
            <button 
                type="submit" 
                class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600 transition duration-300"
            >
                Login
            </button>
        </form>
        
        <div class="mt-4 text-center text-sm text-green-600">
            Secure login with multiple protection mechanisms
        </div>
    </div>
</body>
</html>