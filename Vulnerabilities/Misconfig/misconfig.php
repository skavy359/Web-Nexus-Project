<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../../Login_Pages/login_page.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Misconfiguration</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

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
<body class="bg-[#020617] font-['Lexend'] selection:text-yellow-400 cursor-[url('../../Assets/Images/cursor_01.png'),_auto]">
    
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
            <div onclick="window.location.href='../../Login_Pages/logout.php'" class="yellowButton yellowButtonHeader hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer]">
                <div class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                    <div class="font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] text-black font-thin text-sm max-md:text-[8px]">
                        <a href="../../Login_Pages/logout.php">Log Out</a>
                    </div>
                    <div class="absolute w-[105%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md transition-colors duration-500 -z-1 top-[1%] left-0"></div>
                </div>
            </div>
        </div>
    </nav>

    <!-- THUMBNAIL SECTION -->
    <div class="relative w-screen h-[60vh] mt-[10vh] overflow-hidden">
        <div class="absolute flex items-center justify-start h-full w-full z-10">

            <div class="flex flex-col items-start justify-center p-[10%] max-w-[50vw] max-md:max-w-full max-md:p-[5%] ">
                
                <h1 class="thumbnail thumbnailTitle text-white text-4xl font-black drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] font-['Press_Start_2P'] max-md:text-2xl">Security</h1>
                <h1 class="thumbnail thumbnailTitle text-white text-4xl font-black drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] font-['Press_Start_2P'] max-md:text-2xl">Misconfiguration</h1>
                
                <div class="thumbnail thumbnailDescription text-white text-md mt-[10%] font-semibold drop-shadow-[2px_2px_0px_black] drop-shadow-[-2px_-2px_0px_black] max-md:text-xs">Security misconfiguration is a common vulnerability that occurs when an application, server, database, or cloud service is improperly set up, leaving security gaps that attackers can exploit. These misconfigurations can stem from default settings, unnecessary features, weak permissions, unpatched systems, or exposing sensitive information.</div>
                <div id="getStartedButton" class="yellowButton yellowButtonThumbnail hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] ">
                    <div class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 rounded-md mt-10 border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                        
                        <div class=" font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] font-thin text-xs">
                            Get Started
                        </div>
                        <div class="absolute w-[104%] h-[120%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md  transition-colors duration-500 -z-1 top-[1%] left-0"></div>
                        
                    </div>
                </div>

            </div>

        </div>
        <img src="../../Assets/Images/CoverImageMisconfig.gif" class="absolute object-cover w-full h-full opacity-[0.6]" alt="">


    </div>

    <!-- DROPDOWN SECTION -->
    <div id="dropdownSection" class="w-full h-auto mt-[8vh] px-[10vw]">
        <div class="flex flex-col items-center justify-center w-full h-full border-3 border-[#3E4B5E] rounded-md p-[2%]">

            <!-- DROPDOWN 1 -->
            <details class="relative group w-full bg-[#020617] shadow-md rounded-lg p-4 hover:bg-[#0F172A] transition-colors duration-500">
    
                <summary class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] cursor-pointer text-lg font-semibold flex justify-between items-center rounded-md p-2">
                    <div class="flex items-center justify-center ['Press_Start_2P'] text-white font-black text-3xl border-3 border-[#3E4B5E] rounded-full w-16 h-16 max-md:w-12 max-md:h-12 max-md:text-sm p-4 mx-2">
                        1
                    </div>

                    <div class="font-['Press_Start_2P'] text-xl font-black text-white max-md:text-sm"> 
                        Vulnerable Misconfigured Page
                    </div>

                    <!-- DROPDOWN ARROW -->
                    <span class="text-white transition-transform duration-300 group-open:rotate-0 origin-center rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="48" viewBox="0 0 25 24" fill="none" 
                            class="transition-transform duration-400 origin-center">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 16H5.5V14H7.5V12H9.5V10H11.5V8H13.5V10H15.5V12H17.5V14H19.5V16H17.5V14H15.5V12H13.5V10H11.5V12H9.5V14H7.5V16Z" 
                                fill="#94A3B8"></path>
                        </svg>
                    </span>

                </summary>
                <div id="content1" class="p-10 flex items-center justify-start h-full  transition-all duration-500">
                    
                    <div class="flex flex-row items-center justify-between space-x-10 py-10 ">
                        
                        <div class="text-gray-400 max-w-[50%] p-5 text-xl max-sm:text-xs"><span class="font-bold text-blue-300">Security Misconfiguration</span> is a critical vulnerability that occurs when a system, application, or network is improperly configured, leaving it exposed to potential attacks. It typically arises due to default settings, incomplete configurations, unnecessary features, excessive permissions, or a failure to apply security best practices. Misconfigurations can exist in various layers, including web servers, databases, cloud services, APIs, and operating systems.</div>

                        <!-- BUTTON -->
                        
                        <div onclick="window.location.href='vulnerable_login.php'" class="yellowButton yellowButtonVulnerable  hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] h-full py-10 w-full relative z-[100] max-w-[50%]">

                            <div class="z-[100] flex flex-row h-full w-full items-center justify-center px-3 py-2">
                                
                                <img src="../../Assets/Images/playButton.png" class="z-[100] w-[20%] m-1 h-auto drop-shadow-[2px_2px_0px_rgb(221,170,16)]" alt="Image 1">
                                
                                <div class="flex flex-col items-center justify-center">
                                    <div class="z-[100] font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] font-black text-2xl max-md:text-sm max-sm:text-xs">
                                        Simulate
                                    </div>
                                    <div class="z-[100] font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] font-black text-2xl max-md:text-sm max-sm:text-xs">
                                        Vulnerability
                                    </div>
                                </div>
                                
                            </div>
                            <div class="absolute w-full h-full  bg-yellow-300 hover:bg-yellow-600 border-3 border-[rgb(221,170,16)] rounded-xl  transition-colors duration-500 z-[1] top-0 left-0"></div>
                            <div class="absolute w-[100%] h-[100%] bg-[rgb(221,170,16)] hover:bg-yellow-600 transition-colors duration-500 rounded-xl z-[0] top-[2%] left-[0.7%]"></div>

                        </div>

                        
                        
                        
                    </div>

                    <!-- <p class="mt-2 text-gray-600">This is the hidden content that appears when you click.</p>
                    <button onclick="window.location.href='vulnerable_login.php'">vuln</button> -->
                </div>

                
                <!-- GIF -->
                <img src="../../Assets/Images/terminalAndRobo.gif" class="-mt-25" alt="giff">


                <div class="bulletPoints p-15">

                    <p class="bulletPointTitle text-[#93C5FD] text-2xl font-bold mb-10">The application might be vulnerable if the application is:</p>
                    
                    <div class="flex flex-row items-start justify-start space-x-5 mb-[30px]">
                        <img class="diamond w-auto" src="../../Assets//Images/diamond.png" alt="">

                        <p class="text-gray-400  text-xl">Missing appropriate security hardening across any part of the application stack or improperly configured permissions on cloud services.</p>

                    </div>

                    <div class="flex flex-row items-start justify-start space-x-5 mb-[30px]">
                        <img class="diamond w-auto" src="../../Assets//Images/diamond.png" alt="">

                        <p class="text-gray-400  text-xl font-['Lexend']">Unnecessary features are enabled or installed (e.g., unnecessary ports, services, pages, accounts, or privileges).</p>

                    </div>

                    <div class="flex flex-row items-start justify-start space-x-5 mb-[30px]">
                        <img class="diamond w-auto" src="../../Assets//Images/diamond.png" alt="">

                        <p class="text-gray-400  text-xl">Default accounts and their passwords are still enabled and unchanged.</p>

                    </div>

                    <div class="flex flex-row items-start justify-start space-x-5 mb-[30px]">
                        <img class="diamond w-auto" src="../../Assets//Images/diamond.png" alt="">

                        <p class="text-gray-400  text-xl">Error handling reveals stack traces or other overly informative error messages to users.</p>

                    </div>

                    <div class="flex flex-row items-start justify-start space-x-5 mb-[30px]">
                        <img class="diamond w-auto" src="../../Assets//Images/diamond.png" alt="">

                        <p class="text-gray-400  text-xl">For upgraded systems, the latest security features are disabled or not configured securely.</p>

                    </div>

                    <div class="flex flex-row items-start justify-start space-x-5 mb-[30px]">
                        <img class="diamond w-auto" src="../../Assets//Images/diamond.png" alt="">

                        <p class="text-gray-400  text-xl">The security settings in the application servers, application frameworks (e.g., Struts, Spring, ASP.NET), libraries, databases, etc., are not set to secure values.</p>

                    </div>

                    <div class="flex flex-row items-start justify-start space-x-5 mb-[30px]">
                        <img class="diamond w-auto" src="../../Assets//Images/diamond.png" alt="">

                        <p class="text-gray-400  text-xl">The server does not send security headers or directives, or they are not set to secure values.</p>

                    </div>

            




                </div>

                
            </details>

            <!-- DROPDOWN 2 -->
            <details class="relative group w-full bg-[#020617] shadow-md rounded-lg p-4 hover:bg-[#0F172A] transition-colors duration-500">
    
                <summary class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] cursor-pointer text-lg font-semibold flex justify-between items-center rounded-md p-2">
                    <div class="flex items-center justify-center ['Press_Start_2P'] text-white font-black text-3xl border-3 border-[#3E4B5E] rounded-full w-16 h-16 max-md:w-12 max-md:h-12 max-md:text-sm p-4 mx-2">
                        2
                    </div>

                    <div class="font-['Press_Start_2P'] text-xl font-black text-white max-md:text-sm"> 
                        Prevention Measures
                    </div>

                    <!-- DROPDOWN ARROW -->
                    <span class="text-white transition-transform duration-300 group-open:rotate-0 origin-center rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="48" viewBox="0 0 25 24" fill="none" 
                            class="transition-transform duration-400 origin-center">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 16H5.5V14H7.5V12H9.5V10H11.5V8H13.5V10H15.5V12H17.5V14H19.5V16H17.5V14H15.5V12H13.5V10H11.5V12H9.5V14H7.5V16Z" 
                                fill="#94A3B8"></path>
                        </svg>
                    </span>

                </summary>

                
                <div id="content2" class="p-20 h-full overflow-hidden transition-all duration-500" >

                    
                    
                    <!-- WINDOW -->
                    <div class="windowPopup flex flex-col items-center justify-center bg-[#3E4B5E] rounded-md p-2">
                        
                        <div class="flex items-center justify-between w-full">

                            <p class="text-[#0F172A] font-bold text-2xl ml-2 py-2">Robust Session Management</p>
            
                            <div class="flex flex-row justify-end items-center gap-2 h-7 mb-2 w-auto">
                                
                                <div class="bg-[#0F172A] w-5 h-[4px]"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] w-5 h-5"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] rounded-full w-5 h-5"></div>
                                
                            </div>
                        </div>

                        <pre class="whitespace-pre-wrap flex items-center w-full h-full" >
                        
                        <code class=" rounded-md text-sm font-mono w-full h-full" >
