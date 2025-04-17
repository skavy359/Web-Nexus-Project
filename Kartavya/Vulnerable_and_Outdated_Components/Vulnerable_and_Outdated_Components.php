<?php session_start();
$logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable Libraries</title>

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

<body class="bg-[#020617] font-['Lexend'] selection:text-yellow-400 cursor-[url('/Assets/Images/cursor_01.png'),_auto]">

    <!-- HEADER -->
    <nav class="fixed z-[999] top-0 left-0 h-[10vh] w-screen flex items-center justify-between p-4 bg-[#020617] border-b-2 border-[#3E4B5E] max-md:p-0">
        <div class="headerStuff flex items-center space-x-3 max-md:space-x-1">
            <img src="/Web-Nexus-Project/Assets/Images/logo.svg" alt="logo" class="w-12 max-md:w-8">
            <span class="text-2xl font-bold text-white font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] max-md:text-xs hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Web-Nexus</span>
        </div>

        <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
            <a href="/Web-Nexus-Project/Kavy/Home/Home-Page.html#vulnerabilities" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="/Web-Nexus-Project/Kavy/Home/Home-Page.php" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Home</a>
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

    <!-- THUMBNAIL SECTION -->
    <div class="relative w-screen h-[60vh] mt-[10vh] overflow-hidden">
        <div class="absolute flex items-center justify-start h-full w-full z-10">

            <div class="flex flex-col items-start justify-center p-[10%] max-w-[50vw] max-md:max-w-full max-md:p-[5%] ">

                <h1
                    class="thumbnail thumbnailTitle text-white text-4xl font-black drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] font-['Press_Start_2P'] max-md:text-2xl mt-5 mb-2">
                    Vulnerable &
                </h1>
                <h1
                    class="thumbnail thumbnailTitle text-white text-4xl font-black drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] font-['Press_Start_2P'] max-md:text-2xl mb-2">
                    Outdated
                </h1>
                <h1
                    class="thumbnail thumbnailTitle text-white text-4xl font-black drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] font-['Press_Start_2P'] max-md:text-2xl">
                    Components
                </h1>

                <div
                    class="thumbnail thumbnailDescription text-white text-md mt-[8%] font-semibold drop-shadow-[2px_2px_0px_black] drop-shadow-[-2px_-2px_0px_black] max-md:text-xs">
                    Outdated libraries and components present a pervasive security vulnerability in modern web
                    applications. These
                    components run with the same privileges as the application itself, potentially enabling complete
                    server takeover if
                    exploited. This risk is compounded by the widespread use of open-source libraries,
                    creating a vast attack surface that hackers actively target through automated scanning techniques.
                </div>
                <div
                    class="yellowButton yellowButtonThumbnail hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] ">
                    <div
                        class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 rounded-md mt-7 border-3 border-[rgb(221,170,16)] transition-colors duration-500">

                        <div id="getStartedButton"
                            class=" font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] font-thin text-xs">
                            Get Started
                        </div>
                        <div
                            class="absolute w-[104%] h-[120%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md  transition-colors duration-500 -z-1 top-[1%] left-0">
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <img src="/Web-Nexus-Project/Assets/Images/VulnerableComponents.gif" class="absolute object-cover w-full h-full opacity-[0.6]"
            alt="">


    </div>

    <!-- DROPDOWN SECTION -->
    <div id="dropdownSection" class="w-full h-auto mt-[8vh] px-[10vw]">
        <div
            class="flex flex-col items-center justify-center w-full h-full border-3 border-[#3E4B5E] rounded-md p-[2%]">

            <!-- DROPDOWN 1 -->
            <details
                class="relative group w-full bg-[#020617] shadow-md rounded-lg p-4 hover:bg-[#0F172A] transition-colors duration-500">

                <summary
                    class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] cursor-pointer text-lg font-semibold flex justify-between items-center rounded-md p-2">
                    <div
                        class="flex items-center justify-center ['Press_Start_2P'] text-white font-black text-3xl border-3 border-[#3E4B5E] rounded-full w-16 h-16 max-md:w-12 max-md:h-12 max-md:text-sm p-4 mx-2">
                        1
                    </div>

                    <div class="font-['Press_Start_2P'] text-xl font-black text-white max-md:text-sm">
                        Vulnerable Libraries Page
                    </div>

                    <!-- DROPDOWN ARROW -->
                    <span
                        class="text-white transition-transform duration-300 group-open:rotate-0 origin-center rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="48" viewBox="0 0 25 24" fill="none"
                            class="transition-transform duration-400 origin-center">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.5 16H5.5V14H7.5V12H9.5V10H11.5V8H13.5V10H15.5V12H17.5V14H19.5V16H17.5V14H15.5V12H13.5V10H11.5V12H9.5V14H7.5V16Z"
                                fill="#94A3B8"></path>
                        </svg>
                    </span>

                </summary>
                <div id="content1" class="p-10 flex items-center justify-start h-full  transition-all duration-500">

                    <div class="flex flex-row items-center justify-between space-x-10 py-10 ">

                        <div class="text-gray-400 max-w-[50%] p-5 text-xl max-sm:text-xs"><span
                                class="font-bold text-blue-300">Vulnerable libraries</span> represent a significant
                            security risk that occurs when an application uses libraries,
                            frameworks, or modules with known vulnerabilities. This exposure typically happens due to
                            using unpatched dependencies,
                            obsolete software, or failing to regularly update components. Applications with vulnerable
                            components may inherit
                            security flaws that can be easily discovered and exploited by attackers using automated
                            scanning tools.</div>

                        <!-- BUTTON -->

                        <div onclick="window.location.href='vulnerable_page_Vulnerable_and_Outdated_Components.php'"
                            class="yellowButton yellowButtonVulnerable  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] h-full py-10 w-full relative z-[100] max-w-[50%]">

                            <div class="z-[100] flex flex-row h-full w-full items-center justify-center px-3 py-2">

                                <img src="/Web-Nexus-Project/Assets/Images/playButton.png"
                                    class="z-[100] w-[20%] m-1 h-auto drop-shadow-[2px_2px_0px_rgb(221,170,16)]"
                                    alt="Image 1">

                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="z-[100] font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] font-black text-2xl max-md:text-sm max-sm:text-xs">
                                        Simulate
                                    </div>
                                    <div
                                        class="z-[100] font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] font-black text-2xl max-md:text-sm max-sm:text-xs">
                                        Vulnerability
                                    </div>
                                </div>

                            </div>
                            <div
                                class="absolute w-full h-full  bg-yellow-300 hover:bg-yellow-600 border-3 border-[rgb(221,170,16)] rounded-xl  transition-colors duration-500 z-[1] top-0 left-0">
                            </div>
                            <div
                                class="absolute w-[100%] h-[100%] bg-[rgb(221,170,16)] hover:bg-yellow-600 transition-colors duration-500 rounded-xl z-[0] top-[2%] left-[0.7%]">
                            </div>

                        </div>




                    </div>

                    <!-- <p class="mt-2 text-gray-600">This is the hidden content that appears when you click.</p>
                    <button onclick="window.location.href='vulnerable_login.php'">vuln</button> -->
                </div>


                <!-- GIF -->
                <img src="/Web-Nexus-Project/Assets/Images/terminalAndRobo.gif" class="-mt-25" alt="giff">


                <div class="bulletPoints p-15">

                    <p class="bulletPointTitle text-[#93C5FD] text-2xl font-bold mb-10">The application might be
                        vulnerable if the application is:</p>

                    <div class="flex flex-row items-start justify-start space-x-5 mb-[30px]">
                        <img class="diamond w-auto" src="/Web-Nexus-Project/Assets//Images/diamond.png" alt="">

                        <p class="text-gray-400  text-xl">Using components/libraries with known vulnerabilities due to
                            lack of regular updates or patch management.</p>

                    </div>

                    <div class="flex flex-row items-start justify-start space-x-5 mb-[30px]">
                        <img class="diamond w-auto" src="/Web-Nexus-Project/Assets//Images/diamond.png" alt="">

                        <p class="text-gray-400  text-xl font-['Lexend']">Running software that is unsupported or has
                            reached end-of-life without security updates.</p>

                    </div>

                    <div class="flex flex-row items-start justify-start space-x-5 mb-[30px]">
                        <img class="diamond w-auto" src="/Web-Nexus-Project/Assets//Images/diamond.png" alt="">

                        <p class="text-gray-400  text-xl">Not regularly scanning for vulnerabilities or subscribing to
                            security bulletins related to components.</p>

                    </div>

                    <div class="flex flex-row items-start justify-start space-x-5 mb-[30px]">
                        <img class="diamond w-auto" src="/Web-Nexus-Project/Assets//Images/diamond.png" alt="">

                        <p class="text-gray-400  text-xl">Failing to fix or upgrade the underlying platform, frameworks,
                            and dependencies in a timely fashion.</p>

                    </div>

                    <div class="flex flex-row items-start justify-start space-x-5 mb-[30px]">
                        <img class="diamond w-auto" src="/Web-Nexus-Project/Assets//Images/diamond.png" alt="">

                        <p class="text-gray-400  text-xl">Using components from unofficial sources or with altered code
                            without verification.</p>

                    </div>

                    <div class="flex flex-row items-start justify-start space-x-5 mb-[30px]">
                        <img class="diamond w-auto" src="/Web-Nexus-Project/Assets//Images/diamond.png" alt="">

                        <p class="text-gray-400  text-xl">Not maintaining a proper inventory of client-side and
                            server-side components and their dependencies.</p>

                    </div>

                    <div class="flex flex-row items-start justify-start space-x-5 mb-[30px]">
                        <img class="diamond w-auto" src="/Web-Nexus-Project/Assets//Images/diamond.png" alt="">

                        <p class="text-gray-400  text-xl">Not securing component configurations by using default
                            settings or with excessive permissions.</p>

                    </div>






                </div>


            </details>

            <!-- DROPDOWN 2 -->
            <details
                class="relative group w-full bg-[#020617] shadow-md rounded-lg p-4 hover:bg-[#0F172A] transition-colors duration-500">

                <summary
                    class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] cursor-pointer text-lg font-semibold flex justify-between items-center rounded-md p-2">
                    <div
                        class="flex items-center justify-center ['Press_Start_2P'] text-white font-black text-3xl border-3 border-[#3E4B5E] rounded-full w-16 h-16 max-md:w-12 max-md:h-12 max-md:text-sm p-4 mx-2">
                        2
                    </div>

                    <div class="font-['Press_Start_2P'] text-xl font-black text-white max-md:text-sm">
                        Prevention Measures
                    </div>

                    <!-- DROPDOWN ARROW -->
                    <span
                        class="text-white transition-transform duration-300 group-open:rotate-0 origin-center rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="48" viewBox="0 0 25 24" fill="none"
                            class="transition-transform duration-400 origin-center">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.5 16H5.5V14H7.5V12H9.5V10H11.5V8H13.5V10H15.5V12H17.5V14H19.5V16H17.5V14H15.5V12H13.5V10H11.5V12H9.5V14H7.5V16Z"
                                fill="#94A3B8"></path>
                        </svg>
                    </span>

                </summary>


                <div id="content2" class="p-20 h-full overflow-hidden transition-all duration-500">



                    <!-- WINDOW -->
                    <div class="windowPopup flex flex-col items-center justify-center bg-[#3E4B5E] rounded-md p-2">

                        <div class="flex items-center justify-between w-full">

                            <p class="text-[#0F172A] font-bold text-2xl ml-2 py-2">Dependency Version Pinning</p>

                            <div class="flex flex-row justify-end items-center gap-2 h-7 mb-2 w-auto">

                                <div class="bg-[#0F172A] w-5 h-[4px]"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] w-5 h-5"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] rounded-full w-5 h-5"></div>

                            </div>
                        </div>

                        <pre class="whitespace-pre-wrap flex items-center w-full h-full">

                        <code class=" rounded-md text-sm font-mono w-full h-full" >
