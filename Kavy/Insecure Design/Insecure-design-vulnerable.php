<?php
// Vulnerable implementation demonstrating Insecure Design
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /Web-Nexus-Project/Kartavya/Login_Pages/login_page.php");
    exit;
}

$username = "";
$password = "";
$reset_email = "";
$message = "";
$logged_in = false;
$reset_requested = false;
$reset_success = false;

// Simulated database of users - in a real app, this would be in a database
$users = [
    'admin' => [
        'password' => 'admin123',
        'email' => 'admin@example.com',
        'role' => 'admin',
        'account_number' => 'A-12345',
        'balance' => '$10,200'
    ],
    'john' => [
        'password' => 'password123',
        'email' => 'john@example.com',
        'role' => 'user',
        'account_number' => 'U-54321',
        'balance' => '$1,500'
    ],
    'mary' => [
        'password' => 'mary2023',
        'email' => 'mary@example.com',
        'role' => 'user',
        'account_number' => 'U-67890',
        'balance' => '$2,750'
    ]
];

// INSECURE DESIGN #1: Password reset based only on username (no verification)
if (isset($_POST['reset_password'])) {
    $reset_username = $_POST['reset_username'];
    
    if (array_key_exists($reset_username, $users)) {
        $reset_email = $users[$reset_username]['email'];
        $new_password = 'reset' . rand(1000, 9999); // Weak password generation
        $users[$reset_username]['password'] = $new_password; // Password changed instantly
        
        $reset_success = true;
        $message = "<div class='text-green-500 mb-4'>
            <p class='font-bold'>Password Reset Success!</p>
            <p>New password for user '$reset_username': <span class='font-mono bg-gray-800 px-2 py-1 rounded text-yellow-300'>$new_password</span></p>
            <p class='text-xs mt-1'>Email sent to: $reset_email</p>
            <p class='text-xs mt-1 text-red-400'><strong>INSECURE DESIGN:</strong> Password reset without proper verification</p>
        </div>";
    } else {
        $message = "<div class='text-red-500 mb-4'>
            <p class='font-bold'>Error:</p>
            <p>Username not found.</p>
        </div>";
    }
    
    $reset_requested = true;
}

// INSECURE DESIGN #2: Predictable account numbers and lack of access controls
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (array_key_exists($username, $users) && $users[$username]['password'] === $password) {
        $logged_in = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $users[$username]['role'];
    } else {
        $message = "<div class='text-red-500 mb-4'>
            <p class='font-bold'>Login Failed:</p>
            <p>Invalid username or password.</p>
        </div>";
    }
}

