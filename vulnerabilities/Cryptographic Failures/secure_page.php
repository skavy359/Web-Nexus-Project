<?php
// Secure: Using strong password hashing and verification
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /Web-Nexus-Project/Kartavya/Login_Pages/login_page.php");
    exit;
}

$bcrypt_hash = "";
$password_entered = "";
$username_entered = "";
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_entered = $_POST['username'];
    $password_entered = $_POST['password'];

    // Secure Hashing: Using password_hash() with Bcrypt
    $bcrypt_hash = password_hash($password_entered, PASSWORD_BCRYPT);

    // Simulating secure storage (storing in a session variable)
    $_SESSION['users'][$username_entered] = $bcrypt_hash;

    // Display success message with security information
    $success_message = "<div class='text-green-500 mb-4 overflow-hidden'>
        <p class='font-bold'>✅ SECURE IMPLEMENTATION ✅</p>
        <p>User registered with strong Bcrypt hashing!</p>
        <p>Stored Hash: <span class='font-mono bg-gray-800 px-2 py-1 rounded text-green-300'>$bcrypt_hash</span></p>
        <p class='mt-2 text-xs'>Bcrypt advantages:</p>
        <ul class='list-disc ml-5 text-xs'>
            <li>Automatic salt generation</li>
            <li>Computationally expensive (slows brute force)</li>
            <li>Adaptive work factor for future security</li>
        </ul>
    </div>";
}
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Form - Cryptographic Best Practices</title>

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
            <a href="/Web-Nexus-Project/About Us/contact us.php" class="headerStuff hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
        </div>

        <div class="hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
            <div onclick="window.location.href='index.php'" class="yellowButton yellowButtonHeader hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer]">
                <div class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                    <div class="font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] text-black font-thin text-sm max-md:text-[8px]">
                        <a href="/Web-Nexus-Project/vulnerabilities/Cryptographic Failures/index.php">Back to Vulnerability</a>
                    </div>
                    <div class="absolute w-[102%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md transition-colors duration-500 -z-1 top-[1%] left-0"></div>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div id="home" class="pt-[15vh] pb-10 px-4 flex flex-col items-center justify-start min-h-screen">
        <div class="w-full max-w-7xl flex flex-col md:flex-row gap-8">
            <!-- LEFT SIDE: FORM -->
            <div class="md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-[#3E4B5E] shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="flex items-center justify-center font-['Press_Start_2P'] text-white font-black text-xl border-2 border-[#3E4B5E] rounded-full w-10 h-10 mr-4">✓</div>
                    <h2 class="text-2xl font-['Press_Start_2P'] text-green-500">Secure Form</h2>
                </div>

                <?php echo $success_message; ?>

                <form method="POST" class="mt-4">
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-300 mb-1">Username</label>
                        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username_entered); ?>" placeholder="Enter username" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-300">
                    </div>
                    
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                        <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($password_entered); ?>" placeholder="Enter password" class="w-full p-3 bg-[#1E293B] border border-[#3E4B5E] rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-300">
                    </div>
                    
                    <button type="submit" class="relative bg-green-500 hover:bg-green-600 w-full px-4 py-3 rounded-md border-2 border-[rgb(34,197,94)] transition-colors duration-500 group hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer]">
                        <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(34,197,94)] text-sm">Register (Secure)</div>
                        <div class="absolute w-[101%] h-[110%] bg-[rgb(34,197,94)] hover:bg-green-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                    </button>
                    
                    <div class="mt-4 text-center">
                        <a href="vulnerable_page.php" class="text-blue-400 hover:text-blue-300 text-sm hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer]">Try the vulnerable version</a>
                    </div>
                </form>
            </div>

            <!-- RIGHT SIDE: EXPLANATION -->
            <div class="md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-[#3E4B5E] shadow-lg">
                <h3 class="text-xl font-['Press_Start_2P'] text-green-300 mb-6">Security Explained</h3>
                
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">What's happening?</h4>
                    <p class="text-gray-300 mb-4">This form uses PHP's built-in password_hash() function with Bcrypt for secure password hashing:</p>
                    
                    <pre class="bg-gray-800 p-4 rounded-md overflow-x-auto mb-4">
<code class="language-php">// Secure implementation
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
// Automatically includes salt and is slow by design</code></pre>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Why is this secure?</h4>
                    <ul class="list-disc pl-5 text-gray-300 space-y-2">
                        <li>Bcrypt is deliberately slow, making brute force attacks impractical</li>
                        <li>Unique salt is automatically generated for each password</li>
                        <li>Work factor can be increased as computing power grows</li>
                        <li>Resistant to rainbow table attacks due to salting</li>
                    </ul>
                </div>

                <?php if (!empty($bcrypt_hash)): ?>
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Live Demonstration</h4>
                    <div class="bg-gray-800 p-4 rounded-md">
                        <p class="text-gray-300">Password entered: <span class="font-mono text-green-300"><?php echo htmlspecialchars($password_entered); ?></span></p>
                        <p class="text-gray-300">Bcrypt hash: <span class="font-mono text-green-300"><?php echo $bcrypt_hash; ?></span></p>
                        <p class="text-gray-300 mt-2 text-sm">Notice how the hash includes the algorithm, cost factor, and salt.</p>
                        <p class="text-gray-300 text-sm">Even if you enter the same password twice, you'll get different hashes!</p>
                    </div>
                </div>
                <?php endif; ?>

                <div>
                    <h4 class="text-lg font-bold text-white mb-2">Verification Process</h4>
                    <pre class="bg-gray-800 p-4 rounded-md overflow-x-auto">
<code class="language-php">// To verify a password against a stored hash
if (password_verify($password, $stored_hash)) {
    // Password is correct
} else {
    // Password is incorrect
}</code></pre>
                    <p class="text-gray-300 mt-2">The password_verify() function safely compares a password against a stored hash without exposing the original password.</p>
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
                    <li><a href="/Web-Nexus-Project/About Us/contact us.php" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">About Us</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#home" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="/Web-Nexus-Project/About Us/contact us.php" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">FAQs</a></li>
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
