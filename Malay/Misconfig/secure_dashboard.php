<?php
session_start();

// Implement strict authentication checks
function is_authenticated() {
    return isset($_SESSION['user_id']) && 
           isset($_SESSION['role']) && 
           isset($_SESSION['username']) && 
           isset($_SESSION['csrf_token']);
}

// Secure database with strict access controls
$sensitive_data = [
    1234 => [
        'name' => 'John Doe',
        'salary' => '$85,000',
        'role_access' => ['user']
    ],
    9999 => [
        'name' => 'Admin User',
        'salary' => '$150,000',
        'role_access' => ['admin']
    ]
];

// Robust authentication and authorization
if (!is_authenticated()) {
    header("Location: secure_login.php");
    exit();
}

// Additional authorization check
$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['role'];

if (!isset($sensitive_data[$user_id]) || 
    !in_array($user_role, $sensitive_data[$user_id]['role_access'])) {
    // Unauthorized access attempt
    session_destroy();
    header("Location: secure_login.php");
    exit();
}

$user_data = $sensitive_data[$user_id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <script>
        var isAdmin = <?php echo ($user_role === 'admin') ? 'true' : 'false'; ?>;
    </script>

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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable User Dashboard</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">

</head>
<body class="bg-[#020617] font-['Lexend'] selection:text-yellow-400 cursor-[url('/Assets/Images/cursor_01.png'),_auto]">

    <!-- HEADER -->
    <nav class="fixed z-[999] top-0 left-0 h-[10vh] w-screen flex items-center justify-between p-4 bg-[#020617] border-b-2 border-[#3E4B5E] max-md:p-0">
        <div class="headerStuff flex items-center space-x-3">
            <img src="/Assets/Images/logo.svg" alt="logo" class="w-12">
            <span class="text-2xl text-white font-bold font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] max-md:text-xs">
                Web-Nexus</span>
        </div>

        <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
            <a href="/Kavy (Main Branch)/Home-Page.html#vulnerabilities" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="/Kavy (Main Branch)/Home-Page.html" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Home</a>
            <a href="/Karan/About Us/contact_us.html" class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]  text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
        </div>
        
        <div id="menu-btn" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] md:hidden focus:outline-none">
            <img src="/Assets/Images/menu.svg" alt="menu" class="w-8">
        </div>

        <div class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
                <img id="headerStuff theme-icon" src="/Assets/Images/dark-mode.svg" alt="dark-mode" class="w-10 p-2 max-md:w-6">
                <div class="yellowButton yellowButtonHeader hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] ">
                    <div class=" relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)]  transition-colors duration-500">
                        <div class=" font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] font-thin text-xs max-md:text-[8px]">
                            Log Out
                        </div>
                        <div class="absolute w-[105%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md  transition-colors duration-500 -z-1 top-[1%] left-0"></div>
                    </div>
                </div>
        </div>
    
    </nav>

    <div class="flex flex-row max-md:flex-col items-center justify-center h-full w-full mt-[10vh] ">

        <!-- MASCOT WITH SPEECH BUBBLE -->
        <div class="w-[50vw] h-full max:md-h[50vh] max-md:w-full p-10">
            
            <!-- SPEECH BUBBLE -->
            <div class="relative h-30 max-md:mt-[20vh]">

                                    

                <div class="absolute bottom-0 left-0 translate-y-1/2 translate-x-[50%] rotate-45 w-16 h-16  border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">
                    
                </div>

                <div class="absolute p-5 text-white font-['Press_Start_2P'] text-xl font-thin  left-0 w-full h-full border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">
                    
                    <p class="popupText popupText1 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">Welcome <p class="popupText2 inline text-white drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">John! </p> <p class="popupText3 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"> Change the URL again, oh wait, you can't! </p>
                    <p class="popupText popupText4 inline text-green-400 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">BWAHAHAHAHA! </p> <p class="popupText5 inline text-white drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"> This version is </p> <p class="popupText6 inline text-green-400 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">secure.</p>
                    
                </div>
                
            </div>

            <!-- MASCOT -->
                      
            <img src="/Assets/Images/mascot.gif" class="w-100 h-auto max-md:w-40" alt="mascot">
            

        </div>

        <div class="h-screen w-[2px] bg-[#3E4B5E] max-md:hidden"></div>
    

        <!-- SECURE DASHBOARD SECTION -->
        <div class="dashboardSection flex items-center justify-center w-[50vw] h-full max-md:h[50vh] max-md:w-full">

            <div class=" mx-auto p-6">
                <div class="bg-[#1E293B] border-3 border-[#3E4B5E] rounded-lg p-6">
                    <h1 class="dashboardHeading flex items-center justify-center text-2xl font-['Press_Start_2P'] font-bold drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] mb-10 text-green-400">
                        Secure User Dashboard
                    </h1>
                    
                    <div class="bg-[#3E4B5E] border-l-6 border-[#0F172A] p-4 mb-6" role="alert">
                        <p class="font-bold text-[#0F172A]">SECURITY BEST PRACTICES</p>
                        <p class="text-[#0F172A]">This dashboard demonstrates robust security mechanisms!</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12">
                        <div class="bg-[#0F172A] p-4 rounded-lg">
                            <h2 class="text-xl font-extrabold mb-4 text-[#3E4B5E]">User Information</h2>
                            <p class="text-[#3E4B5E]"><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                            <p class="text-[#3E4B5E]"><strong>Role:</strong> <?php echo htmlspecialchars($user_role); ?></p>
                        </div>

                        <div class=" bg-[#0F172A] p-4 rounded-lg">
                            <h2 class="text-xl font-semibold mb-4 text-[#3E4B5E]">Authorized Information</h2>
                            <p class="text-[#3E4B5E]"><strong>Name:</strong> <?php echo htmlspecialchars($user_data['name']); ?></p>
                            <p class="text-[#3E4B5E]"><strong>Salary:</strong> <?php echo htmlspecialchars($user_data['salary']); ?></p>
                        </div>
                    </div>

                    <div class="mt-6 w-full flex flex-col items-center justify-center">
                        <a href="secure_logout.php" class="flex items-center justify-center w-full py-3 mt-6 bg-[#3E4B5E] text-[#1E293B] font-bold text-xl px-4  rounded hover:bg-[#0F172A] hover:text-[#3E4B5E] transition-colors duration-500">
                            Logout
                        </a>
                        <a href="misconfig.html" class="flex items-center justify-center w-full py-3 mt-6 bg-[#3E4B5E] text-[#1E293B] font-bold text-xl px-4  rounded hover:bg-[#0F172A] hover:text-[#3E4B5E] transition-colors duration-500">
                            Go Back
                        </a>
                    </div>
                </div>
            </div>

        </div>
        

    </div>

    <!-- WINDOW -->
    <div class="windowPopup mx-50 my-20 flex flex-col items-center justify-center bg-[#3E4B5E] rounded-md p-2">
                        
                        <div class="flex items-center justify-between w-full">

                            <p class="text-[#0F172A] font-bold text-2xl ml-2 py-2">This Version uses:</p>
            
                            <div class="flex flex-row justify-end items-center gap-2 h-7 mb-2 w-auto">
                                
                                <div class="bg-[#0F172A] w-5 h-[4px]"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] w-5 h-5"></div>
                                <div class="bg-transparent border-4 border-[#0F172A] rounded-full w-5 h-5"></div>
                                
                            </div>
                        </div>

                        <pre class="whitespace-pre-wrap flex items-center w-full h-full" >
                        
                          <code class=" rounded-md text-sm font-mono w-full h-full" >
