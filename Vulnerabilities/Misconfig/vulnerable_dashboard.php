<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../../Login_Pages/login_page.php");
    exit;
}


// Check if user is logged in via URL parameters
if (!isset($_GET['username']) || !isset($_GET['password'])) {
    header("Location: vulnerable_login.php");
    exit();
}

// Extremely insecure user "database"
$users = [
    'john' => ['password' => '123', 'role' => 'user', 'id' => 1234],
    'admin' => ['password' => '123', 'role' => 'admin', 'id' => 9999]
];

$username = $_GET['username'];
$password = $_GET['password'];

// CRITICAL VULNERABILITY: Direct authentication via URL parameters
if (!isset($users[$username]) || $users[$username]['password'] !== $password) {
    header("Location: vulnerable_login.php");
    exit();
}

$user = $users[$username];

// Mock sensitive data that should be protected
$sensitive_data = [
    1234 => [
        'name' => 'John Doe',
        'salary' => '$85,000',
        'ssn' => '123-45-6789',
        'credit_card' => '4111-1111-1111-1111'
    ],
    9999 => [
        'name' => 'Admin User',
        'salary' => '$150,000',
        'ssn' => '987-65-4321',
        'credit_card' => '5500-0000-0000-0004'
    ]
];

// CRITICAL VULNERABILITY: Directly accessing sensitive data using user ID
$user_sensitive_data = $sensitive_data[$user['id']];
?>


<!DOCTYPE html>
<html lang="en" class="">
<head>

    <script>
        var isAdmin = <?php echo json_encode($user['role'] === 'admin'); ?>;
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

    <div class="flex flex-row max-md:flex-col items-center justify-center h-full w-full mt-[10vh] ">

        <!-- MASCOT WITH SPEECH BUBBLE -->
        <div class="w-[50vw] h-full max:md-h[50vh] max-md:w-full p-10">
            
            <!-- SPEECH BUBBLE -->
            <div class="relative h-30 max-md:mt-[20vh]">

                                    

                <div class="absolute bottom-0 left-0 translate-y-1/2 translate-x-[50%] rotate-45 w-16 h-16  border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">
                    
                </div>

                <div class="absolute p-5 text-white font-['Press_Start_2P'] text-xl font-thin  left-0 w-full h-full border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">
                    
                    <p class="popupText popupText1 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">Welcome <p class="popupText2 inline text-white drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">John! </p> <p class="popupText3 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"> Wanna sneak into the ADMIN DASHBOARD? In the URL, change </p>
                    <p class="popupText popupText4 inline text-red-300 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">username=john& </p> <p class="popupText5 inline text-white drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"> to </p> <p class="popupText6 inline text-red-300 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"> username=admin&</p>
                    
                </div>
                
            </div>

            <!-- MASCOT -->
                        
            <img src="../../Assets/Images/mascot.gif" class="w-100 h-auto max-md:w-40" alt="mascot">
            

        </div>

        <div class="h-screen w-[2px] bg-[#3E4B5E] max-md:hidden"></div>
    
        <!-- VULNERABLE DASHBOARD SECTION -->
        <div class="dashboardSection flex items-center justify-center w-[50vw] h-full max-md:h[50vh] max-md:w-full">

            <div class=" mx-auto p-6">
                <div class="bg-[#1E293B] border-3 border-[#3E4B5E] rounded-lg p-6">
                    <h1 class="dashboardHeading text-2xl font-['Press_Start_2P'] font-bold drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] mb-10 text-red-300">
                        Vulnerable User Dashboard
                    </h1>
                    
                    <div class="bg-[#3E4B5E] border-l-6 border-[#0F172A] p-4 mb-6" role="alert">
                        <p class="font-bold text-[#0F172A]">SECURITY WARNING</p>
                        <p class="text-[#0F172A]">This dashboard demonstrates multiple security vulnerabilities!</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12">
                        <div class="bg-[#0F172A] p-4 rounded-lg">
                            <h2 class="text-xl font-extrabold mb-4 text-[#3E4B5E]">User Information</h2>
                            <p class="text-[#3E4B5E]"><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
                            <p class="text-[#3E4B5E]"><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
                        </div>

                        <div class=" bg-[#0F172A] p-4 rounded-lg">
                            <h2 class="text-xl font-extrabold mb-4 text-[#3E4B5E]">Sensitive Information</h2>
                            <p class="text-[#3E4B5E]"><strong>Name:</strong> <?php echo htmlspecialchars($user_sensitive_data['name']); ?></p>
                            <p class="text-[#3E4B5E]"><strong>Salary:</strong> <?php echo htmlspecialchars($user_sensitive_data['salary']); ?></p>
                            <p class="text-[#3E4B5E]"><strong>SSN:</strong> <?php echo htmlspecialchars($user_sensitive_data['ssn']); ?></p>
                            <p class="text-[#3E4B5E]"><strong>Credit Card:</strong> <?php echo htmlspecialchars($user_sensitive_data['credit_card']); ?></p>
                        </div>
                    </div>

                    <div class="mt-6 w-full flex flex-col items-center justify-center">
                        <a href="vulnerable_login.php" class="flex items-center justify-center w-full py-3 mt-6 bg-[#3E4B5E] text-[#1E293B] font-bold text-xl px-4  rounded hover:bg-[#0F172A] hover:text-[#3E4B5E] transition-colors duration-500">
                            Logout
                        </a>
                        <a href="misconfig.php" class="flex items-center justify-center w-full py-3 mt-6 bg-[#3E4B5E] text-[#1E293B] font-bold text-xl px-4  rounded hover:bg-[#0F172A] hover:text-[#3E4B5E] transition-colors duration-500">
                            Go Back
                        </a>
                    </div>
                </div>
            </div>  

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
    <script src="../../Assets/Animations/MisconfigAnimation/vulnerable_dashboard_animation.js"></script>
    
</body>
</html>