<?php session_start();
$logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-Nexus Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/night-owl.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            hljs.highlightAll();
        });
    </script>
</head>

<body class="bg-[#020617] font-['Lexend'] selection:text-yellow-400 cursor-[url('Assets/Images/cursor_01.png'),_auto]">
    <!-- HEADER -->
    <nav class="fixed z-[999] top-0 left-0 h-[10vh] w-screen flex items-center justify-between p-4 bg-[#020617] border-b-2 border-[#3E4B5E] max-md:p-0">
        <div class="headerStuff flex items-center space-x-3 max-md:space-x-1">
            <img src="Assets/Images/logo.svg" alt="logo" class="w-12 max-md:w-8">
            <span class="text-2xl font-bold text-white font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] max-md:text-xs hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer]">Web-Nexus</span>
        </div>

        <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
            <a href="index.php#vulnerabilities" class="headerStuff hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="index.php" class="headerStuff hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Home</a>
            <a href="About Us/contact us.php" class="headerStuff hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
        </div>

        <div class="hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
            <div class="yellowButton yellowButtonHeader hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                <div class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                    <div class="font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] text-black font-thin text-sm max-md:text-[8px]">
                        <?php if ($logged_in): ?>
                            <span onclick="event.stopPropagation(); window.location.href='Login_Pages/logout.php'">Log Out</span>
                        <?php else: ?>
                            <span onclick="event.stopPropagation(); window.location.href='Login_Pages/login_page.php'">Log In</span>
                        <?php endif; ?>
                    </div>
                <div class="absolute w-[105%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md transition-colors duration-500 -z-1 top-[1%] left-0"></div>
            </div>
        </div>