// SECURE: Use specific versioning to prevent automatic upgrades to vulnerable versions
// Composer.json example with explicit secure versions
{
    "require": {
        "symfony/http-foundation": "5.4.10",
        "guzzlehttp/guzzle": "7.4.5",
        // Always specify exact versions or minimum secure versions
        "laravel/framework": "^8.83.27"
    },
    // Prevent installing packages with known vulnerabilities
    "allow-plugins": {
        "symfony/thanks": false
    }
}
                        </code>
                        </pre>
                    </div>


                    <!-- ROBO WITH DESC -->
                    <div class="flex flex-row items-start gap-2 justify-start mt-8 mb-20">


                        <img src="/Web-Nexus-Project/Assets/Images/robot.gif" class="h-16 w-auto" alt="">

                        <p class="preventionDescription mt-2 text-gray-600 italic">This security practice implements
                            explicit version pinning for dependencies, preventing automatic updates to potentially
                            vulnerable versions. By specifying exact secure versions or minimum patched versions, the
                            system maintains a stable,
                            secure dependency tree and reduces risk of introducing known vulnerabilities through package
                            updates.
                        </p>


                    </div>


                    <!-- WINDOW -->
                    <div class="windowPopup flex flex-col items-center justify-center bg-[#3E4B5E] rounded-md p-2">

                        <div class="flex items-center justify-between w-full">

                            <p class="text-[#0F172A] font-bold text-2xl ml-2 py-2">Dependency Scanning Implementation
                            </p>

                            <div class="flex flex-row justify-end items-center gap-2 h-7 mb-2 w-auto">

                                <div class="bg-[#0F172A] w-5 h-[4px]"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] w-5 h-5"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] rounded-full w-5 h-5"></div>

                            </div>
                        </div>

                        <pre class="whitespace-pre-wrap flex items-center w-full h-full">

                        <code class=" rounded-md text-sm font-mono w-full h-full" >
