<?php
session_start();

// Implement strict authentication checks
function is_authenticated() {
    return isset($_SESSION['user_id']) && 
           isset($_SESSION['role']) && 
           isset($_SESSION['username']) && 
           isset($_SESSION['csrf_token']);
}

// Secure database with strict access controls
$sensitive_data = [
    1234 => [
        'name' => 'John Doe',
        'salary' => '$85,000',
        'role_access' => ['user']
    ],
    9999 => [
        'name' => 'Admin User',
        'salary' => '$150,000',
        'role_access' => ['admin']
    ]
];

// Robust authentication and authorization
if (!is_authenticated()) {
    header("Location: secure_login.php");
    exit();
}

// Additional authorization check
$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['role'];

if (!isset($sensitive_data[$user_id]) || 
    !in_array($user_role, $sensitive_data[$user_id]['role_access'])) {
    // Unauthorized access attempt
    session_destroy();
    header("Location: secure_login.php");
    exit();
}

$user_data = $sensitive_data[$user_id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen">
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-6 text-green-600">
                Secure User Dashboard
            </h1>
            
            <div class="bg-green-100 border-l-4 border-green-500 p-4 mb-6" role="alert">
                <p class="font-bold text-green-700">SECURITY BEST PRACTICES</p>
                <p class="text-green-600">This dashboard demonstrates robust security mechanisms!</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-green-200 p-4 rounded-lg">
                    <h2 class="text-xl font-semibold mb-4 text-green-800">User Information</h2>
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <p><strong>Role:</strong> <?php echo htmlspecialchars($user_role); ?></p>
                </div>

                <div class="bg-green-200 p-4 rounded-lg">
                    <h2 class="text-xl font-semibold mb-4 text-green-800">Authorized Information</h2>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user_data['name']); ?></p>
                    <p><strong>Salary:</strong> <?php echo htmlspecialchars($user_data['salary']); ?></p>
                </div>
            </div>

            <div class="mt-6">
                <a href="secure_logout.php" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Logout
                </a>
            </div>
        </div>
    </div>
</body>
</html>