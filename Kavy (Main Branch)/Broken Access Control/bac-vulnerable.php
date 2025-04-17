<?php
// Vulnerable implementation demonstrating Broken Access Control
session_start();

$username = "";
$password = "";
$message = "";
$logged_in = false;

// Simulated database of users - in a real app, this would be in a database
$users = [
    'admin' => [
        'password' => 'admin123',
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
        'password' => 'password123',
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
        'password' => 'mary2023',
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

// Login Process
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (array_key_exists($username, $users) && $users[$username]['password'] === $password) {
        $logged_in = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $users[$username]['role'];
        $_SESSION['profile_id'] = $users[$username]['profile_id'];
    } else {
        $message = "<div class='text-red-500 mb-4'>
            <p class='font-bold'>Login Failed:</p>
            <p>Invalid username or password.</p>
        </div>";
    }
}

// Logout Process
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ?logged_out=true");
    exit();
}

// BROKEN ACCESS CONTROL #1: User Profile Access by ID (IDOR Vulnerability)
// No verification if the logged-in user has permission to access this profile
$profile_data = null;
if (isset($_GET['profile_id'])) {
    $requested_profile_id = $_GET['profile_id'];
    
    foreach ($users as $user => $details) {
        if ($details['profile_id'] === $requested_profile_id) {
            $profile_data = [
                'username' => $user,
                'email' => $details['email'],
                'role' => $details['role'],
                'salary' => $details['salary']
            ];
            break;
        }
    }
}

// BROKEN ACCESS CONTROL #2: URL Parameter-Based Access Control
// Simply checking the 'role' parameter in URL without verifying actual session role
$admin_panel_access = false;
if (isset($_GET['role']) && $_GET['role'] === 'admin') {
    $admin_panel_access = true;
}

