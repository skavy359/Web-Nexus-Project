<?php
session_start();

// Constants
$correct_username = 'admin';
$correct_password = 'secure123';
$max_attempts = 3;

// Reset login attempt via GET (triggered by button)
if (isset($_GET['reset']) && $_GET['reset'] === 'true') {
    setcookie('failed_attempts', '', time() - 3600, '/');
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?')); // Redirect to remove reset param
    exit;
}

// Count failed attempts
$attempts = isset($_COOKIE['failed_attempts']) ? (int) $_COOKIE['failed_attempts'] : 0;

$username_entered = '';
$password_entered = '';
$access_message = '';

// Check if access is blocked
$access_blocked = $attempts >= $max_attempts;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$access_blocked) {
    $username_entered = $_POST['username'] ?? '';
    $password_entered = $_POST['password'] ?? '';

    if ($username_entered === $correct_username && $password_entered === $correct_password) {
        $access_message = "<div class='text-green-500 font-bold mb-4'>✅ Access Granted (for demonstration purposes)</div>";
        setcookie('failed_attempts', '', time() - 3600, '/'); // Clear cookie on success
        $attempts = 0;
    } else {
        $attempts++;
        setcookie('failed_attempts', $attempts, time() + 3600, '/');

        if ($attempts >= $max_attempts) {
            $access_blocked = true;
        } else {
            $remaining = $max_attempts - $attempts;
            $access_message = "<div class='text-red-400 font-bold mb-4'>❌ Incorrect credentials. You have <span class='text-yellow-300'>$remaining</span> attempt(s) remaining.</div>";
        }
    }
}