// SECURE: Robust session management with multiple security layers
session_start();

// Regenerate session ID prevents session fixation attacks
// Old session data is deleted to prevent orphaned sessions
session_regenerate_id(true);

// Store only necessary non-sensitive information
// Add timeout tracking and IP binding for hijacking protection
$_SESSION['user_id'] = $users[$username]['id'];
$_SESSION['user_role'] = $users[$username]['role'];
$_SESSION['last_activity'] = time();
$_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
                        </code>
                        </pre>
                    </div>

                    
                    <!-- ROBO WITH DESC -->
                    <div class="flex flex-row items-start gap-2 justify-start mt-8 mb-20">


                        <img src="../../Assets/Images/robot.gif" class="h-16 w-auto" alt="">

                        <p class="preventionDescription mt-2 text-gray-600 italic">The improved code replaces basic session handling with comprehensive protection. Instead of storing complete user data (including passwords) in the session, it only stores necessary information like user ID and role. The code adds session_regenerate_id() to prevent session fixation attacks and implements timeout tracking and IP binding for added security against hijacking attempts.</p>


                    </div>


                    <!-- WINDOW -->
                    <div class="windowPopup flex flex-col items-center justify-center bg-[#3E4B5E] rounded-md p-2">
                        
                        <div class="flex items-center justify-between w-full">

                            <p class="text-[#0F172A] font-bold text-2xl ml-2 py-2">Preventing URL Parameter Vulnerabilities</p>
            
                            <div class="flex flex-row justify-end items-center gap-2 h-7 mb-2 w-auto">
                                
                                <div class="bg-[#0F172A] w-5 h-[4px]"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] w-5 h-5"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] rounded-full w-5 h-5"></div>
                                
                            </div>
                        </div>

                        <pre class="whitespace-pre-wrap flex items-center w-full h-full" >
                        
                        <code class=" rounded-md text-sm font-mono w-full h-full" >
