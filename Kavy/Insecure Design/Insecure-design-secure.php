<?php
// Secure implementation addressing Insecure Design vulnerabilities
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
$reset_token_sent = false;

// Simulated database of users - in a real app, this would be in a database
// Passwords are now stored as hashes (using password_hash in a real system)
$users = [
    'admin' => [
        'password_hash' => '$2y$10$HixOZh8ydkhY97OeQlTsJ.e7tZP7sH9JR7vgZpzP5DISciGp8Bpz2', // admin123 hashed
        'email' => 'admin@example.com',
        'role' => 'admin',
        'account_id' => 'a76d8fb5-7c63-4e4e-8cf1-9712a9f3412a', // UUID format
        'balance' => '$10,200',
        'reset_token' => null,
        'reset_token_expiry' => null,
        'failed_login_attempts' => 0,
        'last_failed_attempt' => null,
        'account_locked' => false
    ],
    'john' => [
        'password_hash' => '$2y$10$uN40Oovw8kQxRO.F2BK9HOCHhQxrV2GhV9cKOVNS5fNZrPwgETkgG', // password123 hashed  
        'email' => 'john@example.com',
        'role' => 'user',
        'account_id' => 'b45e7d12-8a31-42cf-9523-f62a142a8e7d', // UUID format
        'balance' => '$1,500',
        'reset_token' => null,
        'reset_token_expiry' => null,
        'failed_login_attempts' => 0,
        'last_failed_attempt' => null,
        'account_locked' => false
    ],
    'mary' => [
        'password_hash' => '$2y$10$JKmB8XjR0rAjp6CZgNIl3.ZtPHn0z9yTZYtxD5Jj4S55aJSPPTzIy', // mary2023 hashed
        'email' => 'mary@example.com',
        'role' => 'user',
        'account_id' => 'c38f9a62-5d17-49c1-b705-089e3dca9c84', // UUID format
        'balance' => '$2,750',
        'reset_token' => null,
        'reset_token_expiry' => null,
        'failed_login_attempts' => 0,
        'last_failed_attempt' => null,
        'account_locked' => false
    ]
];

// Function to log security events
function log_security_event($event_type, $username, $details) {
    // In a real application, this would write to a secure database or log file
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[{$timestamp}] {$event_type}: User: {$username}, Details: {$details}\n";
    // For demonstration, we'll just output it in comments
    // file_put_contents('security_log.txt', $log_entry, FILE_APPEND);
}

// SECURE DESIGN #1: Proper password reset with verification
if (isset($_POST['request_reset'])) {
    $reset_username = $_POST['reset_username'];
    
    if (array_key_exists($reset_username, $users)) {
        // Generate secure random token
        $token = bin2hex(random_bytes(32));
        $expiry = time() + 3600; // 1 hour expiry
        
        // Store token and expiry in user record
        $users[$reset_username]['reset_token'] = $token;
        $users[$reset_username]['reset_token_expiry'] = $expiry;
        
        $reset_email = $users[$reset_username]['email'];
        
        // In a real application, send email with reset link
        // mail($reset_email, "Password Reset Request", "Click here to reset your password: https://example.com/reset.php?token=$token");
        
        $reset_token_sent = true;
        $message = "<div class='text-green-500 mb-4'>
            <p class='font-bold'>Password Reset Email Sent!</p>
            <p>Check your email address: {$reset_email}</p>
            <p class='text-xs mt-1 text-green-400'><strong>SECURE DESIGN:</strong> Reset token sent to verified email address</p>
            <p class='text-xs mt-1'>For demonstration, your token is: {$token}</p>
        </div>";
        
        log_security_event("PASSWORD_RESET_REQUEST", $reset_username, "Reset token generated and sent to email");
    } else {
        // Use consistent messaging to prevent username enumeration
        $reset_token_sent = true;
        $message = "<div class='text-green-500 mb-4'>
            <p class='font-bold'>Password Reset Email Sent!</p>
            <p>If an account with that username exists, a reset link has been sent to the associated email address.</p>
            <p class='text-xs mt-1 text-green-400'><strong>SECURE DESIGN:</strong> Consistent messaging prevents username enumeration</p>
        </div>";
        
        log_security_event("PASSWORD_RESET_ATTEMPT", "unknown", "Reset requested for non-existent username: {$reset_username}");
    }
    
    $reset_requested = true;
}

