<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /Web-Nexus-Project/Kartavya/Login_Pages/login_page.php");
    exit;
}
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    $response = file_get_contents($url); // 🚨 Dangerous: no validation
}
?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSRF Vulnerable Demo</title>
    
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
    
    <style>
        .response-container {
            max-height: 300px;
            overflow-y: auto;
            scrollbar-width: thin;
        }
        .response-container::-webkit-scrollbar {
            width: 8px;
        }
        .response-container::-webkit-scrollbar-track {
            background: #1E293B;
            border-radius: 10px;
        }
        .response-container::-webkit-scrollbar-thumb {
            background: #3E4B5E;
            border-radius: 10px;
        }
        .response-container::-webkit-scrollbar-thumb:hover {
            background: #4B5563;
        }
    </style>
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
            <div onclick="window.location.href='index.php'" class="yellowButton yellowButtonHeader hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                <div class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                    <div class="font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] text-black font-thin text-sm max-md:text-[8px]">
                        <a href="/Web-Nexus-Project/Karan/SSRF/index.php">Back to Vulnerability</a>
                    </div>
                    <div class="absolute w-[102%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md transition-colors duration-500 -z-1 top-[1%] left-0"></div>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="pt-[15vh] pb-10 px-4 flex flex-col items-center justify-start min-h-screen">
        <div class="w-full max-w-7xl flex flex-col md:flex-row gap-8">
            <!-- LEFT SIDE: FORM -->
            <div class="formSection md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-red-600 shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="flex items-center justify-center font-['Press_Start_2P'] text-white font-black text-xl border-2 border-red-600 rounded-full w-10 h-10 mr-4">!</div>
                    <h2 class="text-2xl font-['Press_Start_2P'] text-red-500">Vulnerable SSRF</h2>
                </div>
                
                <?php if (isset($response)): ?>
                <div class="text-red-500 mb-4 overflow-hidden">
                    <p class="font-bold">⚠️ VULNERABLE IMPLEMENTATION ⚠️</p>
                    <p>URL request processed without any validation!</p>
                </div>
                <?php endif; ?>

                <form method="GET" class="mt-4">
                    <div class="mb-4">
                        <label for="url-input" class="block text-sm font-medium text-gray-300 mb-1">URL to fetch:</label>
                        <input 
                            id="url-input"
                            type="text" 
                            name="url" 
                            placeholder="https://example.com" 
                            value="<?php echo isset($_GET['url']) ? htmlspecialchars($_GET['url']) : ''; ?>"
                            class="w-full p-3 bg-[#1E293B] border border-red-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-red-300" 
                            required
                        >
                        <p class="mt-1 text-xs text-gray-400">Enter any URL (no validation is performed)</p>
                    </div>
                    
                    <button type="submit" class="relative bg-red-500 hover:bg-red-600 w-full px-4 py-3 rounded-md border-2 border-[rgb(239,68,68)] transition-colors duration-500 group hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                        <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(239,68,68)] text-sm">⚠️ Fetch URL (Vulnerable)</div>
                        <div class="absolute w-[101%] h-[110%] bg-[rgb(239,68,68)] hover:bg-red-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <a href="ssrf_secure.php" class="text-blue-400 hover:text-blue-300 text-sm hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Try the secure version</a>
                </div>
            </div>
            
            <!-- RIGHT SIDE: EXPLANATION -->
            <div class="formSection md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-red-600 shadow-lg">
                <h3 class="text-xl font-['Press_Start_2P'] text-red-300 mb-6">Vulnerability Explained</h3>
                
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">What's happening?</h4>
                    <p class="text-gray-300 mb-4">This form has no URL validation, making it vulnerable to Server-Side Request Forgery attacks:</p>
                    
                    <pre class="bg-gray-800 p-4 rounded-md overflow-x-auto mb-4">
<code class="language-php">// Vulnerable implementation
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    $response = file_get_contents($url); // 🚨 Dangerous: no validation
}</code></pre>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Why is this vulnerable?</h4>
                    <ul class="list-disc pl-5 text-gray-300 space-y-2">
                        <li>No URL scheme validation (allows file://, http://, etc.)</li>
                        <li>No filtering of internal IP addresses</li>
                        <li>No input validation or sanitization</li>
                        <li>Allows attackers to access internal resources</li>
                    </ul>
                </div>
                
                <!-- RESPONSE SECTION -->
                <?php if (isset($response)): ?>
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Response</h4>
                    <div class="response-container bg-[#1E293B] p-4 rounded-md border border-red-600 overflow-auto">
                        <pre class="whitespace-pre-wrap break-words text-sm text-gray-300"><?php echo htmlspecialchars($response); ?></pre>
                    </div>
                </div>
                <?php else: ?>
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Response</h4>
                    <div class="bg-[#1E293B] border border-red-600 rounded-md p-4 text-gray-400 italic">
                        No response yet. Enter a URL and click "Fetch URL" to see the response here.
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="mt-6 bg-red-900/20 border-l-4 border-red-600 p-4">
                    <h3 class="font-['Press_Start_2P'] text-red-400 text-sm mb-2">Security Risk</h3>
                    <p class="text-gray-300 text-sm">This page uses <code class="bg-[#1E293B] px-1 rounded">file_get_contents()</code> without any validation, allowing attackers to:</p>
                    <ul class="list-disc pl-5 mt-2 text-gray-300 text-sm space-y-1">
                        <li>Access internal network services</li>
                        <li>Read local files on the server</li>
                        <li>Perform port scanning</li>
                        <li>Exploit cloud metadata endpoints</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/gsap.min.js" integrity="sha512-f6bQMg6nkSRw/xfHw5BCbISe/dJjXrVGfz9BSDwhZtiErHwk7ifbmBEtF9vFW8UNIQPhV2uEFVyI/UHob9r7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/ScrollTrigger.min.js" integrity="sha512-AcqPGqrrAEtEwe+ADO5R8RbdFi7tuU7b/A2cJJH0Im0D18NRk5p5s4B3E5PMuO81KFw0ClN7J5SHVUJz7KOb0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/Web-Nexus-Project/Malay/Animations/DeserialisationAnimation/vulnerable_deserialisation_animation.js"></script>

</body>
</html>