// INSECURE DESIGN #3: Account information accessible by simple account number guessing
if (isset($_GET['account'])) {
    $account_number = $_GET['account'];
    $account_found = false;
    
    foreach ($users as $user => $details) {
        if ($details['account_number'] === $account_number) {
            $account_found = true;
            $account_data = [
                'username' => $user,
                'email' => $details['email'],
                'role' => $details['role'],
                'balance' => $details['balance']
            ];
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable Form - Insecure Design</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/night-owl.min.css">
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
            <a href="/Web-Nexus-Project/Kavy/Home/Home-Page.php#vulnerabilities" class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="/Web-Nexus-Project/Kavy/Home/Home-Page.php" class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Home</a>
            <a href="/Web-Nexus-Project/Karan/About Us/contact us.php" class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
        </div>

        <div class="hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
            <div onclick="window.location.href='Insecure-design.php'" class="yellowButton yellowButtonHeader hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                <div class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                    <div class="font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] text-black font-thin text-sm max-md:text-[8px]">
                        <a href="/Web-Nexus-Project/Kavy/Insecure Design/Insecure-design.php">Back to Vulnerability</a>
                    </div>
                    <div class="absolute w-[105%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md transition-colors duration-500 -z-1 top-[1%] left-0"></div>
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
                    <h2 class="text-2xl font-['Press_Start_2P'] text-red-500">BankNexus</h2>
                </div>

                <?php echo $message; ?>

                <?php if (!$logged_in && !$reset_requested): ?>
                <!-- Login Form -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-white mb-4">Login to Your Account</h3>
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

                <!-- Password Reset Form -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-4">Forgot Password?</h3>
                    <form method="POST" class="space-y-4">
                        <div>
                            <label for="reset_username" class="block text-sm font-medium text-gray-300 mb-1">Username</label>
                            <input type="text" name="reset_username" id="reset_username" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-yellow-300">
                            <p class="text-xs text-gray-400 mt-1">Enter your username to reset password</p>
                        </div>
                        <button type="submit" name="reset_password" class="relative bg-red-500 hover:bg-red-600 w-full px-4 py-3 rounded-md border-2 border-[rgb(239,68,68)] transition-colors duration-500 group hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                            <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(239,68,68)] text-sm">Reset Password</div>
                            <div class="absolute w-[101%] h-[110%] bg-[rgb(239,68,68)] hover:bg-red-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                        </button>
                    </form>
                </div>
                <?php endif; ?>

                <?php if ($reset_success): ?>
                <!-- Password Reset Success -->
                <div class="mt-6">
                    <a href="?reset=0" class="text-blue-400 hover:text-blue-300 hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">← Back to login</a>
                </div>
                <?php endif; ?>

                <?php if ($logged_in): ?>
                <!-- Logged In User Interface -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3>
                    
                    <div class="bg-[#1E293B] rounded-md p-4 mb-6">
                        <h4 class="font-bold text-blue-400 mb-2">Your Account Information</h4>
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
                                <span class="text-gray-400">Account Number:</span>
                                <span class="text-white"><?php echo htmlspecialchars($users[$_SESSION['username']]['account_number']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Balance:</span>
                                <span class="text-white"><?php echo htmlspecialchars($users[$_SESSION['username']]['balance']); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- INSECURE DESIGN #3: Direct Account Access Form -->
                    <div class="border border-red-500 rounded-md p-4 mb-6">
                        <h4 class="font-bold text-red-400 mb-2">Quick Account Lookup <span class="text-xs">(INSECURE!)</span></h4>
                        <form method="GET" class="space-y-4">
                            <div>
                                <label for="account" class="block text-sm font-medium text-gray-300 mb-1">Account Number</label>
                                <input type="text" name="account" id="account" placeholder="Enter account number (e.g., A-12345)" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-yellow-300">
                                <p class="text-xs text-red-400 mt-1">Insecure Design: Direct account access with no authorization checks</p>
                            </div>
                            <button type="submit" class="relative bg-red-500 hover:bg-red-600 w-full px-4 py-2 rounded-md border-2 border-[rgb(239,68,68)] transition-colors duration-500 group hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                                <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(239,68,68)] text-xs">Lookup Account</div>
                                <div class="absolute w-[101%] h-[115%] bg-[rgb(239,68,68)] hover:bg-red-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                            </button>
                        </form>
                    </div>
                    
                    <?php if (isset($account_data)): ?>
                    <div class="bg-red-900/30 p-4 rounded-md border border-red-500">
                        <h4 class="font-bold text-white mb-2">Account Lookup Result</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Username:</span>
                                <span class="text-white"><?php echo htmlspecialchars($account_data['username']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Email:</span>
                                <span class="text-white"><?php echo htmlspecialchars($account_data['email']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Role:</span>
                                <span class="text-white"><?php echo htmlspecialchars($account_data['role']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Balance:</span>
                                <span class="text-white"><?php echo htmlspecialchars($account_data['balance']); ?></span>
                            </div>
                        </div>
                        <p class="text-xs text-red-400 mt-4">VULNERABILITY: Any account information can be accessed by simply knowing or guessing the account number pattern</p>
                    </div>
                    <?php elseif (isset($_GET['account'])): ?>
                    <div class="bg-gray-800 p-4 rounded-md">
                        <p class="text-gray-300">No account found with that number.</p>
                    </div>
                    <?php endif; ?>

                    <div class="mt-6">
                        <a href="?logout=1" class="text-blue-400 hover:text-blue-300 hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Logout</a>
                    </div>
                </div>
                <?php endif; ?>
                <div class="mt-4 text-center">
                    <a href="Insecure-design-secure.php" class="text-blue-400 hover:text-blue-300 text-sm hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Try the secure version</a>
                </div>
            </div>

            <!-- RIGHT SIDE: EXPLANATION -->
            <div class="formSection md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-[#3E4B5E] shadow-lg">
                <h3 class="text-xl font-['Press_Start_2P'] text-red-500 mb-6">Insecure Design Explained</h3>
                
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">What is Insecure Design?</h4>
                    <p class="text-gray-300 mb-4">Insecure Design refers to flaws in the application's architecture and logic that create security vulnerabilities, regardless of how perfectly the code is implemented. This demonstration shows three common insecure design patterns:</p>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Vulnerability #1: Weak Password Reset</h4>
                    <div class="bg-gray-800 p-4 rounded-md mb-2">
                        <p class="text-gray-300">The password reset functionality:</p>
                        <ul class="list-disc pl-5 text-gray-300 space-y-1">
                            <li>Only requires knowing the username</li>
                            <li>No email verification or secondary authentication</li>
                            <li>Password is reset immediately</li>
                            <li>Uses weak password generation</li>
                        </ul>
                    </div>
                    <pre class="bg-gray-800 p-4 rounded-md overflow-x-auto mb-2 text-xs">
<code class="language-php">// Vulnerable code
if (array_key_exists($reset_username, $users)) {
    $new_password = 'reset' . rand(1000, 9999);
    $users[$reset_username]['password'] = $new_password;
    // Password changed instantly with no verification
}</code></pre>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Vulnerability #2: Predictable Resource Locations</h4>
                    <div class="bg-gray-800 p-4 rounded-md mb-2">
                        <p class="text-gray-300">Account numbers follow a predictable pattern:</p>
                        <ul class="list-disc pl-5 text-gray-300 space-y-1">
                            <li>Admin accounts: <span class="font-mono text-yellow-300">A-XXXXX</span></li>
                            <li>User accounts: <span class="font-mono text-yellow-300">U-XXXXX</span></li>
                            <li>Sequential or easily guessable numbering</li>
                        </ul>
                        <p class="text-gray-300 mt-2">This allows attackers to predict valid account numbers and use them in exploitation.</p>
                    </div>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Vulnerability #3: Missing Access Controls</h4>
                    <div class="bg-gray-800 p-4 rounded-md mb-2">
                        <p class="text-gray-300">The account lookup functionality:</p>
                        <ul class="list-disc pl-5 text-gray-300 space-y-1">
                            <li>No verification if the user has permission to access the account</li>
                            <li>Direct access to any account by knowing its number</li>
                            <li>No audit logging of access attempts</li>
                        </ul>
                    </div>
                    <pre class="bg-gray-800 p-4 rounded-md overflow-x-auto text-xs">
<code class="language-php">// Vulnerable code - no access control checks
if (isset($_GET['account'])) {
    $account_number = $_GET['account'];
    // Directly fetches any account with no authorization checks
    foreach ($users as $user => $details) {
        if ($details['account_number'] === $account_number) {
            // Returns ALL account data
        }
    }
}</code></pre>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-white mb-2">Secure Design Principles</h4>
                    <ul class="list-disc pl-5 text-gray-300 space-y-2">
                        <li><strong>Defense in Depth:</strong> Multiple layers of security controls</li>
                        <li><strong>Least Privilege:</strong> Only grant necessary permissions</li>
                        <li><strong>Complete Mediation:</strong> Verify authorization for every access</li>
                        <li><strong>Secure by Default:</strong> Systems should be secure in their initial state</li>
                        <li><strong>Security by Design:</strong> Consider security requirements from the start</li>
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
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact_us.php" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">About Us</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact_us.php" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact_us.php" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/gsap.min.js" integrity="sha512-f6bQMg6nkSRw/xfHw5BCbISe/dJjXrVGfz9BSDwhZtiErHwk7ifbmBEtF9vFW8UNIQPhV2uEFVyI/UHob9r7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/ScrollTrigger.min.js" integrity="sha512-AcqPGqrrAEtEwe+ADO5R8RbdFi7tuU7b/A2cJJH0Im0D18NRk5p5s4B3E5PMuO81KFw0ClN7J5SHVUJz7KOb0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/Web-Nexus-Project/Malay/Animations/DeserialisationAnimation/vulnerable_deserialisation_animation.js"></script>

</body>
</html>