// Process password reset with token
if (isset($_POST['confirm_reset'])) {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $valid_token = false;
    $token_username = '';
    
    // Validate token
    foreach ($users as $user => $details) {
        if (isset($details['reset_token']) && 
            $details['reset_token'] === $token && 
            $details['reset_token_expiry'] > time()) {
            $valid_token = true;
            $token_username = $user;
            break;
        }
    }
    
    if ($valid_token) {
        // Validate password requirements
        if (strlen($new_password) < 12) {
            $message = "<div class='text-red-500 mb-4'>
                <p class='font-bold'>Error:</p>
                <p>Password must be at least 12 characters long.</p>
            </div>";
        } elseif ($new_password !== $confirm_password) {
            $message = "<div class='text-red-500 mb-4'>
                <p class='font-bold'>Error:</p>
                <p>Passwords do not match.</p>
            </div>";
        } else {
            // Update password with new hash
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $users[$token_username]['password_hash'] = $new_password_hash;
            
            // Invalidate token
            $users[$token_username]['reset_token'] = null;
            $users[$token_username]['reset_token_expiry'] = null;
            
            // Reset failed login attempts
            $users[$token_username]['failed_login_attempts'] = 0;
            $users[$token_username]['account_locked'] = false;
            
            $message = "<div class='text-green-500 mb-4'>
                <p class='font-bold'>Password Reset Successful!</p>
                <p>Your password has been updated. You can now log in with your new password.</p>
                <p class='text-xs mt-1 text-green-400'><strong>SECURE DESIGN:</strong> Secure password reset flow completed</p>
            </div>";
            
            log_security_event("PASSWORD_RESET_COMPLETE", $token_username, "Password successfully reset");
            $reset_requested = false;
        }
    } else {
        $message = "<div class='text-red-500 mb-4'>
            <p class='font-bold'>Error:</p>
            <p>Invalid or expired token. Please request a new password reset.</p>
        </div>";
        
        log_security_event("PASSWORD_RESET_FAILURE", "unknown", "Invalid token attempt: {$token}");
    }
}

// SECURE DESIGN #2: Proper authentication with brute force protection
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $account_locked = false;
    
    // Check if account exists
    if (array_key_exists($username, $users)) {
        // Check if account is locked
        if ($users[$username]['account_locked']) {
            $message = "<div class='text-red-500 mb-4'>
                <p class='font-bold'>Account Locked:</p>
                <p>This account has been temporarily locked due to multiple failed login attempts.</p>
                <p>Please reset your password or try again later.</p>
            </div>";
            
            log_security_event("LOGIN_ATTEMPT_BLOCKED", $username, "Attempt on locked account");
            $account_locked = true;
        } else {
            // Verify password using secure comparison
            if (password_verify($password, $users[$username]['password_hash'])) {
                $logged_in = true;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $users[$username]['role'];
                $_SESSION['account_id'] = $users[$username]['account_id'];
                $_SESSION['last_activity'] = time();
                
                // Reset failed login attempts
                $users[$username]['failed_login_attempts'] = 0;
                
                log_security_event("LOGIN_SUCCESS", $username, "Successful login");
            } else {
                // Increment failed login attempts
                $users[$username]['failed_login_attempts']++;
                $users[$username]['last_failed_attempt'] = time();
                
                // Lock account after 5 failed attempts
                if ($users[$username]['failed_login_attempts'] >= 5) {
                    $users[$username]['account_locked'] = true;
                    $message = "<div class='text-red-500 mb-4'>
                        <p class='font-bold'>Account Locked:</p>
                        <p>This account has been locked due to multiple failed login attempts.</p>
                        <p>Please reset your password to unlock your account.</p>
                    </div>";
                    
                    log_security_event("ACCOUNT_LOCKED", $username, "Account locked after 5 failed attempts");
                } else {
                    $message = "<div class='text-red-500 mb-4'>
                        <p class='font-bold'>Login Failed:</p>
                        <p>Invalid username or password.</p>
                        <p class='text-xs mt-1'>Remaining attempts before lockout: " . (5 - $users[$username]['failed_login_attempts']) . "</p>
                    </div>";
                    
                    log_security_event("LOGIN_FAILURE", $username, "Failed login attempt #{$users[$username]['failed_login_attempts']}");
                }
            }
        }
    } else {
        // Use consistent error message to prevent username enumeration
        $message = "<div class='text-red-500 mb-4'>
            <p class='font-bold'>Login Failed:</p>
            <p>Invalid username or password.</p>
        </div>";
        
        log_security_event("LOGIN_FAILURE", "unknown", "Attempt with non-existent username: {$username}");
    }
}