// SECURE: Automated scanning for known vulnerabilities in dependencies
// Pre-commit hook for dependency security scanning

#!/bin/bash
# Pre-commit hook to check dependencies for vulnerabilities

echo "Scanning dependencies for security vulnerabilities..."
# Run composer audit to check for vulnerabilities
composer audit

# Exit with error if vulnerabilities found
if [ $? -ne 0 ]; then
    echo "⚠️ Security vulnerabilities detected in dependencies!"
    echo "Run 'composer audit' for details and update packages before committing."
    exit 1
fi

echo "✅ No known vulnerabilities detected in dependencies."
exit 0
                        </code>
                        </pre>
                    </div>


                    <!-- ROBO WITH DESC -->
                    <div class="flex flex-row items-start gap-2 justify-start mt-8 mb-20">


                        <img src="/Web-Nexus-Project/Assets/Images/robot.gif" class="h-16 w-auto" alt="">

                        <p class="preventionDescription mt-2 text-gray-600 italic">This preventive measure implements
                            automated dependency scanning that runs before each code commit. The script checks
                            all installed packages against vulnerability databases, preventing the introduction of
                            known-vulnerable dependencies
                            into the codebase and ensuring early detection of security issues without relying on manual
                            verification.</p>

                    </div>

                    <!-- WINDOW -->
                    <div class="windowPopup flex flex-col items-center justify-center bg-[#3E4B5E] rounded-md p-2">

                        <div class="flex items-center justify-between w-full">

                            <p class="text-[#0F172A] font-bold text-2xl ml-2 py-2">Runtime Dependency Validation</p>

                            <div class="flex flex-row justify-end items-center gap-2 h-7 mb-2 w-auto">

                                <div class="bg-[#0F172A] w-5 h-[4px]"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] w-5 h-5"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] rounded-full w-5 h-5"></div>

                            </div>
                        </div>

                        <pre class="whitespace-pre-wrap flex items-center w-full h-full">

                        <code class=" rounded-md text-sm font-mono w-full h-full" >