// SECURE: POST method with CSRF protection
// Credentials not visible in URL or server logs
// CSRF token prevents cross-site request forgery attacks
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate token to ensure request originated from your form
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF attack detected");
    }
    
    // Sanitize username but preserve password for verification
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['password']; // Never sanitize before verification
}
                        </code>
                        </pre>
                    </div>

                    
                    <!-- ROBO WITH DESC -->
                    <div class="flex flex-row items-start gap-2 justify-start mt-8 mb-20">


                        <img src="../../Assets/Images/robot.gif" class="h-16 w-auto" alt="">

                        <p class="preventionDescription mt-2 text-gray-600 italic"> The code changes from using exposed GET parameters for authentication to more secure POST requests with CSRF protection. This prevents credentials from appearing in browser history, logs, or referrer headers. The implementation adds a CSRF token validation to protect against cross-site request forgery attacks and properly sanitizes the username input while preserving password integrity. </p>

                    </div>

                    <!-- WINDOW -->
                    <div class="windowPopup flex flex-col items-center justify-center bg-[#3E4B5E] rounded-md p-2">
                        
                        <div class="flex items-center justify-between w-full">

                            <p class="text-[#0F172A] font-bold text-2xl ml-2 py-2">Output Encoding</p>
            
                            <div class="flex flex-row justify-end items-center gap-2 h-7 mb-2 w-auto">
                                
                                <div class="bg-[#0F172A] w-5 h-[4px]"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] w-5 h-5"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] rounded-full w-5 h-5"></div>
                                
                            </div>
                        </div>

                        <pre class="whitespace-pre-wrap flex items-center w-full h-full" >
                        
                        <code class=" rounded-md text-sm font-mono w-full h-full" >