// SECURE DESIGN #3: Proper access control for account information
if (isset($_GET['view_account']) && !empty($_SESSION['username'])) {
    $account_id = $_GET['view_account'];
    $current_user = $_SESSION['username'];
    $current_role = $_SESSION['role'];
    
    // Find account by ID
    $account_found = false;
    $account_owner = '';
    
    foreach ($users as $user => $details) {
        if ($details['account_id'] === $account_id) {
            $account_found = true;
            $account_owner = $user;
            break;
        }
    }
    
    // Apply proper access control
    if ($account_found) {
        $authorized = false;
        
        // Authorization rules:
        // 1. Users can only view their own accounts
        // 2. Admins can view any account
        if ($current_role === 'admin' || $account_owner === $current_user) {
            $authorized = true;
            $account_data = [
                'username' => $account_owner,
                'email' => $users[$account_owner]['email'],
                'role' => $users[$account_owner]['role'],
                'balance' => $users[$account_owner]['balance']
            ];
            
            log_security_event("ACCOUNT_ACCESS", $current_user, "Authorized access to account: {$account_id}");
        }
        
        if (!$authorized) {
            $message = "<div class='text-red-500 mb-4'>
                <p class='font-bold'>Access Denied:</p>
                <p>You do not have permission to view this account.</p>
                <p class='text-xs mt-1 text-green-400'><strong>SECURE DESIGN:</strong> Proper access control prevents unauthorized account access</p>
            </div>";
            
            log_security_event("UNAUTHORIZED_ACCESS_ATTEMPT", $current_user, "Attempted to access account: {$account_id}");
        }
    } else {
        $message = "<div class='text-red-500 mb-4'>
            <p class='font-bold'>Error:</p>
            <p>Account not found.</p>
        </div>";
    }
}

// Session timeout after 15 minutes of inactivity
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 900)) {
    session_unset();
    session_destroy();
    $logged_in = false;
    $message = "<div class='text-blue-500 mb-4'>
        <p class='font-bold'>Session Expired:</p>
        <p>You have been logged out due to inactivity.</p>
    </div>";
} elseif (isset($_SESSION['username'])) {
    $_SESSION['last_activity'] = time();
    $logged_in = true;
}

