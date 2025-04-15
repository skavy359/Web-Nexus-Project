<?php
session_start();

$username_entered = '';
$password_entered = '';
$access_message = '';

// Initialize attempt counter if not set
if (!isset($_SESSION['vuln_login_attempts'])) {
    $_SESSION['vuln_login_attempts'] = 0;
}

$valid_user = 'admin';
$valid_pass = 'admin123';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_entered = $_POST['username'] ?? '';
    $password_entered = $_POST['password'] ?? '';

    if ($username_entered === $valid_user && $password_entered === $valid_pass) {
        $access_message = "<div class='text-green-400 font-bold mb-4'>🔓 Access Granted (No Logs Generated)</div>";
        $_SESSION['vuln_login_attempts'] = 0; // Reset on success
    } else {
        $_SESSION['vuln_login_attempts']++;
        $count = $_SESSION['vuln_login_attempts'];
        $access_message = "<div class='text-yellow-400 font-bold mb-4'>❌ Invalid credentials (Attempt #{$count})</div>
        <div class='text-red-500 text-sm mt-2'>😬 You have entered wrong credentials {$count} times, and this system still allows unlimited attempts!</div>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable Page of Security Logging and Monitoring Failure</title>
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
            <a href="/Kavy (Main Branch)/Home/Home-Page.html#vulnerabilities"
                class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="/Kavy (Main Branch)/Home/Home-Page.html"
                class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Home</a>
            <a href="/Karan/About Us/contact_us.html"
                class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Contact
                Us</a>
        </div>

        <div id="menu-btn"
            class="hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] md:hidden focus:outline-none">
            <img src="/Assets/Images/menu.svg" alt="menu" class="w-8" />
        </div>

        <div class="flex items-center justify-center">
            <div onclick="window.location.href='Secutity_Logging_and_Monitoring_Failure.html'"
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
    <!-- Left: Vulnerable Form -->
    <div class="md:w-1/2 bg-[#0F172A] p-8 rounded-xl border-2 border-[#3E4B5E]">
        <div class="flex items-center mb-6">
            <div
                class="flex items-center justify-center font-['Press_Start_2P'] text-white font-black text-xl border-2 border-[#3E4B5E] rounded-full w-10 h-10 mr-4">
                !
            </div>
            <div class="text-2xl text-red-500 font-['Press_Start_2P']">Vulnerable Form</div>
        </div>

        <?= $access_message ?>

        <form method="POST" class="mt-6">
            <div class="mb-6">
                <label for="username" class="block text-xl text-gray-300 mb-2">Username</label>
                <input type="text" name="username" id="username"
                    value="<?= htmlspecialchars($username_entered) ?>"
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
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 py-4 text-xl rounded-lg text-white font-bold hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Login (Insecure)</button>
            
            <p class="text-xs text-gray-400 italic mt-4 ml-10">
                😉 Try logging in as <span class="font-mono bg-gray-800 px-2 py-1 rounded">admin</span> with password <span class="font-mono bg-gray-800 px-2 py-1 rounded">admin123</span>
            </p>
        </form>
    </div>

    <!-- Right: Explanation Section -->
    <div class="md:w-1/2 bg-[#0F172A] p-6 rounded-lg border border-[#3E4B5E]">
        <h3 class="text-xl font-['Press_Start_2P'] text-red-500 mb-4">Vulnerability Explained</h3>

        <h4 class="text-xl text-white font-bold mb-2">What’s happening?</h4>
        <p class="text-gray-300 mb-4 text-lg leading-relaxed">
            This form does not implement any form of logging for access attempts. Whether access is successful or failed, 
            there is no visibility into who tried to log in, when, and how often. This leaves the application blind to 
            malicious activity.
        </p>

        <h4 class="text-xl text-white font-bold mb-2">Code Sample</h4>
        <pre class="bg-gray-800 p-4 rounded text-base overflow-auto mb-6">
<code class="text-red-400">// No logging at all
if ($username === $valid_user && $password === $valid_pass) {
    echo "Access Granted";
} else {
    echo "Invalid credentials";
}
// Missed opportunity to detect brute-force or suspicious activity
</code>
        </pre>

        <h4 class="text-xl text-white font-bold mb-2">Why is this vulnerable?</h4>
        <ul class="list-disc text-gray-300 ml-6 mb-6 text-base leading-relaxed">
            <li>Security events like failed logins or repeated access attempts aren't recorded.</li>
            <li>Administrators have no way to detect attacks in real-time or post-incident.</li>
            <li>Attackers can brute-force or scan credentials without triggering alerts.</li>
            <li>No audit trail exists for investigating breaches or anomalies.</li>
            <li>Violates OWASP recommendations for proper security logging and monitoring.</li>
        </ul>

        <h4 class="text-xl text-white font-bold mb-2">Real-World Impact</h4>
        <p class="text-gray-300 mb-4 text-lg leading-relaxed">
            In many breaches, attackers dwell in systems for weeks or months without being detected. Lack of proper logging and
            alerting means you won’t know something is wrong until it’s too late.
        </p>

        <h4 class="text-xl text-white font-bold mb-2">Secure Practice</h4>
        <pre class="bg-gray-800 p-4 rounded text-base overflow-auto mb-6">
<code class="text-green-400">// Basic secure logging example
$log_entry = date("Y-m-d H:i:s") . " | Login attempt | User: $username | Status: ";
$log_entry .= ($username === $valid_user && $password === $valid_pass) ? "Success" : "Failure";
file_put_contents("access_log.txt", $log_entry . PHP_EOL, FILE_APPEND);
</code>
        </pre>

        <p class="text-gray-400 text-sm italic">
            Monitoring and alerting are your best friends in detecting and responding to attacks before serious damage is done.
        </p>
    </div>
</div>
    </main>

    <!-- FOOTER SECTION -->
    <footer class="bg-gray-950 text-white py-16 mt-16">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-center md:text-left">
            <div>
                <img src="/Assets/Images/logo.svg" alt="Web-Nexus Logo" class="w-24 mx-auto md:mx-0">
                <p class="mt-4 text-gray-400">Learn security the hands-on-way.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Company</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="/Karan/About Us/contact_us.html" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">About Us</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#home" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="/Karan/About Us/contact_us.html" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">FAQs</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Follow Us</h3>
                <div class="mt-4 flex justify-center md:justify-start space-x-4">
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Assets/Images/github.png" alt="Github" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Assets/Images/LinkedIn.jpg" alt="Linkedin" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Assets/Images/twitter.jpg" alt="Twitter" class="w-8">
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