// SECURE: Runtime validation of critical library integrity
// Validates library checksums against known-good values before use

function validateLibraryIntegrity($libraryPath) {
    // Hash map of known-good checksums for critical libraries
    $trustedChecksums = [
        'jquery.min.js' => 'dc5e7f18c8d36ac1d3d4753a87c98d0a',
        'bootstrap.min.js' => '0a15b4ee9a188952c4acf51b1f2afcbb',
        'react.production.min.js' => '83324355de97f5c43b8ae6839d93a14f'
    ];
    
    $fileName = basename($libraryPath);
    
    // If library is critical, verify its integrity
    if (array_key_exists($fileName, $trustedChecksums)) {
        $fileHash = md5_file($libraryPath);
        
        if ($fileHash !== $trustedChecksums[$fileName]) {
            error_log("Security Alert: Library integrity check failed for {$fileName}");
            return false;
        }
    }
    
    return true;
}
                        </code>
                        </pre>
                    </div>


                    <!-- ROBO WITH DESC -->
                    <div class="flex flex-row items-start gap-2 justify-start mt-8 mb-20">


                        <img src="/Web-Nexus-Project/Assets/Images/robot.gif" class="h-16 w-auto" alt="">

                        <p class="preventionDescription mt-2 text-gray-600 italic"> This security mechanism performs
                            runtime validation of critical JavaScript libraries by checking file integrity against
                            known-good checksums. It protects against supply chain attacks or tampered library files by
                            detecting unauthorized
                            modifications to external dependencies before they execute, preventing the exploitation of
                            compromised libraries. </p>

                    </div>

                    <!-- WINDOW -->
                    <div class="windowPopup flex flex-col items-center justify-center bg-[#3E4B5E] rounded-md p-2">

                        <div class="flex items-center justify-between w-full">

                            <p class="text-[#0F172A] font-bold text-2xl ml-2 py-2">Subresource Integrity Implementation
                            </p>

                            <div class="flex flex-row justify-end items-center gap-2 h-7 mb-2 w-auto">

                                <div class="bg-[#0F172A] w-5 h-[4px]"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] w-5 h-5"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] rounded-full w-5 h-5"></div>

                            </div>
                        </div>

                        <pre class="whitespace-pre-wrap flex items-center w-full h-full">

                        <code class=" rounded-md text-sm font-mono w-full h-full" >