// SECURE: Proper HTML encoding prevents XSS by converting special characters
// ENT_QUOTES handles both single and double quotes for comprehensive protection
// UTF-8 ensures proper handling of international characters
echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8');
                        </code>
                        </pre>
                    </div>

                    
                    <!-- ROBO WITH DESC -->
                    <div class="flex flex-row items-start gap-2 justify-start mt-8 mb-20">


                        <img src="../../Assets/Images/robot.gif" class="h-16 w-auto" alt="">

                        <p class="preventionDescription mt-2 text-gray-600 italic"> The secure code implements htmlspecialchars() with ENT_QUOTES and UTF-8 encoding when outputting user data, replacing direct unencoded output. This prevents cross-site scripting (XSS) attacks by converting special characters that could be interpreted as HTML or JavaScript into their harmless HTML entity equivalents. </p>

                    </div>

                    <!-- WINDOW -->
                    <div class="windowPopup flex flex-col items-center justify-center bg-[#3E4B5E] rounded-md p-2">
                        
                        <div class="flex items-center justify-between w-full">

                            <p class="text-[#0F172A] font-bold text-2xl ml-2 py-2">Input Validation</p>
            
                            <div class="flex flex-row justify-end items-center gap-2 h-7 mb-2 w-auto">
                                
                                <div class="bg-[#0F172A] w-5 h-[4px]"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] w-5 h-5"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] rounded-full w-5 h-5"></div>
                                
                            </div>
                        </div>

                        <pre class="whitespace-pre-wrap flex items-center w-full h-full" >
                        
                        <code class=" rounded-md text-sm font-mono w-full h-full" >