if ($access_blocked) {
    $access_message = "
    <div class='text-red-400 mb-4'>
        <p class='font-bold text-lg'>🚫 ACCESS DENIED</p>
        <p class='mt-2 text-base'>You have exceeded the maximum number of login attempts.</p>
        <p class='mt-2 text-sm'>This simulates a secure system where repeated failed logins trigger temporary lockouts.</p>
        <form method='GET'>
            <button name='reset' value='true' class='mt-4 bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded'>
                🔄 Reset Attempts
            </button>
        </form>
    </div>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Page for Vulnerable and Outdated Components</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Lexend:wght@100..900&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#020617] text-white font-['Lexend'] selection:text-yellow-400 cursor-[url('/Assets/Images/cursor_01.png'),_auto]">
    <!-- HEADER -->
    <nav
        class="fixed z-[999] top-0 left-0 h-[10vh] w-screen flex items-center justify-between p-4 bg-[#020617] border-b-2 border-[#3E4B5E] max-md:p-0">
        <div class="flex items-center space-x-3">
            <a href="../Karan/index.html">
                <img src="/Assets/Images/logo.svg" alt="logo" class="w-12" />
            </a>
            <span
                class="text-2xl text-white font-bold font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] max-md:text-xs">Web-Nexus</span>
        </div>

        <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
            <a href="#"
                class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="#"
                class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">About
                Us</a>
            <a href="#"
                class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Contact
                Us</a>
        </div>

        <div id="menu-btn"
            class="hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] md:hidden focus:outline-none">
            <img src="/Assets/Images/menu.svg" alt="menu" class="w-8" />
        </div>

        <div class="flex items-center justify-center">
            <div onclick="window.location.href='index.html'"
                class="yellowButton yellowButtonHeader hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                <div
                    class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                    <div
                        class="font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] font-thin text-xs max-md:text-[8px] text-black">
                        Back to Vulnerabilities
                    </div>
                    <div
                        class="absolute w-[102%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md transition-colors duration-500 -z-1 top-[1%] left-0">
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-[15vh] px-4 pb-10 flex flex-col items-center min-h-screen">
    <div class="w-full max-w-6xl flex flex-col md:flex-row gap-10">
        <!-- Left: Secure Form -->
        <div class="md:w-1/2 bg-[#0F172A] p-8 rounded-xl border-2 border-[#3E4B5E]">
    <div class="flex items-center mb-6">
        <div class="flex items-center justify-center font-['Press_Start_2P'] text-white font-black text-xl border-2 border-[#3E4B5E] rounded-full w-10 h-10 mr-4">✓</div>
        <div class="text-2xl text-green-500 font-['Press_Start_2P']">Secure Form</div>
    </div>

    <?= $access_message ?>
        
            <?php if (!$access_blocked): ?>
                <form method="POST" class="mt-6">
                    <div class="mb-6">
                        <label for="username" class="block text-xl text-gray-300 mb-2">Username</label>
                        <input type="text" name="username" id="username" value="<?= htmlspecialchars($username_entered) ?>"
                            class="w-full p-5 bg-[#1E293B] border border-[#3E4B5E] rounded-xl text-white"
                            placeholder="Enter username">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-xl text-gray-300 mb-2">Password</label>
                        <input type="password" name="password" id="password" required
                            value="<?= htmlspecialchars($password_entered) ?>"
                            class="w-full p-5 bg-[#1E293B] border border-[#3E4B5E] rounded-xl text-white"
                            placeholder="Enter password">
                    </div>
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 py-4 text-xl rounded-lg text-white font-bold">Login</button>
                    <p class="text-xs text-gray-400 italic mt-4 ml-10">
                        😊 Try logging in as <span class="font-mono bg-gray-800 px-2 py-1 rounded">admin</span> with password <span class="font-mono bg-gray-800 px-2 py-1 rounded">admin123</span>
                    </p>
                </form>
            <?php endif; ?>
        </div>

    
            <!-- Right: Explanation -->
            <div class="md:w-1/2 bg-[#0F172A] p-6 rounded-lg border border-[#3E4B5E]">
                <h3 class="text-2xl font-['Press_Start_2P'] text-green-400 mb-4">Security Explained</h3>
    
                <h4 class="text-xl text-white font-bold mb-2">What’s happening?</h4>
                <p class="text-gray-300 mb-4 text-lg leading-relaxed">
                    This form simulates a secure login system that prevents brute-force attacks by limiting login attempts.
                    If a user enters incorrect credentials three times in a row, access is automatically blocked.
                    A reset button is provided to allow fresh testing for demonstration purposes.
                </p>
    
                <ul class="list-disc text-gray-300 ml-6 mb-6 text-base leading-relaxed">
                    <li>Tracks failed login attempts using PHP sessions.</li>
                    <li>Locks the user out after 3 consecutive failed attempts.</li>
                    <li>Prevents further attempts until the session is reset (simulating admin review or timeout).</li>
                </ul>
    
                <h4 class="text-xl text-white font-bold mb-2">Code Logic</h4>
                <pre class="bg-gray-800 p-4 rounded text-base overflow-auto mb-6">
    <code class="text-green-400">if ($_SESSION['failed_attempts'] >= 3) {
        // Block login
    } elseif (credentials are wrong) {
        $_SESSION['failed_attempts']++;
    }</code>
                </pre>
    
                <h4 class="text-xl text-white font-bold mb-2">Why is this secure?</h4>
                <ul class="list-disc text-gray-300 ml-6 mb-6 text-base leading-relaxed">
                    <li>Reduces risk of brute-force login attempts.</li>
                    <li>Simulates behavior of real-world intrusion detection systems.</li>
                    <li>Discourages attackers by introducing response thresholds.</li>
                </ul>
    
                <p class="text-gray-400 text-sm italic">
                    This implementation aligns with OWASP's guidance on logging and monitoring failures, by detecting and
                    responding to suspicious behavior.
                </p>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-950 text-white py-16 mt-16">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-center md:text-left">
            <div>
                <img src="/Assets/Images/logo.svg" alt="Web-Nexus Logo" class="w-24 mx-auto md:mx-0">
                <p class="mt-4 text-gray-400">Learn security the hands-on-way.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Company</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#"
                            class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">About
                            Us</a></li>
                    <li><a href="#"
                            class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a>
                    </li>
                    <li><a href="#"
                            class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#"
                            class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help
                            Center</a></li>
                    <li><a href="#"
                            class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a>
                    </li>
                    <li><a href="#"
                            class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">FAQs</a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Follow Us</h3>
                <div class="mt-4 flex justify-center md:justify-start space-x-4">
                    <a href="#"
                        class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Assets/Images/github.svg" alt="Github" class="w-8">
                    </a>
                    <a href="#"
                        class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Assets/Images/linkedin.svg" alt="Linkedin" class="w-8">
                    </a>
                    <a href="#"
                        class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Assets/Images/twitter.svg" alt="Twitter" class="w-8">
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
    <script src="/Malay/Animations/MisconfigAnimation/vulnerable_login_animation.js"></script>
</body>

</html>