// SECURE: Implement Subresource Integrity (SRI) for external libraries
// Ensures third-party resources haven't been tampered with

function generateIntegrityTag($libraryUrl, $expectedHash) {
    return "<script src=\"{$libraryUrl}\" 
        integrity=\"sha384-{$expectedHash}\" 
        crossorigin=\"anonymous\"></script>";
}

// Usage for including external dependencies with integrity verification
echo generateIntegrityTag(
    'https://cdn.example.com/jquery-3.6.0.min.js',
    'xBj4lYfFtcxmklOEZwdO3wyfj8e9zzzzBV+GOIYo1U/MLuOoG9zEXZ6XaaWHjISx'
);
                        </code>
                        </pre>
                    </div>


                    <!-- ROBO WITH DESC -->
                    <div class="flex flex-row items-start gap-2 justify-start mt-8 mb-20">


                        <img src="/Web-Nexus-Project/Assets/Images/robot.gif" class="h-16 w-auto" alt="">

                        <p class="preventionDescription mt-2 text-gray-600 italic"> This code implements Subresource
                            Integrity (SRI) for external JavaScript libraries, which verifies that resources loaded
                            from CDNs or external sources match their expected cryptographic hash. This prevents the
                            execution of manipulated
                            scripts even if the CDN is compromised, protecting against supply chain attacks by ensuring
                            only the exact expected
                            library version is executed.</p>

                    </div>

                    <!-- WINDOW -->
                    <div class="windowPopup flex flex-col items-center justify-center bg-[#3E4B5E] rounded-md p-2">

                        <div class="flex items-center justify-between w-full">

                            <p class="text-[#0F172A] font-bold text-2xl ml-2 py-2">Library Sandboxing</p>

                            <div class="flex flex-row justify-end items-center gap-2 h-7 mb-2 w-auto">

                                <div class="bg-[#0F172A] w-5 h-[4px]"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] w-5 h-5"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] rounded-full w-5 h-5"></div>

                            </div>
                        </div>

                        <pre class="whitespace-pre-wrap flex items-center w-full h-full">

                        <code class=" rounded-md text-sm font-mono w-full h-full" >
