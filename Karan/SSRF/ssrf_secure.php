<?php
function isValidURL($url) {
    $parsed = parse_url($url);
    // Allow only http and https
    if (!in_array($parsed['scheme'], ['http', 'https'])) {
        return false;
    }

    // Prevent localhost, internal IPs (basic check)
    $host = gethostbyname($parsed['host']);
    if (preg_match('/^(127\.|10\.|192\.168\.)/', $host)) {
        return false;
    }

    return filter_var($url, FILTER_VALIDATE_URL);
}

if (isset($_GET['url'])) {
    $url = $_GET['url'];
    if (isValidURL($url)) {
        $response = file_get_contents($url);
    } else {
        $error = "Invalid or restricted URL.";
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSRF Secure Demo</title>
    
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
        <div class="flex items-center space-x-3">
            <a href="../Karan/index.php">
                <img src="/Web-Nexus-Project/Assets/Images/logo.svg" alt="logo" class="w-12" />
            </a>
            <span class="text-2xl text-white font-bold font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] max-md:text-xs">Web-Nexus</span>
        </div>

        <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
            <a
            href="/Web-Nexus-Project/Kavy (Main Branch)/Home/Home-Page.html#vulnerabilities"
            class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs"
            >Vulnerabilities</a
            >
            <a
            href="/Web-Nexus-Project/Kavy (Main Branch)/Home/Home-Page.php"
            class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs"
            >Home</a
            >
            <a
            href="/Web-Nexus-Project/Karan/About Us/contact_us.php"
            class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs"
            >Contact Us</a
            >
        </div>

        <div
            id="menu-btn"
            class="hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] md:hidden focus:outline-none"
        >
            <img src="/Web-Nexus-Project/Assets/Images/menu.svg" alt="menu" class="w-8" />
        </div>

        <div class="flex items-center justify-center">
            <div
            onclick="window.location.href='index.html'"
            class="yellowButton yellowButtonHeader hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]"
            >
            <div
                class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500"
            >
                <div
                class="font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] font-thin text-xs max-md:text-[8px] text-black"
                >
                Back to Vulnerabilities
                </div>
                <div
                class="absolute w-[102%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md transition-colors duration-500 -z-1 top-[1%] left-0"
                ></div>
            </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="pt-[15vh] pb-10 px-4 flex flex-col items-center justify-start min-h-screen">
        <div class="w-full max-w-7xl flex flex-col md:flex-row gap-8">
            <!-- LEFT SIDE: FORM -->
            <div class="formSection md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-green-600 shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="flex items-center justify-center font-['Press_Start_2P'] text-white font-black text-xl border-2 border-green-600 rounded-full w-10 h-10 mr-4">✓</div>
                    <h2 class="text-2xl font-['Press_Start_2P'] text-green-500">Secure SSRF</h2>
                </div>

                <?php if (isset($response) || isset($error)): ?>
                <div class="text-green-500 mb-4 overflow-hidden">
                    <p class="font-bold">✅ SECURE IMPLEMENTATION ✅</p>
                    <p>URL request processed with proper validation!</p>
                    <p class="mt-2 text-xs">Security features:</p>
                    <ul class="list-disc ml-5 text-xs">
                        <li>URL scheme validation (http/https only)</li>
                        <li>Internal IP address blocking</li>
                        <li>Proper input sanitization</li>
                    </ul>
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
                            class="w-full p-3 bg-[#1E293B] border border-green-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-300" 
                            required
                        >
                        <p class="mt-1 text-xs text-gray-400">Enter a valid HTTP or HTTPS URL (internal IPs are blocked)</p>
                    </div>
                    
                    <button type="submit" class="relative bg-green-500 hover:bg-green-600 w-full px-4 py-3 rounded-md border-2 border-[rgb(34,197,94)] transition-colors duration-500 group hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                        <div class="font-['Press_Start_2P'] text-black group-hover:text-white drop-shadow-[2px_2px_0px_rgb(34,197,94)] text-sm">Fetch URL Securely</div>
                        <div class="absolute w-[101%] h-[110%] bg-[rgb(34,197,94)] hover:bg-green-600 rounded-md transition-colors duration-500 -z-10 top-[2%] left-0"></div>
                    </button>
                    
                    <div class="mt-4 text-center">
                        <a href="ssrf_vulnerable.php" class="text-blue-400 hover:text-blue-300 text-sm hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Try the vulnerable version</a>
                    </div>
                </form>
            </div>

            <!-- RIGHT SIDE: EXPLANATION -->
            <div class="formSection md:w-1/2 bg-[#0F172A] p-6 rounded-lg border-2 border-green-600 shadow-lg">
                <h3 class="text-xl font-['Press_Start_2P'] text-green-300 mb-6">Security Explained</h3>
                
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">What's happening?</h4>
                    <p class="text-gray-300 mb-4">This form implements proper URL validation to prevent Server-Side Request Forgery attacks:</p>
                    
                    <pre class="bg-gray-800 p-4 rounded-md overflow-x-auto mb-4">
<code class="language-php">// Secure implementation
function isValidURL($url) {
    $parsed = parse_url($url);
    // Allow only http and https
    if (!in_array($parsed['scheme'], ['http', 'https'])) {
        return false;
    }

    // Prevent localhost, internal IPs
    $host = gethostbyname($parsed['host']);
    if (preg_match('/^(127\.|10\.|192\.168\.)/', $host)) {
        return false;
    }

    return filter_var($url, FILTER_VALIDATE_URL);
}</code></pre>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Why is this secure?</h4>
                    <ul class="list-disc pl-5 text-gray-300 space-y-2">
                        <li>Validates URL scheme (only http/https allowed)</li>
                        <li>Blocks access to internal IP addresses</li>
                        <li>Uses PHP's built-in URL validation</li>
                        <li>Prevents attackers from accessing internal resources</li>
                    </ul>
                </div>

                <?php if (isset($response)): ?>
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Response</h4>
                    <div class="response-container bg-[#1E293B] p-4 rounded-md border border-green-600 overflow-auto">
                        <pre class="whitespace-pre-wrap break-words text-sm text-gray-300"><?php echo htmlspecialchars($response); ?></pre>
                    </div>
                </div>
                <?php elseif (isset($error)): ?>
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-white mb-2">Security Alert</h4>
                    <div class="bg-red-900/30 border border-red-500 p-4 rounded-md">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <div>
                                <p class="font-medium text-red-400"><?php echo $error; ?></p>
                                <p class="mt-1 text-sm text-red-300">The URL was blocked by our security filters.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div>
                    <h4 class="text-lg font-bold text-white mb-2">Best Practices</h4>
                    <p class="text-gray-300">To prevent SSRF vulnerabilities:</p>
                    <ul class="list-disc pl-5 text-gray-300 space-y-1 mt-2">
                        <li>Implement allowlists for domains and URL schemes</li>
                        <li>Block access to internal networks and localhost</li>
                        <li>Use network-level controls when possible</li>
                        <li>Implement proper input validation and sanitization</li>
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
