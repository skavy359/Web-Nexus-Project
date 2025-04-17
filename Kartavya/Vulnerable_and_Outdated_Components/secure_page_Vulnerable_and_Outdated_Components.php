<?php
session_start();

$username_entered = '';
$password_entered = '';
$access_message = '';

// Simulated environment/component versions
$current_php_version = '7.4.0'; // Outdated
$required_php_version = '8.0.0';

$current_lib_version = '2.1.0'; // Outdated
$required_lib_version = '3.0.0';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_entered = $_POST['username'] ?? '';
    $password_entered = $_POST['password'] ?? '';

    $is_php_outdated = version_compare($current_php_version, $required_php_version, '<');
    $is_lib_outdated = version_compare($current_lib_version, $required_lib_version, '<');

    if ($is_php_outdated || $is_lib_outdated) {
        $access_message = "
        <div class='text-green-500 mb-4'>
            <p class='font-bold text-lg'>🚫 ACCESS DENIED</p>
            <p class='mt-2'>Login blocked due to insecure system components:</p>
            <ul class='list-disc ml-6 mt-2 text-sm'>
                " . ($is_php_outdated ? "<li>PHP Version <span class='text-yellow-300 font-mono'>$current_php_version</span> is outdated. (Required: $required_php_version+)</li>" : "") . "
                " . ($is_lib_outdated ? "<li>Library Version <span class='text-yellow-300 font-mono'>$current_lib_version</span> is outdated. (Required: $required_lib_version+)</li>" : "") . "
            </ul>
            <p class='mt-3 text-sm'>To protect against vulnerable and outdated components, login is disabled until the system is updated.</p>
        </div>";
    } else {
        $access_message = "<div class='text-green-500 font-bold mb-4'>✅ Access Granted (for demonstration purposes)</div>";
    }
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
    <nav class="fixed z-[999] top-0 left-0 h-[10vh] w-screen flex items-center justify-between p-4 bg-[#020617] border-b-2 border-[#3E4B5E] max-md:p-0">
        <div class="headerStuff flex items-center space-x-3 max-md:space-x-1">
            <img src="/Web-Nexus-Project/Assets/Images/logo.svg" alt="logo" class="w-12 max-md:w-8">
            <span class="text-2xl font-bold text-white font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] max-md:text-xs hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Web-Nexus</span>
        </div>

        <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
            <a href="/Web-Nexus-Project/Kavy (Main Branch)/Home/Home-Page.html#vulnerabilities" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="/Web-Nexus-Project/Kavy (Main Branch)/Home/Home-Page.php" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Home</a>
            <a href="/Web-Nexus-Project/Karan/About Us/contact_us.php" class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]  text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
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

    <main class="pt-[15vh] px-4 pb-10 flex flex-col items-center min-h-screen">
        <div class="w-full max-w-6xl flex flex-col md:flex-row gap-10">
            <!-- Left: Secure Form -->
            <div class="formSection md:w-1/2 bg-[#0F172A] p-8 rounded-xl border-2 border-[#3E4B5E]">
                <div class="flex items-center mb-6">
                    <div class="flex items-center justify-center font-['Press_Start_2P'] text-white font-black text-xl border-2 border-[#3E4B5E] rounded-full w-10 h-10 mr-4">✓</div>
                    <div class="text-2xl text-green-500 font-['Press_Start_2P']">Secure Form</div>
                </div>

                <?= $access_message ?>

                <form method="POST" class="mt-6">
                    <div class="mb-6">
                        <label for="username" class="block text-xl text-gray-300 mb-2">Username</label>
                        <input type="text" name="username" id="username"
                            value="<?= htmlspecialchars($username_entered) ?>"
                            class="w-full p-5 bg-[#1E293B] border border-[#3E4B5E] rounded-xl text-white"
                            placeholder="Enter username">
                        <p class="text-xs text-gray-400 mt-1">Try: admin</p>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-xl text-gray-300 mb-2">Password</label>
                        <input type="password" name="password" id="password" required
                            value="<?= htmlspecialchars($password_entered) ?>"
                            class="w-full p-5 bg-[#1E293B] border border-[#3E4B5E] rounded-xl text-white"
                            placeholder="Enter password">
                        <p class="text-xs text-gray-400 mt-1">Try: admin123</p>
                    </div>
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 py-4 text-xl rounded-lg text-white font-bold hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Login</button>
                </form>
                <div class="mt-4 text-center">
                    <a href="vulnerable_page_Vulnerable_and_Outdated_Components.php" class="text-blue-400 hover:text-blue-300 text-sm hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Try the vulnerable version</a>
                </div>
            </div>

            <!-- Right: Explanation -->
            <!-- Right: Explanation -->
<div class="formSection md:w-1/2 bg-[#0F172A] p-6 rounded-lg border border-[#3E4B5E]">
    <h3 class="text-2xl font-['Press_Start_2P'] text-green-400 mb-4">Security Explained</h3>

    <!-- What's happening -->
    <h4 class="text-xl text-white font-bold mb-2">What’s happening?</h4>
    <p class="text-gray-300 mb-4 text-lg leading-relaxed">
        This form simulates a secure environment where login is automatically blocked if system components are outdated.
        It validates:
    </p>
    <ul class="list-disc text-gray-300 ml-6 mb-6 text-base leading-relaxed">
        <li>PHP version against a secure minimum requirement (v<?= $required_php_version ?>).</li>
                    <li>A key library’s version, like a cryptographic or password-handling module.</li>
                    <li>Any login attempt is denied if either version is below the threshold—regardless of credentials.</li>
                </ul>
            
                <!-- Code Example -->
                <h4 class="text-xl text-white font-bold mb-2">Code Check Logic</h4>
                <pre class="bg-gray-800 p-4 rounded text-base overflow-auto mb-6">
<code class="text-green-400">// Check PHP version
if (version_compare($current_php_version, $required_php_version, '&lt;')) {
    // block login
}

// Check Library version
if (version_compare($current_lib_version, $required_lib_version, '&lt;')) {
    // block login
}</code>
                </pre>
            
                <!-- Why this is secure -->
                <h4 class="text-xl text-white font-bold mb-2">Why is this secure?</h4>
                <ul class="list-disc text-gray-300 ml-6 mb-6 text-base leading-relaxed">
                    <li>Outdated PHP or libraries often contain known vulnerabilities.</li>
                    <li>Attackers can exploit outdated components to bypass security or execute code.</li>
                    <li>Blocking access before authentication minimizes exposure to exploits.</li>
                    <li>This mimics real-world security policies enforced in enterprise-grade systems.</li>
                </ul>
            
                <!-- Final note -->
                <p class="text-gray-400 text-sm italic">
                    This demonstration reflects OWASP's recommendation to prevent vulnerabilities caused by outdated software.
                </p>
            </div>
        </div>
    </main>
    <!-- FOOTER SECTION -->
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
                    <li><a href="#home" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#home" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact_us.php" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">FAQs</a></li>
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