// BROKEN ACCESS CONTROL #3: Document Access without Proper Authorization Check
$document_data = null;
if (isset($_GET['doc_id'])) {
    $requested_doc_id = $_GET['doc_id'];
    
    // No proper validation if the user has rights to access this document
    foreach ($users as $user => $details) {
        foreach ($details['documents'] as $document) {
            if ($document['id'] === $requested_doc_id) {
                $document_data = [
                    'owner' => $user,
                    'name' => $document['name'],
                    'restricted' => $document['restricted'],
                    'content' => "This is the content of " . $document['name']
                ];
                break 2;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable Form - Broken Access Control</title>

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
<body class="bg-[#020617] text-white font-['Lexend'] cursor-[url('/Assets/Images/cursor_01.png'),_auto]">
    <!-- HEADER -->
    <nav class="fixed z-[999] top-0 left-0 h-[10vh] w-screen flex items-center justify-between p-4 bg-[#020617] border-b-2 border-[#3E4B5E] max-md:p-0">
        <div class="headerStuff flex items-center space-x-3 max-md:space-x-1">
            <img src="/Web-Nexus-Project/Assets/Images/logo.svg" alt="logo" class="w-12 max-md:w-8">
            <span class="text-2xl font-bold text-white font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] max-md:text-xs hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Web-Nexus</span>
        </div>

        <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
            <a href="/Web-Nexus-Project/Kavy (Main Branch)/Home/Home-Page.html#vulnerabilities" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="/Web-Nexus-Project/Kavy (Main Branch)/Home/Home-Page.html" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Home</a>
            <a href="/Web-Nexus-Project/Karan/About Us/contact_us.html" class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]  text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
        </div>
        <div class="hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
            <div class="yellowButton yellowButtonHeader hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                <div class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                    <div class="font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] text-black font-thin text-sm max-md:text-[8px]">
                        <a href="/Web-Nexus-Project/Kartavya/Login_Pages/page1_login_register.php">Log In</a>
                    </div>
                    <div class="absolute w-[105%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md  transition-colors duration-500 -z-1 top-[1%] left-0"></div>
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
                    <div class="flex items-center justify-center font-['Press_Start_2P'] text-white font-black text-xl border-2 border-[#3E4B5E] rounded-full w-10 h-10 mr-4">!</div>
                    <h2 class="text-2xl font-['Press_Start_2P'] text-red-500">SecureNexus</h2>
                </div>

                <?php echo $message; ?>

                <?php if (!$logged_in): ?>
                <!-- Login Form -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-white mb-4">Employee Portal Login</h3>
                    <form method="POST" class="space-y-4">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-300 mb-1">Username</label>
                            <input type="text" name="username" id="username" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-yellow-300">
                            <p class="text-xs text-gray-400 mt-1">Try: admin, john, or mary</p>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                            <input type="password" name="password" id="password" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-yellow-300">
                            <p class="text-xs text-gray-400 mt-1">Default passwords: admin123, password123, mary2023</p>
                        </div>
                        <button type="submit" name="login" class="relative bg-blue-500 hover:bg-blue-600 w-full px-4 py-3 rounded-md border-2 border-[rgb(59,130,246)] transition-colors duration-500 group hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                            <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(59,130,246)] text-sm">Login</div>
                            <div class="absolute w-[101%] h-[110%] bg-[rgb(59,130,246)] hover:bg-blue-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                        </button>
                    </form>
                </div>
                <?php endif; ?>

                <?php if ($logged_in): ?>
                <!-- Logged In User Interface -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3>
                    
                    <div class="bg-[#1E293B] rounded-md p-4 mb-6">
                        <h4 class="font-bold text-blue-400 mb-2">Your Profile Information</h4>
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
                                <span class="text-white"><?php echo htmlspecialchars($users[$_SESSION['username']]['salary']); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- BROKEN ACCESS CONTROL #1: IDOR Vulnerability -->
                    <div class="border border-red-500 rounded-md p-4 mb-6">
                        <h4 class="font-bold text-red-400 mb-2">Employee Profile Lookup <span class="text-xs">(VULNERABLE!)</span></h4>
                        <form method="GET" class="space-y-4">
                            <div>
                                <label for="profile_id" class="block text-sm font-medium text-gray-300 mb-1">Profile ID</label>
                                <input type="text" name="profile_id" id="profile_id" placeholder="Enter profile ID (e.g., 1001)" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-yellow-300">
                                <p class="text-xs text-red-400 mt-1">Broken Access Control: Direct object reference with no authorization checks</p>
                            </div>
                            <button type="submit" class="relative bg-red-500 hover:bg-red-600 w-full px-4 py-2 rounded-md border-2 border-[rgb(239,68,68)] transition-colors duration-500 group hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                                <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(239,68,68)] text-xs">View Profile</div>
                                <div class="absolute w-[101%] h-[115%] bg-[rgb(239,68,68)] hover:bg-red-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                            </button>
                        </form>
                    </div>
                    
                    <?php if (isset($profile_data)): ?>
                    <div class="bg-red-900/30 p-4 rounded-md border border-red-500 mb-6">
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
                        <p class="text-xs text-red-400 mt-4">VULNERABILITY: Insecure Direct Object Reference (IDOR) - Any user profile can be accessed by knowing or guessing the profile ID</p>
                    </div>
                    <?php elseif (isset($_GET['profile_id'])): ?>
                    <div class="bg-gray-800 p-4 rounded-md mb-6">
                        <p class="text-gray-300">No profile found with that ID.</p>
                    </div>
                    <?php endif; ?>

                    <!-- BROKEN ACCESS CONTROL #2: Client-Side Access Control -->
                    <?php if ($admin_panel_access || $_SESSION['role'] === 'admin'): ?>
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
                            <?php if ($_SESSION['role'] !== 'admin'): ?>
                            <p class="text-xs text-red-400 mt-2">VULNERABILITY: This user should not have access to the admin panel. Access control is being bypassed through URL parameter manipulation.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="border border-yellow-500 bg-yellow-900/30 rounded-md p-4 mb-6">
                        <h4 class="font-bold text-yellow-400 mb-2">Access Control Bypass Demonstration</h4>
                        <p class="text-gray-300 mb-2">Try accessing the admin panel by adding <span class="font-mono text-yellow-300">?role=admin</span> to the URL, even if you're logged in as a regular user.</p>
                        <a href="?role=admin" class="text-blue-400 hover:text-blue-300 hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Click here to test the vulnerability</a>
                        <p class="text-xs text-yellow-400 mt-2">This demonstrates how client-side access control can be easily bypassed.</p>
                    </div>
                    <?php endif; ?>

                    <!-- BROKEN ACCESS CONTROL #3: Document Access Control -->
                    <div class="border border-red-500 rounded-md p-4 mb-6">
                        <h4 class="font-bold text-red-400 mb-2">Document Access <span class="text-xs">(VULNERABLE!)</span></h4>
                        <p class="text-gray-300 mb-2">Access company documents by ID:</p>
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <a href="?doc_id=doc1" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Company Strategy</a>
                            <a href="?doc_id=doc2" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Financial Report</a>
                            <a href="?doc_id=doc3" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Team Performance</a>
                            <a href="?doc_id=doc4" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Department Budget</a>
                            <a href="?doc_id=doc5" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Personal Review</a>
                            <a href="?doc_id=doc6" class="bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-md text-sm text-center">Training Materials</a>
                        </div>
                        <p class="text-xs text-red-400">Broken Access Control: Document permissions are not verified against current user</p>
                    </div>
                    
                    <?php if (isset($document_data)): ?>
                    <div class="bg-red-900/30 p-4 rounded-md border border-red-500 mb-6">
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
                        <?php if ($document_data['restricted'] && $_SESSION['role'] !== 'admin'): ?>
                        <p class="text-xs text-red-400 mt-4">VULNERABILITY: This is a restricted document that should only be accessible to administrators</p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <div class="mt-6">
                        <a href="?logout=1" class="text-blue-400 hover:text-blue-300 hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Logout</a>
                    </div>
                </div>
                <?php endif; ?>
                <div class="mt-4 text-center">
                    <a href="bac-secure.php" class="text-blue-400 hover:text-blue-300 text-sm hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Try the secure version</a>
                </div>
            </div>

            <!-- RIGHT SIDE: EXPLANATION -->
            <div class="formSection md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-[#3E4B5E] shadow-lg">
                <h3 class="text-xl font-['Press_Start_2P'] text-red-500 mb-6">Broken Access Control Explained</h3>
                
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">What is Broken Access Control?</h4>
                    <p class="text-gray-300 mb-4">Broken Access Control is a security vulnerability that occurs when an application does not properly restrict what authenticated users are allowed to do. This demonstration showcases three common broken access control vulnerabilities:</p>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Vulnerability #1: Insecure Direct Object References (IDOR)</h4>
                    <div class="bg-gray-800 p-4 rounded-md mb-2">
                        <p class="text-gray-300">The profile lookup functionality:</p>
                        <ul class="list-disc pl-5 text-gray-300 space-y-1">
                            <li>Exposes internal object references (profile IDs)</li>
                            <li>No verification if the current user has permission to access</li>
                            <li>Allows access to any profile by changing the ID parameter</li>
                        </ul>
                    </div>
                    <pre class="bg-gray-800 p-4 rounded-md overflow-x-auto mb-2 text-xs">
<code class="language-php">// Vulnerable code
if (isset($_GET['profile_id'])) {
    $requested_profile_id = $_GET['profile_id'];
    
    // No authorization check - just retrieves the profile
    foreach ($users as $user => $details) {
        if ($details['profile_id'] === $requested_profile_id) {
            $profile_data = [...]; // Returns sensitive data
        }
    }
}</code></pre>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Vulnerability #2: Forced Browsing / Client-Side Access Control</h4>
                    <div class="bg-gray-800 p-4 rounded-md mb-2">
                        <p class="text-gray-300">The admin panel access control:</p>
                        <ul class="list-disc pl-5 text-gray-300 space-y-1">
                            <li>Access control based on URL parameters</li>
                            <li>No server-side verification of actual user role</li>
                            <li>Using GET parameters for access control decisions</li>
                        </ul>
                    </div>
                    <pre class="bg-gray-800 p-4 rounded-md overflow-x-auto mb-2 text-xs">
<code class="language-php">// Vulnerable code
if (isset($_GET['role']) && $_GET['role'] === 'admin') {
    $admin_panel_access = true;
    // Grants access based only on URL parameter!
}</code></pre>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Vulnerability #3: Missing Function Level Access Control</h4>
                    <div class="bg-gray-800 p-4 rounded-md mb-2">
                        <p class="text-gray-300">Document access functionality:</p>
                        <ul class="list-disc pl-5 text-gray-300 space-y-1">
                            <li>Document IDs are exposed and guessable</li>
                            <li>No verification of user's authorization level</li>
                            <li>Restricted documents can be accessed by any authenticated user</li>
                        </ul>
                    </div>
                    <pre class="bg-gray-800 p-4 rounded-md overflow-x-auto text-xs">
<code class="language-php">// Vulnerable code
if (isset($_GET['doc_id'])) {
    $requested_doc_id = $_GET['doc_id'];
    
    // No authorization check for restricted documents
    foreach ($users as $user => $details) {
        foreach ($details['documents'] as $document) {
            if ($document['id'] === $requested_doc_id) {
                $document_data = [...]; // Returns the document
                // regardless of restrictions
            }
        }
    }
}</code></pre>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-white mb-2">Secure Implementation Principles</h4>
                    <ul class="list-disc pl-5 text-gray-300 space-y-2">
                        <li><strong>Least Privilege:</strong> Users should only have access to what they need</li>
                        <li><strong>Deny by Default:</strong> Access control should deny by default and only allow explicit permissions</li>
                        <li><strong>Server-Side Validation:</strong> Access control should always be enforced on the server side</li>
                        <li><strong>Role-Based Access Control (RBAC):</strong> Implement proper role-based permissions</li>
                        <li><strong>Session Management:</strong> Validate user sessions and permissions for every resource access</li>
                        <li><strong>Token-Based Authorization:</strong> Use secure tokens with proper scope validation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="bg-gray-950 text-white py-16 mt-16">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-center md:text-left">
            <div>
                <img src="/Web-Nexus-Project/Assets/Images/logo.svg" alt="Web-Nexus Logo" class="w-24 mx-auto md:mx-0">
                <p class="mt-4 text-gray-400">Learn security the hands-on-way.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Company</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact_us.html" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">About Us</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact_us.html" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact_us.html" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">FAQs</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Follow Us</h3>
                <div class="mt-4 flex justify-center md:justify-start space-x-4">
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Web-Nexus-Project/Assets/Images/github.png" alt="Github" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Web-Nexus-Project/Assets/Images/LinkedIn.jpg" alt="Linkedin" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Web-Nexus-Project/Assets/Images/twitter.jpg" alt="Twitter" class="w-8">
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
    <script src="/Web-Nexus-Project/Malay/Animations/DeserialisationAnimation/vulnerable_deserialisation_animation.js"></script>

</body>
</html>