// SECURE: Comprehensive input validation with specific rules
// Enforces length limits and character restrictions
// Prevents malformed input from entering the application
function validateUsername($username) {
    // Check length requirements to prevent buffer overflow attempts
    if (strlen($username) < 3 || strlen($username) > 20) {
        return false;
    }
    
    // Restrict to alphanumeric plus safe special characters
    // Prevents injection of dangerous characters
    if (!preg_match('/^[a-zA-Z0-9_.-]+$/', $username)) {
        return false;
    }
    
    return true;
}

// Apply validation and handle invalid input appropriately
$username = $_POST['username'] ?? '';
if (!validateUsername($username)) {
    $error = 'Invalid username format';
}
                        </code>
                        </pre>
                    </div>

                    
                    <!-- ROBO WITH DESC -->
                    <div class="flex flex-row items-start gap-2 justify-start mt-8 mb-20">


                        <img src="../../Assets/Images/robot.gif" class="h-16 w-auto" alt="">

                        <p class="preventionDescription mt-2 text-gray-600 italic"> The improved code adds comprehensive validation for user input rather than accepting any value. It creates a validateUsername() function that enforces specific rules including length requirements (3-20 characters) and character restrictions (alphanumeric plus safe special characters), preventing injection attacks and ensuring data integrity. </p>

                    </div>

                    <!-- WINDOW -->
                    <div class="windowPopup flex flex-col items-center justify-center bg-[#3E4B5E] rounded-md p-2">
                        
                        <div class="flex items-center justify-between w-full">

                            <p class="text-[#0F172A] font-bold text-2xl ml-2 py-2">HTTPS and Secure Cookies</p>
            
                            <div class="flex flex-row justify-end items-center gap-2 h-7 mb-2 w-auto">
                                
                                <div class="bg-[#0F172A] w-5 h-[4px]"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] w-5 h-5"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] rounded-full w-5 h-5"></div>
                                
                            </div>
                        </div>

                        <pre class="whitespace-pre-wrap flex items-center w-full h-full" >
                        
                          <code class=" rounded-md text-sm font-mono w-full h-full" >
// Force HTTPS to encrypt all traffic between client and server
// Prevents network sniffing and man-in-the-middle attacks
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}

