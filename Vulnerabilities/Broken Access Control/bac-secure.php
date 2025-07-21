<?php
// Secure implementation fixing Broken Access Control vulnerabilities
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../../Login_Pages/login_page.php");
    exit;
}

$username = "";
$password = "";
$message = "";
$logged_in = false;

// Simulated database of users - in a real app, this would be in a database
$users = [
    'admin' => [
        'password' => password_hash('admin123', PASSWORD_DEFAULT), // Hashed passwords
        'email' => 'admin@example.com',
        'role' => 'admin',
        'profile_id' => '1001',
        'salary' => '$120,000',
        'documents' => [
            ['id' => 'doc1', 'name' => 'Company Strategy.pdf', 'restricted' => true],
            ['id' => 'doc2', 'name' => 'Financial Report Q1.pdf', 'restricted' => true]
        ]
    ],
    'john' => [
        'password' => password_hash('password123', PASSWORD_DEFAULT),
        'email' => 'john@example.com',
        'role' => 'manager',
        'profile_id' => '2001',
        'salary' => '$85,000',
        'documents' => [
            ['id' => 'doc3', 'name' => 'Team Performance.pdf', 'restricted' => false],
            ['id' => 'doc4', 'name' => 'Department Budget.pdf', 'restricted' => false]
        ]
    ],
    'mary' => [
        'password' => password_hash('mary2023', PASSWORD_DEFAULT),
        'email' => 'mary@example.com',
        'role' => 'employee',
        'profile_id' => '3001',
        'salary' => '$65,000',
        'documents' => [
            ['id' => 'doc5', 'name' => 'Personal Review.pdf', 'restricted' => false],
            ['id' => 'doc6', 'name' => 'Training Materials.pdf', 'restricted' => false]
        ]
    ]
];

// Role-based permissions matrix
$permissions = [
    'admin' => ['view_all_profiles', 'access_admin_panel', 'view_restricted_docs', 'manage_users'],
    'manager' => ['view_team_profiles', 'view_department_docs'],
    'employee' => ['view_own_profile', 'view_public_docs']
];

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['username']) && isset($_SESSION['role']);
}

// Secure authorization check function
function hasPermission($requiredPermission) {
    global $permissions;
    
    if (!isLoggedIn()) {
        return false;
    }
    
    $userRole = $_SESSION['role'];
    return in_array($requiredPermission, $permissions[$userRole]);
}

// Secure function to get user data by username
function getUserData($username) {
    global $users;
    
    if (array_key_exists($username, $users)) {
        return $users[$username];
    }
    
    return null;
}

// Login Process with secure password verification
if (isset($_POST['login'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    
    if (array_key_exists($username, $users) && password_verify($password, $users[$username]['password'])) {
        $logged_in = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $users[$username]['role'];
        $_SESSION['profile_id'] = $users[$username]['profile_id'];
        
        // Set anti-CSRF token
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        
        // Set session timeout (30 minutes)
        $_SESSION['last_activity'] = time();
        
        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);
    } else {
        $message = "<div class='text-red-500 mb-4'>
            <p class='font-bold'>Login Failed:</p>
            <p>Invalid username or password.</p>
        </div>";
    }
}

// Session timeout check (30 minutes)
if (isLoggedIn() && isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > 1800) {
    session_unset();
    session_destroy();
    header("Location: ?session_expired=true");
    exit();
} elseif (isLoggedIn()) {
    $_SESSION['last_activity'] = time(); // Update last activity time
}

// Logout Process
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ?logged_out=true");
    exit();
}

