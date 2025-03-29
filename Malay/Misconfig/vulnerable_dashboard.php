<?php
session_start();

// Check if user is logged in via URL parameters
if (!isset($_GET['username']) || !isset($_GET['password'])) {
    header("Location: vulnerable_login.php");
    exit();
}

// Extremely insecure user "database"
$users = [
    'john' => ['password' => '123', 'role' => 'user', 'id' => 1234],
    'admin' => ['password' => '123', 'role' => 'admin', 'id' => 9999]
];

$username = $_GET['username'];
$password = $_GET['password'];

// CRITICAL VULNERABILITY: Direct authentication via URL parameters
if (!isset($users[$username]) || $users[$username]['password'] !== $password) {
    header("Location: vulnerable_login.php");
    exit();
}

$user = $users[$username];

// Mock sensitive data that should be protected
$sensitive_data = [
    1234 => [
        'name' => 'John Doe',
        'salary' => '$85,000',
        'ssn' => '123-45-6789',
        'credit_card' => '4111-1111-1111-1111'
    ],
    9999 => [
        'name' => 'Admin User',
        'salary' => '$150,000',
        'ssn' => '987-65-4321',
        'credit_card' => '5500-0000-0000-0004'
    ]
];

// CRITICAL VULNERABILITY: Directly accessing sensitive data using user ID
$user_sensitive_data = $sensitive_data[$user['id']];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vulnerable User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-50 min-h-screen">
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-6 text-red-600">
                Vulnerable User Dashboard
            </h1>
            
            <div class="bg-red-100 border-l-4 border-red-500 p-4 mb-6" role="alert">
                <p class="font-bold text-red-700">SECURITY WARNING</p>
                <p class="text-red-600">This dashboard demonstrates multiple security vulnerabilities!</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-red-200 p-4 rounded-lg">
                    <h2 class="text-xl font-semibold mb-4 text-red-800">User Information</h2>
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
                    <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
                </div>

                <div class="bg-red-200 p-4 rounded-lg">
                    <h2 class="text-xl font-semibold mb-4 text-red-800">Sensitive Information</h2>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user_sensitive_data['name']); ?></p>
                    <p><strong>Salary:</strong> <?php echo htmlspecialchars($user_sensitive_data['salary']); ?></p>
                    <p><strong>SSN:</strong> <?php echo htmlspecialchars($user_sensitive_data['ssn']); ?></p>
                    <p><strong>Credit Card:</strong> <?php echo htmlspecialchars($user_sensitive_data['credit_card']); ?></p>
                </div>
            </div>

            <div class="mt-6">
                <a href="vulnerable_login.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Logout
                </a>
            </div>
        </div>
    </div>
</body>
</html>