// Configure session with security-focused cookie settings
// cookie_secure: HTTPS-only transmission prevents interception
// cookie_httponly: JavaScript cannot access cookies, blocking XSS cookie theft
// cookie_samesite: Controls cross-origin requests to prevent CSRF
session_start([
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
    'use_strict_mode' => true
]);
                          </code>
                        </pre>
                    </div>

                    
                    <!-- ROBO WITH DESC -->
                    <div class="flex flex-row items-start gap-2 justify-start mt-8 mb-20">


                        <img src="../../Assets/Images/robot.gif" class="h-16 w-auto" alt="">

                        <p class="preventionDescription mt-2 text-gray-600 italic"> This security measure forces HTTPS connections by redirecting HTTP requests and implements secure cookie settings for sessions. It enables cookie_secure to ensure cookies are only transmitted via HTTPS, cookie_httponly to prevent JavaScript access to cookies, and cookie_samesite to control cross-origin requests, collectively protecting against various cookie-based attacks. </p>

                    </div>

                </div>

                
            </details>



            <!-- DROPDOWN 3 -->

            <details id="dropdown3" class="relative group w-full bg-[#020617] shadow-md rounded-lg p-4 hover:bg-[#0F172A] transition-colors duration-500">
    
                <summary class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] cursor-pointer text-lg font-semibold flex justify-between items-center  rounded-md p-2">
                    <div class="flex items-center justify-center ['Press_Start_2P'] text-white font-black text-3xl border-3 border-[#3E4B5E] rounded-full w-16 h-16 max-md:w-12 max-md:h-12 max-md:text-sm p-4 mx-2">
                        3
                    </div>

                    <div class="font-['Press_Start_2P'] text-xl font-black text-white max-md:text-sm"> 
                        Securely Configured Page
                    </div>

                    <!-- DROPDOWN ARROW -->
                    <span class="text-white transition-transform duration-300 group-open:rotate-0 origin-center rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="48" viewBox="0 0 25 24" fill="none" 
                             class="transition-transform duration-400 origin-center">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 16H5.5V14H7.5V12H9.5V10H11.5V8H13.5V10H15.5V12H17.5V14H19.5V16H17.5V14H15.5V12H13.5V10H11.5V12H9.5V14H7.5V16Z" 
                                  fill="#94A3B8"></path>
                        </svg>
                    </span>
                    
                </summary>
                <div id="content3" class=" transition-all duration-500 p-20">
                    
                    <!-- SPEECH BUBBLE -->
                     <div class="relative h-25">

                        

                        <div class="absolute bottom-0 left-0 translate-y-1/2 translate-x-[50%] rotate-45 w-16 h-16  border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]"></div>
                        
                        <div class="absolute p-5 text-white font-['Press_Start_2P'] text-xl font-thin  left-0 w-full h-full border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">
                            
                            <p class="popupText popupText1 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">BEEP BEEP BOOP BOOP!</p>
                            <p class="popupText popupText2 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">Let's simulate the secure one now!</p>
                            
                        </div>
                         
                    </div>

                    <div class="flex items-center justify-between gap-12">

                        <!-- MASCOT -->
                        
                        <img src="../../Assets/Images/mascot.gif" class="max-w-[50%] w-100 h-auto" alt="mascot">

                        <!-- BUTTON -->

                        <div onclick="window.location.href='secure_login.php'" class="yellowButton yellowButtonSecure hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer]  h-full py-10 w-full relative z-[100] max-w-[50%]">

                            <div class="z-[100] flex flex-row h-full w-full items-center justify-center px-3 py-2">
                                
                                <img src="../../Assets/Images/playButton.png" class="z-[100] w-[20%] m-1 h-auto drop-shadow-[2px_2px_0px_rgb(221,170,16)]" alt="Image 1">
                                
                                <div class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] flex flex-col items-center justify-center">
                                    <div class="z-[100] font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] font-black text-2xl max-md:text-sm max-sm:text-xs">
                                        Simulate 
                                    </div>
                                    <div class="z-[100] font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] font-black text-2xl max-md:text-sm max-sm:text-xs">
                                        Secure Version
                                    </div>
                                </div>
                                
                            </div>
                            <div class="absolute w-full h-full  bg-yellow-300 hover:bg-yellow-600 border-3 border-[rgb(221,170,16)] rounded-xl  transition-colors duration-500 z-[1] top-0 left-0"></div>
                            <div class="absolute w-[100%] h-[100%] bg-[rgb(221,170,16)] hover:bg-yellow-600 transition-colors duration-500 rounded-xl z-[0] top-[2%] left-[0.7%]"></div>

                        </div>
                        

                    </div>

                </div>



                <!-- <marquee behavior="scroll" direction="left" scrollamount="10">
                    <img src="../../Assets/Images/Ronit-User1.JPG" class="w-40 h-40 inline-block mx-4" alt="Image 1">
                
                </marquee> -->
            </details>

        </div>
    </div>


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
                    <li><a href="#home" class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#home" class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="../../About Us/contact us.php" class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('../../Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">FAQs</a></li>
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

    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/gsap.min.js" integrity="sha512-f6bQMg6nkSRw/xfHw5BCbISe/dJjXrVGfz9BSDwhZtiErHwk7ifbmBEtF9vFW8UNIQPhV2uEFVyI/UHob9r7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/ScrollTrigger.min.js" integrity="sha512-AcqPGqrrAEtEwe+ADO5R8RbdFi7tuU7b/A2cJJH0Im0D18NRk5p5s4B3E5PMuO81KFw0ClN7J5SHVUJz7KOb0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../../Assets/Animations/vulnerabilityPageAnimation.js"></script>
</body>
</html>