// SECURE: Sandbox potentially risky third-party library execution
// Isolates library execution context to prevent privilege escalation

class LibrarySandbox {
    private $allowedMethods = ['parse', 'transform', 'calculate'];
    private $libraryInstance;
    
    public function __construct($libraryClass) {
        // Initialize the third-party library in restricted context
        $this->libraryInstance = new $libraryClass();
    }
    
    public function execute($methodName, $parameters) {
        // Verify method is in allowlist before execution
        if (!in_array($methodName, $this->allowedMethods)) {
            throw new SecurityException("Method {$methodName} is not allowed in sandbox");
        }
        
        // Validate input parameters before passing to library
        $sanitizedParams = $this->sanitizeParameters($parameters);
        
        // Execute in try-catch to contain potential errors
        try {
            return call_user_func_array(
                [$this->libraryInstance, $methodName],
                $sanitizedParams
            );
        } catch (Exception $e) {
            error_log("Library execution error: " . $e->getMessage());
            return null;
        }
    }
    
    private function sanitizeParameters($params) {
        // Implementation of parameter validation logic
        return array_map('filter_var', $params, array_fill(0, count($params), FILTER_SANITIZE_STRING));
    }
}
                        </code>
                        </pre>
                    </div>


                    <!-- ROBO WITH DESC -->
                    <div class="flex flex-row items-start gap-2 justify-start mt-8 mb-20">


                        <img src="/Web-Nexus-Project/Assets/Images/robot.gif" class="h-16 w-auto" alt="">

                        <p class="preventionDescription mt-2 text-gray-600 italic"> This security pattern implements a
                            sandboxing mechanism for third-party libraries that restricts their execution context
                            and capabilities. By creating a wrapper that limits available methods, validates inputs, and
                            contains errors, the system
                            prevents potentially vulnerable libraries from accessing sensitive resources or executing
                            unintended operations,
                            significantly reducing the impact of library vulnerabilities. </p>

                    </div>

                </div>


            </details>



            <!-- DROPDOWN 3 -->

            <details id="dropdown3"
                class="relative group w-full bg-[#020617] shadow-md rounded-lg p-4 hover:bg-[#0F172A] transition-colors duration-500">

                <summary
                    class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] cursor-pointer text-lg font-semibold flex justify-between items-center  rounded-md p-2">
                    <div
                        class="flex items-center justify-center ['Press_Start_2P'] text-white font-black text-3xl border-3 border-[#3E4B5E] rounded-full w-16 h-16 max-md:w-12 max-md:h-12 max-md:text-sm p-4 mx-2">
                        3
                    </div>

                    <div class="font-['Press_Start_2P'] text-xl font-black text-white max-md:text-sm">
                        Vulnerable Libraries Simulation
                    </div>

                    <!-- DROPDOWN ARROW -->
                    <span
                        class="text-white transition-transform duration-300 group-open:rotate-0 origin-center rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="48" viewBox="0 0 25 24" fill="none"
                            class="transition-transform duration-400 origin-center">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.5 16H5.5V14H7.5V12H9.5V10H11.5V8H13.5V10H15.5V12H17.5V14H19.5V16H17.5V14H15.5V12H13.5V10H11.5V12H9.5V14H7.5V16Z"
                                fill="#94A3B8"></path>
                        </svg>
                    </span>

                </summary>
                <div id="content3" class=" transition-all duration-500 p-20">

                    <!-- SPEECH BUBBLE -->
                    <div class="relative h-25">



                        <div
                            class="absolute bottom-0 left-0 translate-y-1/2 translate-x-[50%] rotate-45 w-16 h-16  border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">
                        </div>

                        <div
                            class="absolute p-5 text-white font-['Press_Start_2P'] text-xl font-thin  left-0 w-full h-full border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">

                            <p class="popupText popupText1 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">BEEP BEEP
                                BOOP BOOP!</p>
                            <p class="popupText popupText2 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">Let's
                                simulate the secure one now!</p>

                        </div>

                    </div>

                    <div class="flex items-center justify-between gap-12">

                        <!-- MASCOT -->

                        <img src="/Web-Nexus-Project/Assets/Images/mascot.gif" class="max-w-[50%] w-100 h-auto" alt="mascot">

                        <!-- BUTTON -->

                        <div onclick="window.location.href='secure_page_Vulnerable_and_Outdated_Components.php'"
                            class="yellowButton yellowButtonSecure hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]  h-full py-10 w-full relative z-[100] max-w-[50%]">

                            <div class="z-[100] flex flex-row h-full w-full items-center justify-center px-3 py-2">

                                <img src="/Web-Nexus-Project/Assets/Images/playButton.png"
                                    class="z-[100] w-[20%] m-1 h-auto drop-shadow-[2px_2px_0px_rgb(221,170,16)]"
                                    alt="Image 1">

                                <div
                                    class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] flex flex-col items-center justify-center">
                                    <div
                                        class="z-[100] font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] font-black text-2xl max-md:text-sm max-sm:text-xs">
                                        Simulate
                                    </div>
                                    <div
                                        class="z-[100] font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] font-black text-2xl max-md:text-sm max-sm:text-xs">
                                        Secure Version
                                    </div>
                                </div>

                            </div>
                            <div
                                class="absolute w-full h-full  bg-yellow-300 hover:bg-yellow-600 border-3 border-[rgb(221,170,16)] rounded-xl  transition-colors duration-500 z-[1] top-0 left-0">
                            </div>
                            <div
                                class="absolute w-[100%] h-[100%] bg-[rgb(221,170,16)] hover:bg-yellow-600 transition-colors duration-500 rounded-xl z-[0] top-[2%] left-[0.7%]">
                            </div>

                        </div>


                    </div>

                </div>



                <!-- <marquee behavior="scroll" direction="left" scrollamount="10">
                    <img src="/Web-Nexus-Project/Assets/Images/Ronit-User1.JPG" class="w-40 h-40 inline-block mx-4" alt="Image 1">
                
                </marquee> -->
            </details>

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
                        <img src="/Web-Nexus-Project/Assets/Images/github.png" alt="Github" class="w-8">
                    </a>
                    <a href="#"
                        class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Web-Nexus-Project/Assets/Images/LinkedIn.jpg" alt="Linkedin" class="w-8">
                    </a>
                    <a href="#"
                        class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
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
    <script src="/Web-Nexus-Project/Malay/Animations/vulnerabilityPageAnimation.js"></script>

</body>

</html>