// Handle logout
if (isset($_GET['logout'])) {
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'unknown';
    log_security_event("LOGOUT", $username, "User logged out");
    
    session_unset();
    session_destroy();
    $logged_in = false;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Form - Proper Design</title>

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
<body class="bg-[#020617] text-white font-['Lexend'] cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_01.png'),_auto]">
    <!-- HEADER -->
    <nav class="fixed z-[999] top-0 left-0 h-[10vh] w-screen flex items-center justify-between p-4 bg-[#020617] border-b-2 border-[#3E4B5E] max-md:p-0">
        <div class="headerStuff flex items-center space-x-3 max-md:space-x-1">
            <img src="/Web-Nexus-Project/Assets/Images/logo.svg" alt="logo" class="w-12 max-md:w-8">
            <span class="text-2xl font-bold text-white font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] max-md:text-xs hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer]">Web-Nexus</span>
        </div>

        <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
            <a href="/Web-Nexus-Project/Kavy/Home/Home-Page.php#vulnerabilities" class="headerStuff hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="/Web-Nexus-Project/Kavy/Home/Home-Page.php" class="headerStuff hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Home</a>
            <a href="/Web-Nexus-Project/Karan/About Us/contact us.php" class="headerStuff hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
        </div>

        <div class="hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
            <div onclick="window.location.href='Insecure-design.php'" class="yellowButton yellowButtonHeader hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer]">
                <div class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                    <div class="font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] text-black font-thin text-sm max-md:text-[8px]">
                        <a href="/Web-Nexus-Project/Kavy/Insecure Design/Insecure-design.php">Back to Vulnerability</a>
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
                    <h2 class="text-2xl font-['Press_Start_2P'] text-green-500">BankNexus</h2>
                </div>

                <?php echo $message; ?>

                <?php if (!$logged_in && !$reset_requested): ?>
                <!-- Login Form -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-white mb-4">Login to Your Account</h3>
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
                        <button type="submit" name="login" class="relative bg-blue-500 hover:bg-blue-600 w-full px-4 py-3 rounded-md border-2 border-[rgb(59,130,246)] transition-colors duration-500 group hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer]">
                            <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(59,130,246)] text-sm">Login</div>
                            <div class="absolute w-[101%] h-[110%] bg-[rgb(59,130,246)] hover:bg-blue-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                        </button>
                    </form>
                </div>

                <!-- Password Reset Request Form -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-4">Forgot Password?</h3>
                    <form method="POST" class="space-y-4">
                        <div>
                            <label for="reset_username" class="block text-sm font-medium text-gray-300 mb-1">Username</label>
                            <input type="text" name="reset_username" id="reset_username" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-300">
                            <p class="text-xs text-gray-400 mt-1">Enter your username to receive a reset link via email</p>
                        </div>
                        <button type="submit" name="request_reset" class="relative bg-green-500 hover:bg-green-600 w-full px-4 py-3 rounded-md border-2 border-[rgb(34,197,94)] transition-colors duration-500 group hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer]">
                            <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(34,197,94)] text-sm">Request Reset Link</div>
                            <div class="absolute w-[101%] h-[110%] bg-[rgb(34,197,94)] hover:bg-green-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                        </button>
                    </form>
                </div>
                <?php endif; ?>

                <?php if ($reset_token_sent): ?>
                <!-- Password Reset Form with Token -->
                <div class="mt-6">
                    <h3 class="text-lg font-bold text-white mb-4">Reset Your Password</h3>
                    <form method="POST" class="space-y-4">
                        <div>
                            <label for="token" class="block text-sm font-medium text-gray-300 mb-1">Reset Token</label>
                            <input type="text" name="token" id="token" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-300" placeholder="Enter the token from your email">
                        </div>
                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-300 mb-1">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-300" placeholder="Minimum 12 characters">
                            <p class="text-xs text-gray-400 mt-1">Must be at least 12 characters</p>
                        </div>
                        <div>
                            <label for="confirm_password" class="block text-sm font-medium text-gray-300 mb-1">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-300" placeholder="Re-enter your new password">
                        </div>
                        <button type="submit" name="confirm_reset" class="relative bg-green-500 hover:bg-green-600 w-full px-4 py-3 rounded-md border-2 border-[rgb(34,197,94)] transition-colors duration-500 group hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer]">
                            <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(34,197,94)] text-sm">Reset Password</div>
                            <div class="absolute w-[101%] h-[110%] bg-[rgb(34,197,94)] hover:bg-green-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                        </button>
                    </form>
                    
                    <div class="mt-6">
                        <a href="?reset=0" class="text-blue-400 hover:text-blue-300 hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer]">← Back to login</a>
                    </div>
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
                                <span class="text-gray-400">Account ID:</span>
                                <span class="text-white"><?php echo htmlspecialchars($_SESSION['account_id']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Balance:</span>
                                <span class="text-white"><?php echo htmlspecialchars($users[$_SESSION['username']]['balance']); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- SECURE DESIGN #3: Secure Account Lookup Form with Proper Access Controls -->
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                    <div class="border border-green-500 rounded-md p-4 mb-6">
                        <h4 class="font-bold text-green-400 mb-2">Secure Account Lookup <span class="text-xs">(Admin Only)</span></h4>
                        <form method="GET" class="space-y-4">
                            <div>
                                <label for="view_account" class="block text-sm font-medium text-gray-300 mb-1">Account ID</label>
                                <input type="text" name="view_account" id="view_account" placeholder="Enter full account ID" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-300">
                                <p class="text-xs text-green-400 mt-1">Secure Design: Access control checks enforce authorization</p>
                            </div>
                            <button type="submit" class="relative bg-green-500 hover:bg-green-600 w-full px-4 py-2 rounded-md border-2 border-[rgb(34,197,94)] transition-colors duration-500 group hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer]">
                                <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(34,197,94)] text-xs">Lookup Account</div>
                                <div class="absolute w-[101%] h-[115%] bg-[rgb(34,197,94)] hover:bg-green-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                            </button>
                        </form>
                    </div>
                    <?php endif; ?>

                    <!-- Display Account Information if found and authorized -->
                    <?php if (isset($account_data)): ?>
                    <div class="bg-[#1E293B] border border-blue-400 rounded-md p-4 mb-6">
                        <h4 class="font-bold text-blue-400 mb-2">Account Details</h4>
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
                    </div>
                    <?php endif; ?>

                    <!-- Logout Button -->
                    <div class="mt-6">
                        <a href="?logout=1" class="relative bg-red-500 hover:bg-red-600 w-full px-4 py-3 rounded-md border-2 border-[rgb(239,68,68)] transition-colors duration-500 group flex justify-center hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer]">
                            <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(239,68,68)] text-sm">Logout</div>
                            <div class="absolute w-[101%] h-[110%] bg-[rgb(239,68,68)] hover:bg-red-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
                <div class="mt-4 text-center">
                    <a href="Insecure-design-vulnerable.php" class="text-blue-400 hover:text-blue-300 text-sm hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer]">Try the Insecure version</a>
                </div>
            </div>

            <!-- RIGHT SIDE: EXPLANATION -->
            <div class="formSection md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-[#3E4B5E] shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="flex items-center justify-center font-['Press_Start_2P'] text-white font-black text-xl border-2 border-[#3E4B5E] rounded-full w-10 h-10 mr-4">🔐</div>
                    <h2 class="text-2xl font-['Press_Start_2P'] text-green-500">Secure Design</h2>
                </div>

                <div class="bg-[#1E293B] p-4 rounded-lg mb-6">
                    <h3 class="text-lg font-bold text-white mb-2">What is Insecure Design?</h3>
                    <p class="text-gray-300 mb-4">Insecure Design refers to vulnerabilities that arise from failing to use security-by-design principles during application planning and architecture. This occurs when security controls are missing or insufficient by design, rather than implementation errors.</p>
                    <div class="flex items-center text-red-400 mb-2">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-bold">OWASP A04:2021</span>
                    </div>
                </div>

                <div class="bg-[#1E293B] p-4 rounded-lg mb-6">
                    <h3 class="text-lg font-bold text-green-400 mb-2">Secure Implementation Examples</h3>
                    
                    <div class="mb-6">
                        <h4 class="text-md font-bold text-white mb-2">#1: Secure Password Reset Flow</h4>
                        <ul class="list-disc list-inside text-gray-300 space-y-2">
                            <li>Uses securely generated random tokens with expiration</li>
                            <li>Verifies user identity before allowing password changes</li>
                            <li>Implements anti-enumeration techniques</li>
                            <li>Enforces strong password requirements</li>
                        </ul>
                    </div>
                    
                    <div class="mb-6">
                        <h4 class="text-md font-bold text-white mb-2">#2: Brute Force Protection</h4>
                        <ul class="list-disc list-inside text-gray-300 space-y-2">
                            <li>Account lockout after multiple failed attempts</li>
                            <li>Secure password storage using hashing</li>
                            <li>Rate limiting on authentication attempts</li>
                            <li>Clear security logging for all authentication events</li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-md font-bold text-white mb-2">#3: Proper Access Control</h4>
                        <ul class="list-disc list-inside text-gray-300 space-y-2">
                            <li>Authorization checks before granting access to accounts</li>
                            <li>Role-based access control implementation</li>
                            <li>Using server-side validation of permissions</li>
                            <li>Removing direct object references from URLs</li>
                        </ul>
                    </div>
                </div>

                <div class="bg-[#1E293B] p-4 rounded-lg">
                    <h3 class="text-lg font-bold text-white mb-4">Secure Design Principles</h3>
                    
                    <div class="space-y-3">
                        <div class="bg-[#172135] p-3 rounded-md">
                            <h4 class="font-bold text-blue-400">Defense in Depth</h4>
                            <p class="text-gray-300 text-sm">Multiple layers of security controls provide redundancy if one fails.</p>
                        </div>
                        
                        <div class="bg-[#172135] p-3 rounded-md">
                            <h4 class="font-bold text-blue-400">Least Privilege</h4>
                            <p class="text-gray-300 text-sm">Users and systems should only have access to what they absolutely need.</p>
                        </div>
                        
                        <div class="bg-[#172135] p-3 rounded-md">
                            <h4 class="font-bold text-blue-400">Fail Securely</h4>
                            <p class="text-gray-300 text-sm">When failures occur, the system should default to a secure state.</p>
                        </div>
                        
                        <div class="bg-[#172135] p-3 rounded-md">
                            <h4 class="font-bold text-blue-400">Complete Mediation</h4>
                            <p class="text-gray-300 text-sm">Check access rights on every request to a protected resource.</p>
                        </div>
                        
                        <div class="bg-[#172135] p-3 rounded-md">
                            <h4 class="font-bold text-blue-400">Security by Design</h4>
                            <p class="text-gray-300 text-sm">Build security into every stage of the development process.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CODE SNIPPET SECTION -->
        <div class="w-full max-w-7xl mt-8">
            <div class="bg-[#0F172A] p-6 rounded-lg border-2 border-[#3E4B5E] shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="flex items-center justify-center font-['Press_Start_2P'] text-white font-black text-xl border-2 border-[#3E4B5E] rounded-full w-10 h-10 mr-4">🧩</div>
                    <h2 class="text-2xl font-['Press_Start_2P'] text-green-500">Security Implementation Code</h2>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-white mb-4">Secure Password Reset Implementation</h3>
                    <pre><code class="language-php">// SECURE DESIGN #1: Proper password reset with verification
if (isset($_POST['request_reset'])) {
    $reset_username = $_POST['reset_username'];
    
    if (array_key_exists($reset_username, $users)) {
        // Generate secure random token
        $token = bin2hex(random_bytes(32));
        $expiry = time() + 3600; // 1 hour expiry
        
        // Store token and expiry in user record
        $users[$reset_username]['reset_token'] = $token;
        $users[$reset_username]['reset_token_expiry'] = $expiry;
        
        $reset_email = $users[$reset_username]['email'];
        
        // In a real application, send email with reset link
        // mail($reset_email, "Password Reset Request", "Click here to reset your password: https://example.com/reset.php?token=$token");
        
        $reset_token_sent = true;
        $message = "<div class='text-green-500 mb-4'>
            <p class='font-bold'>Password Reset Email Sent!</p>
            <p>Check your email address: {$reset_email}</p>
            <p class='text-xs mt-1 text-green-400'><strong>SECURE DESIGN:</strong> Reset token sent to verified email address</p>
        </div>";
        
        log_security_event("PASSWORD_RESET_REQUEST", $reset_username, "Reset token generated and sent to email");
    } else {
        // Use consistent messaging to prevent username enumeration
        $reset_token_sent = true;
        $message = "<div class='text-green-500 mb-4'>
            <p class='font-bold'>Password Reset Email Sent!</p>
            <p>If an account with that username exists, a reset link has been sent to the associated email address.</p>
            <p class='text-xs mt-1 text-green-400'><strong>SECURE DESIGN:</strong> Consistent messaging prevents username enumeration</p>
        </div>";
        
        log_security_event("PASSWORD_RESET_ATTEMPT", "unknown", "Reset requested for non-existent username: {$reset_username}");
    }
}</code></pre>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-white mb-4">Brute Force Protection Implementation</h3>
                    <pre><code class="language-php">// SECURE DESIGN #2: Proper authentication with brute force protection
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Check if account exists
    if (array_key_exists($username, $users)) {
        // Check if account is locked
        if ($users[$username]['account_locked']) {
            $message = "<div class='text-red-500 mb-4'>
                <p class='font-bold'>Account Locked:</p>
                <p>This account has been temporarily locked due to multiple failed login attempts.</p>
                <p>Please reset your password or try again later.</p>
            </div>";
            
            log_security_event("LOGIN_ATTEMPT_BLOCKED", $username, "Attempt on locked account");
        } else {
            // Verify password using secure comparison
            if (password_verify($password, $users[$username]['password_hash'])) {
                $logged_in = true;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $users[$username]['role'];
                
                // Reset failed login attempts
                $users[$username]['failed_login_attempts'] = 0;
                
                log_security_event("LOGIN_SUCCESS", $username, "Successful login");
            } else {
                // Increment failed login attempts
                $users[$username]['failed_login_attempts']++;
                $users[$username]['last_failed_attempt'] = time();
                
                // Lock account after 5 failed attempts
                if ($users[$username]['failed_login_attempts'] >= 5) {
                    $users[$username]['account_locked'] = true;
                    $message = "<div class='text-red-500 mb-4'>
                        <p class='font-bold'>Account Locked:</p>
                        <p>This account has been locked due to multiple failed login attempts.</p>
                        <p>Please reset your password to unlock your account.</p>
                    </div>";
                    
                    log_security_event("ACCOUNT_LOCKED", $username, "Account locked after 5 failed attempts");
                }
            }
        }
    }
}</code></pre>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-white mb-4">Proper Access Control Implementation</h3>
                    <pre><code class="language-php">// SECURE DESIGN #3: Proper access control for account information
if (isset($_GET['view_account']) && !empty($_SESSION['username'])) {
    $account_id = $_GET['view_account'];
    $current_user = $_SESSION['username'];
    $current_role = $_SESSION['role'];
    
    // Find account by ID
    $account_found = false;
    $account_owner = '';
    
    foreach ($users as $user => $details) {
        if ($details['account_id'] === $account_id) {
            $account_found = true;
            $account_owner = $user;
            break;
        }
    }
    
    // Apply proper access control
    if ($account_found) {
        $authorized = false;
        
        // Authorization rules:
        // 1. Users can only view their own accounts
        // 2. Admins can view any account
        if ($current_role === 'admin' || $account_owner === $current_user) {
            $authorized = true;
            $account_data = [
                'username' => $account_owner,
                'email' => $users[$account_owner]['email'],
                'role' => $users[$account_owner]['role'],
                'balance' => $users[$account_owner]['balance']
            ];
            
            log_security_event("ACCOUNT_ACCESS", $current_user, "Authorized access to account: {$account_id}");
        }
        
        if (!$authorized) {
            $message = "<div class='text-red-500 mb-4'>
                <p class='font-bold'>Access Denied:</p>
                <p>You do not have permission to view this account.</p>
                <p class='text-xs mt-1 text-green-400'><strong>SECURE DESIGN:</strong> Proper access control prevents unauthorized account access</p>
            </div>";
            
            log_security_event("UNAUTHORIZED_ACCESS_ATTEMPT", $current_user, "Attempted to access account: {$account_id}");
        }
    }
}</code></pre>
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
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact us.php" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">About Us</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact us.php" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact us.php" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">FAQs</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Follow Us</h3>
                <div class="mt-4 flex justify-center md:justify-start space-x-4">
                    <a href="#" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Web-Nexus-Project/Assets/Images/github.png" alt="Github" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Web-Nexus-Project/Assets/Images/LinkedIn.jpg" alt="Linkedin" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
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