// SECURE IMPLEMENTATION #1: User Profile Access with proper authorization
$profile_data = null;
if (isLoggedIn() && isset($_GET['profile_id']) && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $requested_profile_id = filter_input(INPUT_GET, 'profile_id', FILTER_SANITIZE_STRING);
    
    // Authorization check based on role
    $allowed_to_view = false;
    
    // Admin can view all profiles
    if (hasPermission('view_all_profiles')) {
        $allowed_to_view = true;
    } 
    // Managers can view their own profile and team members' profiles
    elseif (hasPermission('view_team_profiles')) {
        // In a real app, check if requested profile belongs to their team
        // For demo, we'll assume john can see mary's profile as part of team
        $allowed_team_members = ['2001', '3001']; // john and mary
        $allowed_to_view = in_array($requested_profile_id, $allowed_team_members);
    }
    // Employees can only view their own profile
    elseif (hasPermission('view_own_profile')) {
        $allowed_to_view = ($_SESSION['profile_id'] === $requested_profile_id);
    }
    
    if ($allowed_to_view) {
        foreach ($users as $user => $details) {
            if ($details['profile_id'] === $requested_profile_id) {
                $profile_data = [
                    'username' => $user,
                    'email' => $details['email'],
                    'role' => $details['role'],
                    'salary' => hasPermission('view_all_profiles') ? $details['salary'] : 'Restricted'
                ];
                break;
            }
        }
    } else {
        $message = "<div class='text-red-500 mb-4'>
            <p class='font-bold'>Access Denied:</p>
            <p>You don't have permission to view this profile.</p>
        </div>";
    }
}

// SECURE IMPLEMENTATION #2: Server-side role-based access control
$admin_panel_access = false;
if (isLoggedIn() && hasPermission('access_admin_panel')) {
    $admin_panel_access = true;
}