</nav>

    <!-- Introduction Section -->
    <section id="home" class="h-screen flex items-center justify-center flex-col bg-[#020617] font-['Press_Start_2P'] text-center px-6">
        <img src="Assets/Images/lake_side.gif" alt="CoverImageHome" class="absolute h-full w-full opacity-[0.5] object-cover">
        <div class="absolute w-full h-full flex flex-col items-center justify-center">
            <h1 class="heading text-4xl md:text-6xl font-extrabold text-white drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] my-4">Learn and Master<br>Security Tools</h1>
            <p class="heading mt-4 text-lg md:text-xl font-['Lexend'] font-bold text-gray-200 max-w-2xl drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black]">Explore the OWASP Top 10 Vulnerabilities, 
            exploit them in real time, and secure your applications.
            </p>
            <div class="mt-6 space-x-4 flex">
                <div class="hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
                    <div onclick="window.location.href='index.php#vulnerabilities'" class="yellowButton yellowButtonHeader hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                        <div class="relative bg-yellow-300 hover:bg-yellow-600 px-3  py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                            <div class="font-['Press_Start_2P'] p-1 drop-shadow-[2px_2px_0px_rgb(221,170,16)] text-black font-thin text-sm max-md:text-[8px]">
                                <a href="#vulnerabilities" class="hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer]">Get Started</a>
                            </div>
                            <div class="absolute w-[105%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md  transition-colors duration-500 -z-1 top-[1%] left-0"></div>
                        </div>
                    </div>
                </div>
                <div class="hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
                    <div onclick="window.location.href='About Us/contact us.php'" class="yellowButton yellowButtonHeader hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                        <div class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                            <div class="font-['Press_Start_2P'] p-1 drop-shadow-[2px_2px_0px_rgb(221,170,16)] text-black font-thin text-sm max-md:text-[8px]">
                                <a href="About Us/contact us.php" class="hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer]">Learn More</a>
                            </div>
                            <div class="absolute w-[105%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md  transition-colors duration-500 -z-1 top-[1%] left-0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vulnerabilities Section -->
    <section id="vulnerabilities" class="bg-[#020617] font-['Press_Start_2P'] py-20 text-white text-center">
        <h2 class="anotherHeading text-4xl font-bold">Explore and Learn</h2>
        <p class="anotherHeading mt-4 font-['Lexend'] font-bold text-lg text-gray-300">Dive deep into Security Vulnerabilities and hands-on exploitation</p>
        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8 px-6 auto-rows-fr">
            <a href="Vulnerabilities/SSRF/index.php" class="vulnerabilityTile block transform transition-transform duration-300 hover:scale-105 cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col justify-between h-full">
                    <img src="Assets/Images/Fish.gif" alt="Broken Access Control" class="w-full h-40 object-cover rounded-md">
                    <h3 class="text-lg font-semibold mt-5">Server Side Request Forgery</h3>
                    <p class="text-gray-300 font-bold font-['Lexend'] text-md mt-3">Attacker manipulates a web application to make requests to internal or external resources, potentially gaining access to sensitive data or internal systems.</p>
                    <div class="mt-auto pt-6">
                        <span class="font-['Lexend'] text-xl font-semibold">Try It ></span>
                    </div>
                </div>
            </a>
            <a href="Vulnerabilities/Xss/xss.php" class="vulnerabilityTile block transform transition-transform duration-300 hover:scale-105 cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col justify-between h-full">
                    <img src="Assets/Images/CrossSiteScriptingThumbnail.gif" alt="Auth Failures" class="w-full h-40 object-cover rounded-md">
                    <h3 class="text-lg font-semibold mt-5">Cross Site Scripting</h3>
                    <p class="text-gray-300 font-bold font-['Lexend'] text-md mt-3">Involves injecting malicious code into a trusted website or web application.</p>
                    <div class="mt-auto pt-6">
                        <span class="font-['Lexend'] text-xl font-semibold">Try It ></span>
                    </div>
                </div>
            </a>
            <a href="Vulnerabilities/Cryptographic Failures/index.php" class="vulnerabilityTile block transform transition-transform duration-300 hover:scale-105 cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col justify-between h-full">
                    <img src="Assets/Images/lofi.gif" alt="Crypto Failures" class="w-full h-40 object-cover rounded-md">
                    <h3 class="text-lg font-semibold mt-5">Cryptographic Failures</h3>
                    <p class="text-gray-300 font-bold font-['Lexend'] text-md mt-3">Sensitive data exposure due to weak encryption, improper key management, or insecure transmission.</p>
                    <div class="mt-auto pt-6">
                        <span class="font-['Lexend'] text-xl font-semibold">Try It ></span>
                    </div>
                </div>
            </a>
            <a href="Vulnerabilities/Insecure Design/Insecure-design.php" class="vulnerabilityTile block transform transition-transform duration-300 hover:scale-105 cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col justify-between h-full">
                    <img src="Assets/Images/Insecure-Design.gif" alt="Insecure Design" class="w-full h-40 object-cover rounded-md">
                    <h3 class="text-lg font-semibold mt-5">Insecure Design</h3>
                    <p class="text-gray-300 font-bold font-['Lexend'] text-md mt-3">Flaws in application design that leave security gaps, making it easier for attackers to exploit vulnerabilities.</p>
                    <div class="mt-auto pt-6">
                        <span class="font-['Lexend'] text-xl font-semibold">Try It ></span>
                    </div>
                </div>
            </a>
            <a href="Vulnerabilities/Secutity_Logging_and_Monitoring_Failure/Secutity_Logging_and_Monitoring_Failure.php" class="vulnerabilityTile block transform transition-transform duration-300 hover:scale-105 cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                    <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col justify-between h-full">
                        <img src="Assets/Images/Insufficient-Logging.gif" alt="Logging & Monitoring" class="w-full h-40 object-cover rounded-md">
                        <h3 class="text-lg font-semibold mt-5">Security Logging & Monitoring</h3>
                        <p class="text-gray-300 font-bold font-['Lexend'] text-md mt-3">Lack of proper logging and alert mechanisms allows attackers to remain undetected for longer.</p>
                        <div class="mt-auto pt-6">
                            <span class="font-['Lexend'] text-xl font-semibold">Try It ></span>
                        </div>
                    </div>
            </a>
            <a href="Vulnerabilities/Misconfig/misconfig.php" class="vulnerabilityTile block transform transition-transform duration-300 hover:scale-105 cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col justify-between h-full">
                    <img src="Assets/Images/CoverImageMisconfig.gif" alt="Security Misconfiguration" class="w-full h-40 object-cover rounded-md">
                    <h3 class="text-lg font-semibold mt-5">Security Misconfiguration</h3>
                    <p class="text-gray-300 font-bold font-['Lexend'] text-md mt-3">Default settings, exposed error messages, or improperly configured security mechanisms can be exploited.</p>
                    <div class="mt-auto pt-6">
                        <span class="font-['Lexend'] text-xl font-semibold">Try It ></span>
                    </div>
                </div>
            </a>
            <a href="Vulnerabilities/Broken Access Control/Broken-access-control.php" class="vulnerabilityTile block transform transition-transform duration-300 hover:scale-105 cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col justify-between h-full">
                    <img src="Assets/Images/Data-Integrity-Failures.gif" alt="Integrity Failures" class="w-full h-40 object-cover rounded-md">
                    <h3 class="text-lg font-semibold mt-5">Broken Access Control</h3>
                    <p class="text-gray-300 font-bold font-['Lexend'] text-md mt-3">Broken access control can let unauthorized users access or modify sensitive data and functions.</p>
                    <div class="mt-auto pt-6">
                        <span class="font-['Lexend'] text-xl font-semibold">Try It ></span>
                    </div>
                </div>
            </a>
            <a href="Vulnerabilities/SQL Injection/Sql-injection.php" class="vulnerabilityTile block transform transition-transform duration-300 hover:scale-105 cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col justify-between h-full">
                    <img src="Assets/Images/SQL-Injection.gif" alt="Injection" class="w-full h-40 object-cover rounded-md">
                    <h3 class="text-lg font-semibold mt-5">SQL Injection</h3>
                    <p class="text-gray-300 font-bold font-['Lexend'] text-md mt-3">Attackers inject malicious code (e.g., SQL, NoSQL, OS commands) to manipulate or access sensitive data.</p>
                    <div class="mt-auto pt-6">
                        <span class="font-['Lexend'] text-xl font-semibold">Try It ></span>
                    </div>
                </div>
            </a>
            <a href="Vulnerabilities/Vulnerable_and_Outdated_Components/Vulnerable_and_Outdated_Components.php" class="vulnerabilityTile block transform transition-transform duration-300 hover:scale-105 cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col justify-between h-full">
                    <img src="Assets/Images/VulnerableComponents.gif" alt="Outdated Components" class="w-full h-40 object-cover rounded-md">
                    <h3 class="text-lg font-semibold mt-5">Vulnerable and Outdated Components</h3>
                    <p class="text-gray-300 font-bold font-['Lexend'] text-md mt-3">Using outdated or vulnerable software components can expose your application to known security risks and exploits.</p>
                    <div class="mt-auto pt-6">
                        <span class="font-['Lexend'] text-xl font-semibold">Try It ></span>
                    </div>
                </div>
            </a>
            <a href="#" class="vulnerabilityTile block transform transition-transform duration-300 hover:scale-105 cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                <div class="bg-[#020617]  p-6 rounded-lg shadow-lg flex flex-col col-span-3 justify-between h-full"></div>
            </a>
            <a href="Vulnerabilities/Deserialisation/deserialisation.php" class="vulnerabilityTile block transform transition-transform duration-300 hover:scale-105 cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col col-span-3 justify-between h-full">
                    <img src="Assets/Images/DeserialisationThumbnail.gif" alt="Outdated Components" class="w-full h-40 object-cover rounded-md">
                    <h3 class="text-lg font-semibold mt-5">Deserialization</h3>
                    <p class="text-gray-300 font-bold font-['Lexend'] text-md mt-3">Insecure deserialization can allow attackers to manipulate serialized objects, leading to remote code execution, privilege escalation, or data tampering within your application.</p>
                    <div class="mt-auto pt-6">
                        <span class="font-['Lexend'] text-xl font-semibold">Try It ></span>
                    </div>
                </div>
            </a>
            <a href="#" class="vulnerabilityTile block transform transition-transform duration-300 hover:scale-105 cursor-[url('Assets/Images/cursor_02.png'),_pointer]">
                <div class="bg-[#020617] p-6 rounded-lg shadow-lg flex flex-col col-span-3 justify-between h-full"></div>
            </a>
        </div>
    </section>

    <!-- USER REVIEW SECTION -->
    <section class="py-20 bg-[#020617] text-white">
        <h2 class="reviewHeading text-4xl font-bold text-center font-['Press_Start_2P']">What our Users Say</h2>
        <p class="reviewHeading mt-4 text-lg text-gray-300 text-center font-['Lexend'] font-bold">
            Real experience from our users mastering OWASP Concepts
        </p>
    
        <div class="mt-10 flex flex-col md:flex-row items-center justify-center px-6 gap-12 transition-transform duration-300 hover:scale-[1.03]">
            <div class="w-[220px] h-[220px] rounded-full overflow-hidden shadow-lg border-4 border-blue-500">
                <img src="Assets/Images/ronit_image.png" alt="team card" class="w-full h-full object-cover">
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-lg h-[220px] flex flex-col justify-between">
                <p class="text-md md:text-lg italic text-gray-300 font-['Lexend']">
                    “I never understood web vulnerabilities until I used this interactive lab. It's fun, hands-on, and incredibly helpful!”
                </p>
                <h3 class="mt-4 text-sm md:text-lg font-semibold text-blue-400 font-['Press_Start_2P']">-Ronit Thakur</h3>
            </div>
        </div>
    
        <div class="mt-10 flex flex-col md:flex-row items-center justify-center px-6 gap-12 transition-transform duration-300 hover:scale-[1.03]">
            <div class="w-[220px] h-[220px] rounded-full overflow-hidden shadow-lg border-4 border-blue-500">
                <img src="Assets/Images/Malay.jpeg" alt="team card" class="w-full h-full object-cover">
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-lg h-[220px] flex flex-col justify-between">
                <p class="text-md md:text-lg italic text-gray-300 font-['Lexend']">
                    “Such a cool way to learn OWASP Top 10! I loved how each topic was super easy to explore.”
                </p>
                <h3 class="mt-4 text-sm md:text-lg font-semibold text-blue-400 font-['Press_Start_2P']">-Malay Shikhar Soni</h3>
            </div>
        </div>
    </section>
    

    <!-- FOOTER SECTION -->
    <footer class="bg-gray-950 text-white py-16 mt-16">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-center md:text-left">
            <div>
                <img src="Assets/Images/logo.svg" alt="Web-Nexus Logo" class="w-24 mx-auto md:mx-0">
                <p class="mt-4 text-gray-400">Learn security the hands-on-way.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Company</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="About Us/contact us.php" class=" hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">About Us</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#home" class=" hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="About Us/contact us.php" class=" hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">FAQs</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Follow Us</h3>
                <div class="mt-4 flex justify-center md:justify-start space-x-4">
                    <a href="#" class=" hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="Assets/Images/github.png" alt="Github" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="Assets/Images/LinkedIn.jpg" alt="Linkedin" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="Assets/Images/twitter.jpg" alt="Twitter" class="w-8">
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
    <script src="Assets/Animations/HomePageAnimation/homepage_animation.js"></script>

</body>
</html>