session_start();

// More secure user "database"
$users = [
    'john' => [
        'password' => password_hash('123', PASSWORD_BCRYPT), 
        'role' => 'user', 
        'id' => 1234
    ],
    'admin' => [
        'password' => password_hash('123', PASSWORD_BCRYPT), 
        'role' => 'admin', 
        'id' => 9999
    ]
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // SECURE: Proper password verification
    if (isset($users[$username]) && 
        password_verify($password, $users[$username]['password'])) {
        
        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);
        
        // Store only necessary, non-sensitive information
        $_SESSION['user_id'] = $users[$username]['id'];
        $_SESSION['role'] = $users[$username]['role'];
        $_SESSION['username'] = $username;
        
        // Use random token for CSRF protection
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        
        header("Location: secure_dashboard.php");
        exit();
    } else {
        // Deliberate delay to prevent timing attacks
        sleep(1);
        $error = 'Invalid credentials';
    }
                          </code>
                        </pre>
                    </div>


                    <footer class="bg-gray-950 text-white py-16 mt-16">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-center md:text-left">
            <div>
                <img src="/Assets/Images/logo.svg" alt="Web-Nexus Logo" class="w-24 mx-auto md:mx-0">
                <p class="mt-4 text-gray-400">Learn security the hands-on-way.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Company</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">About Us</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
                    <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">FAQs</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Follow Us</h3>
                <div class="mt-4 flex justify-center md:justify-start space-x-4">
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Assets/Images/github.svg" alt="Github" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Assets/Images/linkedin.svg" alt="Linkedin" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Assets/Images/twitter.svg" alt="Twitter" class="w-8">
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
    <script src="/Malay/Animations/MisconfigAnimation/secure_dashboard_animation.js"></script>

    
</body>
</html>