// SECURE IMPLEMENTATION #3: Document Access with proper authorization
$document_data = null;
if (isLoggedIn() && isset($_GET['doc_id'])) {
    $requested_doc_id = filter_input(INPUT_GET, 'doc_id', FILTER_SANITIZE_STRING);
    
    // Find document and check permissions
    $document_found = false;
    $doc_is_restricted = false;
    $doc_owner = '';
    $doc_name = '';
    
    foreach ($users as $user => $details) {
        foreach ($details['documents'] as $document) {
            if ($document['id'] === $requested_doc_id) {
                $document_found = true;
                $doc_is_restricted = $document['restricted'];
                $doc_owner = $user;
                $doc_name = $document['name'];
                break 2;
            }
        }
    }
    
    // Authorization logic
    $allowed_to_access = false;
    
    if ($document_found) {
        // Admin can access all documents
        if (hasPermission('view_restricted_docs')) {
            $allowed_to_access = true;
        }
        // Non-admins can access their own documents
        elseif ($doc_owner === $_SESSION['username']) {
            $allowed_to_access = true;
        }
        // Non-admins can access non-restricted documents
        elseif (!$doc_is_restricted && hasPermission('view_public_docs')) {
            $allowed_to_access = true;
        }
        
        if ($allowed_to_access) {
            $document_data = [
                'owner' => $doc_owner,
                'name' => $doc_name,
                'restricted' => $doc_is_restricted,
                'content' => "This is the content of " . $doc_name
            ];
        } else {
            $message = "<div class='text-red-500 mb-4'>
                <p class='font-bold'>Access Denied:</p>
                <p>You don't have permission to access this document.</p>
            </div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Form - Access Control</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Highlight.js CSS for syntax highlighting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/night-owl.min.css">

    <!-- Highlight.js script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            hljs.highlightAll();
        });
    </script>
</head>
<body class="bg-[#020617] text-white font-['Lexend'] cursor-[url('../../Assets/Images/cursor_01.png'),_auto]">
    <!-- HEADER -->
    <nav class="fixed z-[999] top-0 left-0 h-[10vh] w-screen flex items-center justify-between p-4 bg-[#020617] border-b-2 border-[#3E4B5E] max-md:p-0">
        <div class="headerStuff flex items-center space-x-3 max-md:space-x-1">
            <img src="../../Assets/Images/logo.svg" alt="logo" class="w-12 max-md:w-8">
            <span class="text-2xl font-bold text-white font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] max-md:text-xs hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer]">Web-Nexus</span>
        </div>

        <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
            <a href="../../index.php#vulnerabilities" class="headerStuff hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="../../index.php" class="headerStuff hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Home</a>
            <a href="../../About Us/contact us.php" class="headerStuff hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
        </div>

        <div class="hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
            <div onclick="window.location.href='Broken-access-control.php'" class="yellowButton yellowButtonHeader hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer]">
                <div class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                    <div class="font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] text-black font-thin text-sm max-md:text-[8px]">
                        <a href="../../Vulnerabilities/Broken Access Control/Broken-access-control.php">Back to Vulnerability</a>
                    </div>
                    <div class="absolute w-[102%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md transition-colors duration-500 -z-1 top-[1%] left-0"></div>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="pt-[15vh] pb-10 px-4 flex flex-col items-center justify-start min-h-screen">
        <div class="w-full max-w-7xl flex flex-col md:flex-row gap-8">
            <!-- LEFT SIDE: FORMS -->
            <div class="formSection md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-[#3E4B5E] shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="flex items-center justify-center font-['Press_Start_2P'] text-white font-black text-xl border-2 border-[#3E4B5E] rounded-full w-10 h-10 mr-4">✓</div>
                    <h2 class="text-2xl font-['Press_Start_2P'] text-green-500">SecureNexus</h2>
                </div>

                <?php echo $message; ?>

                <?php if (isset($_GET['session_expired'])): ?>
                <div class="bg-yellow-900/30 p-4 rounded-md border border-yellow-500 mb-4">
                    <p class="text-yellow-400">Your session has expired due to inactivity. Please log in again.</p>
                </div>
                <?php endif; ?>

                <?php if (!isLoggedIn()): ?>
                <!-- Login Form -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-white mb-4">Employee Portal Login</h3>
                    <form method="POST" class="space-y-4">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-300 mb-1">Username</label>
                            <input type="text" name="username" id="username" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-300">
                            <p class="text-xs text-gray-400 mt-1">Try: admin, john, or mary</p>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                            <input type="password" name="password" id="password" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-300">
                            <p class="text-xs text-gray-400 mt-1">Default passwords: admin123, password123, mary2023</p>
                        </div>
                        <button type="submit" name="login" class="relative bg-green-500 hover:bg-green-600 w-full px-4 py-3 rounded-md border-2 border-[rgb(34,197,94)] transition-colors duration-500 group hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer]">
                            <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(34,197,94)] text-sm">Login</div>
                            <div class="absolute w-[101%] h-[110%] bg-[rgb(34,197,94)] hover:bg-green-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                        </button>
                    </form>
                </div>
                <?php endif; ?>

                <?php if (isLoggedIn()): ?>
                <!-- Logged In User Interface -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3>
                    
                    <div class="bg-[#1E293B] rounded-md p-4 mb-6">
                        <h4 class="font-bold text-green-400 mb-2">Your Profile Information</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Username:</span>
                                <span class="text-white"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Role:</span>
                                <span class="text-white"><?php echo htmlspecialchars($_SESSION['role']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Profile ID:</span>
                                <span class="text-white"><?php echo htmlspecialchars($_SESSION['profile_id']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Salary:</span>
                                <span class="text-white"><?php echo htmlspecialchars(getUserData($_SESSION['username'])['salary']); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- SECURE IMPLEMENTATION #1: Profile Access with Authorization -->
                    <div class="border border-green-500 rounded-md p-4 mb-6">
                        <h4 class="font-bold text-green-400 mb-2">Employee Profile Lookup <span class="text-xs">(SECURE)</span></h4>
                        <form method="POST" class="space-y-4">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                            <div>
                                <label for="profile_id" class="block text-sm font-medium text-gray-300 mb-1">Profile ID</label>
                                <input type="text" name="profile_id" id="profile_id" placeholder="Enter profile ID (e.g., 1001)" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-300">
                                <p class="text-xs text-green-400 mt-1">Secure Access Control: Proper role-based authorization checks</p>
                            </div>
                            <button type="submit" formmethod="GET" class="relative bg-green-500 hover:bg-green-600 w-full px-4 py-2 rounded-md border-2 border-[rgb(34,197,94)] transition-colors duration-500 group hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer]">
                                <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(34,197,94)] text-xs">View Profile</div>
                                <div class="absolute w-[101%] h-[115%] bg-[rgb(34,197,94)] hover:bg-green-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                            </button>
                        </form>
                    </div>
                    
                    <?php if (isset($profile_data)): ?>
                    <div class="bg-green-900/30 p-4 rounded-md border border-green-500 mb-6">
                        <h4 class="font-bold text-white mb-2">Profile Lookup Result</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Username:</span>
                                <span class="text-white"><?php echo htmlspecialchars($profile_data['username']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Email:</span>
                                <span class="text-white"><?php echo htmlspecialchars($profile_data['email']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Role:</span>
                                <span class="text-white"><?php echo htmlspecialchars($profile_data['role']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Salary:</span>
                                <span class="text-white"><?php echo htmlspecialchars($profile_data['salary']); ?></span>
                            </div>
                        </div>
                        <p class="text-xs text-green-400 mt-4">SECURE: Access to this profile was granted based on your role permissions</p>
                    </div>
                    <?php endif; ?>

                    <!-- SECURE IMPLEMENTATION #2: Server-Side Access Control -->
                    <?php if ($admin_panel_access): ?>
                    <div class="bg-purple-900/30 p-4 rounded-md border border-purple-500 mb-6">
                        <h4 class="font-bold text-white mb-2">Admin Panel <span class="text-xs">(RESTRICTED AREA)</span></h4>
                        <div class="space-y-4">
                            <p class="text-gray-300">This is the admin control panel. Here you can manage users and system settings.</p>
                            <div class="grid grid-cols-2 gap-2">
                                <button class="bg-purple-700 py-2 px-4 rounded-md text-sm">Manage Users</button>
                                <button class="bg-purple-700 py-2 px-4 rounded-md text-sm">System Settings</button>
                                <button class="bg-purple-700 py-2 px-4 rounded-md text-sm">Database Control</button>
                                <button class="bg-purple-700 py-2 px-4 rounded-md text-sm">Export Data</button>
                            </div>
                            <p class="text-xs text-green-400 mt-2">SECURE: Access control based on server-side session verification</p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- SECURE IMPLEMENTATION #3: Document Access Control -->
                    <div class="border border-green-500 rounded-md p-4 mb-6">
                        <h4 class="font-bold text-green-400 mb-2">Document Access <span class="text-xs">(SECURE)</span></h4>
                        <p class="text-gray-300 mb-2">Access company documents:</p>
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <?php
                            // Only show document links appropriate for the user's role
                            if (hasPermission('view_restricted_docs')) {
                                // Admin can see all documents
                                echo '<a href="?doc_id=doc1" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Company Strategy</a>';
                                echo '<a href="?doc_id=doc2" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Financial Report</a>';
                                echo '<a href="?doc_id=doc3" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Team Performance</a>';
                                echo '<a href="?doc_id=doc4" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Department Budget</a>';
                                echo '<a href="?doc_id=doc5" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Personal Review</a>';
                                echo '<a href="?doc_id=doc6" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Training Materials</a>';
                            } elseif ($_SESSION['role'] === 'manager') {
                                // Manager can see team documents and non-restricted documents
                                echo '<a href="?doc_id=doc3" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Team Performance</a>';
                                echo '<a href="?doc_id=doc4" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Department Budget</a>';
                                echo '<a href="?doc_id=doc6" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Training Materials</a>';
                            } else {
                                // Employee can only see their documents and public ones
                                echo '<a href="?doc_id=doc5" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Personal Review</a>';
                                echo '<a href="?doc_id=doc6" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Training Materials</a>';
                            }
                            ?>
                        </div>
                        <p class="text-xs text-green-400">Secure: Document access control based on user role and document restrictions</p>
                    </div>
                    
                    <?php if (isset($document_data)): ?>
                    <div class="bg-green-900/30 p-4 rounded-md border border-green-500 mb-6">
                        <h4 class="font-bold text-white mb-2">Document: <?php echo htmlspecialchars($document_data['name']); ?></h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Owner:</span>
                                <span class="text-white"><?php echo htmlspecialchars($document_data['owner']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Restricted:</span>
                                <span class="text-white"><?php echo $document_data['restricted'] ? 'Yes' : 'No'; ?></span>
                            </div>
                            <div class="border-t border-gray-700 my-3 pt-3">
                                <p class="text-gray-300"><?php echo htmlspecialchars($document_data['content']); ?></p>
                            </div>
                        </div>
                        <p class="text-xs text-green-400 mt-4">SECURE: Access to this document was granted based on your role permissions</p>
                    </div>
                    <?php endif; ?>

                    <div class="mt-6">
                        <a href="?logout=1" class="text-blue-400 hover:text-blue-300 hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer]">Logout</a>
                    </div>
                </div>
                <?php endif; ?>
                <div class="mt-4 text-center">
                    <a href="bac-vulnerable.php" class="text-blue-400 hover:text-blue-300 text-sm hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer]">Try the vulnerable version</a>
                </div>
            </div>

            <!-- RIGHT SIDE: EXPLANATION -->
            <div class="formSection md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-[#3E4B5E] shadow-lg">
                <h3 class="text-xl font-['Press_Start_2P'] text-green-500 mb-6">Secure Access Control Implementation</h3>
                
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Principles of Secure Access Control</h4>
                    <p class="text-gray-300 mb-4">This secure implementation addresses Broken Access Control vulnerabilities by implementing:</p>
                    <ul class="list-disc pl-5 text-gray-300 space-y-1 mb-4">
                        <li>Role-based access control (RBAC)</li>
                        <li>Authorization checks for every protected resource</li>
                        <li>Server-side validation of user permissions</li>
                        <li>Protection against IDOR vulnerabilities</li>
                        <li>Anti-CSRF tokens to prevent request forgery</li>
                        <li>Secure session management</li>
                    </ul>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Security Improvement #1: Permission-Based Access</h4>
                    <div class="bg-gray-800 p-4 rounded-md mb-2">
                        <p class="text-gray-300">The profile lookup functionality now:</p>
                        <ul class="list-disc pl-5 text-gray-300 space-y-1">
                            <li>Implements role-based permission checks</li>
                            <li>Verifies user authorization server-side before allowing access</li>
                            <li>Uses CSRF tokens to prevent cross-site request forgery</li>
                            <li>Properly restricts visibility of sensitive data like salary</li>
                        </ul>
                    </div>
                    <pre><code class="language-php">// Authorization check based on role
$allowed_to_view = false;
    
// Admin can view all profiles
if (hasPermission('view_all_profiles')) {
    $allowed_to_view = true;
} 
// Managers can view their own profile and team members' profiles
elseif (hasPermission('view_team_profiles')) {
    $allowed_team_members = ['2001', '3001']; // john and mary
    $allowed_to_view = in_array($requested_profile_id, $allowed_team_members);
}
// Employees can only view their own profile
elseif (hasPermission('view_own_profile')) {
    $allowed_to_view = ($_SESSION['profile_id'] === $requested_profile_id);
}</code></pre>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Security Improvement #2: Server-Side Role Verification</h4>
                    <div class="bg-gray-800 p-4 rounded-md mb-2">
                        <p class="text-gray-300">Admin panel access is controlled by:</p>
                        <ul class="list-disc pl-5 text-gray-300 space-y-1">
                            <li>Server-side permission validation</li>
                            <li>Function-based access control checks</li>
                            <li>Avoiding client-side only restrictions</li>
                        </ul>
                    </div>
                    <pre><code class="language-php">// Server-side role-based access control
$admin_panel_access = false;
if (isLoggedIn() && hasPermission('access_admin_panel')) {
    $admin_panel_access = true;
}

// hasPermission function checks session role against defined permissions
function hasPermission($requiredPermission) {
    global $permissions;
    
    if (!isLoggedIn()) {
        return false;
    }
    
    $userRole = $_SESSION['role'];
    return in_array($requiredPermission, $permissions[$userRole]);
}</code></pre>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Security Improvement #3: Document Access Control</h4>
                    <div class="bg-gray-800 p-4 rounded-md mb-2">
                        <p class="text-gray-300">Document access is protected by:</p>
                        <ul class="list-disc pl-5 text-gray-300 space-y-1">
                            <li>Granular document permission model</li>
                            <li>Multi-layered authorization checks</li>
                            <li>Document restriction flags</li>
                            <li>Owner-based access control</li>
                        </ul>
                    </div>
                    <pre><code class="language-php">// Authorization logic for document access
$allowed_to_access = false;

if ($document_found) {
    // Admin can access all documents
    if (hasPermission('view_restricted_docs')) {
        $allowed_to_access = true;
    }
    // Non-admins can access their own documents
    elseif ($doc_owner === $_SESSION['username']) {
        $allowed_to_access = true;
    }
    // Non-admins can access non-restricted documents
    elseif (!$doc_is_restricted && hasPermission('view_public_docs')) {
        $allowed_to_access = true;
    }
}</code></pre>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Additional Security Measures</h4>
                    <div class="bg-gray-800 p-4 rounded-md">
                        <p class="text-gray-300">Other important security features:</p>
                        <ul class="list-disc pl-5 text-gray-300 space-y-1">
                            <li>Session timeout (30 minutes of inactivity)</li>
                            <li>Session regeneration to prevent fixation attacks</li>
                            <li>Input sanitization</li>
                            <li>Password hashing with PASSWORD_DEFAULT</li>
                            <li>Hidden directory structure</li>
                            <li>No direct object references in URLs</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-6">
                    <h4 class="text-lg font-bold text-white mb-2">OWASP Top 10: Broken Access Control</h4>
                    <p class="text-gray-300 mb-2">Access control enforces that users cannot act outside their intended permissions. Failures typically lead to unauthorized disclosure, modification, or destruction of data.</p>
                    <p class="text-gray-300">This implementation follows OWASP best practices by:</p>
                    <ul class="list-disc pl-5 text-gray-300 space-y-1">
                        <li>Denying access by default</li>
                        <li>Implementing access control mechanisms once and reusing them</li>
                        <li>Enforcing record ownership</li>
                        <li>Minimizing CORS usage</li>
                        <li>Invalidating sessions on logout</li>
                        <li>Rate limiting API and controller access</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-950 text-white py-16 mt-16">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-center md:text-left">
            <div>
                <img src="../../Assets/Images/logo.svg" alt="Web-Nexus Logo" class="w-24 mx-auto md:mx-0">
                <p class="mt-4 text-gray-400">Learn security the hands-on-way.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Company</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="../../About Us/contact us.php" class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">About Us</a></li>
                    <li><a href="#" class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#" class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="../../About Us/contact us.php" class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="../../About Us/contact us.php" class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
                    <li><a href="#" class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">FAQs</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Follow Us</h3>
                <div class="mt-4 flex justify-center md:justify-start space-x-4">
                    <a href="#" class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="../../Assets/Images/github.png" alt="Github" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="../../Assets/Images/LinkedIn.jpg" alt="Linkedin" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="../../Assets/Images/twitter.jpg" alt="Twitter" class="w-8">
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-12 text-center text-gray-500">
            &copy; 2025 Web-Nexus. All Rights Reserved.
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/gsap.min.js"
        integrity="sha512-f6bQMg6nkSRw/xfHw5BCbISe/dJjXrVGfz9BSDwhZtiErHwk7ifbmBEtF9vFW8UNIQPhV2uEFVyI/UHob9r7Cw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/ScrollTrigger.min.js"
        integrity="sha512-AcqPGqrrAEtEwe+ADO5R8RbdFi7tuU7b/A2cJJH0Im0D18NRk5p5s4B3E5PMuO81KFw0ClN7J5SHVUJz7KOb0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../../Assets/Animations/DeserialisationAnimation/vulnerable_deserialisation_animation.js"></script>

</body>
</html>