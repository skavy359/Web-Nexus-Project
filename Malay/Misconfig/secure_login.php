<?php
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
}
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Login</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

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
            <img src="/Web-Nexus-Project/Assets/Images/logo.svg" alt="logo" class="w-12">
            <span class="text-2xl text-white font-bold font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] max-md:text-xs">
                Web-Nexus</span>
        </div>

        <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
            <a href="/Web-Nexus-Project/Kavy (Main Branch)/Home/Home-Page.html#vulnerabilities" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="/Web-Nexus-Project/Kavy (Main Branch)/Home/Home-Page.html" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Home</a>
            <a href="/Web-Nexus-Project/Karan/About Us/contact_us.html" class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]  text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
        </div>
        
        

        <div class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
                <!-- <img id="headerStuff theme-icon" src="/Web-Nexus-Project/Assets/Images/dark-mode.svg" alt="dark-mode" class="w-10 p-2 max-md:w-6"> -->
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



    <!-- MAIN CONTENT -->
    <div class="flex flex-row max-md:flex-col items-center justify-center h-full w-full mt-[10vh] ">

        <!-- MASCOT WITH SPEECH BUBBLE -->
        <div class="w-[50vw] h-full max:md-h[50vh] max-md:w-full p-10">
            
            <!-- SPEECH BUBBLE -->
            <div class="relative h-30 max-md:mt-[20vh]">

                                    

                <div class="absolute bottom-0 left-0 translate-y-1/2 translate-x-[50%] rotate-45 w-16 h-16  border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">
                    
                </div>

                <div class="absolute p-5 text-white font-['Press_Start_2P'] text-xl font-thin  left-0 w-full h-full border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">
                    
                    <p class="popupText popupText1 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">Let's <p class="popupText2 inline text-yellow-400 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"></p> <p class="popupText3 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"> do that again.</p>
                    <p class="popupText popupText4 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">This version is relatively</p> <p class="popupText5 inline text-yellow-400 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"> secure</p> <p class="popupText6 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"> !</p>
                    
                </div>
                
            </div>

            <!-- MASCOT -->
                        
            <img src="/Web-Nexus-Project/Assets/Images/mascot.gif" class="w-100 h-auto max-md:w-40" alt="mascot">
            

        </div>


        <div class="h-screen w-[2px] bg-[#3E4B5E] max-md:hidden"></div>
        

        <!-- SECURE FORM SECTION -->
        <div class="formSection flex items-center justify-center w-[50vw] h-full max-md:h[50vh] max-md:w-full">
            <div class="bg-[#1E293B] border-3 border-[#3E4B5E]  p-8 rounded-lg shadow-md w-96 h-120 flex flex-col items-center justify-center">
            <h2 class="text-2xl font-['Press_Start_2P'] font-bold mb-14 text-center text-green-400 drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black]">Secure Login</h2>
                
                <?php if ($error): ?>
                    <div class=" text-red-300 px-4 py-3 rounded relative mb-4 -mt-8" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                    <?php endif; ?>
                    
                    <form method="POST" class="space-y-4">
                        <input 
                        type="text" 
                        name="username" 
                        placeholder="Username" 
                        required 
                        class="usernameInput hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] w-full px-3 py-2 border-2 border-[#3E4B5E] rounded-md font-bold text-white focus:outline-none focus:ring-1 placeholder:text-[#3E4B5E] placeholder:font-semibold focus:ring-white"
                        >
                        <input 
                        type="password" 
                        name="password" 
                        placeholder="Password" 
                        required 
                        class="passwordInput hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] w-full px-3 py-2 border-2 border-[#3E4B5E] rounded-md font-bold text-white focus:outline-none focus:ring-1 placeholder:text-[#3E4B5E] placeholder:font-semibold focus:ring-white"
                        >
                        <button 
                        type="submit" 
                        class="submitButton hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] flex items-center justify-center font-bold w-full mt-6 bg-[#3E4B5E] text-[#0F172A] hover:text-[#3E4B5E] py-2 rounded-md hover:bg-[#0F172A] transition duration-300"
                        >
                        Login
                    </button>
                </form>
                
                <div class="mt-6 text-center text-sm text-white drop-shadow-[3px_3px_0px_black] drop-shadow-[-3px_-3px_0px_black] font-semibold hover:text-green-400 transition-colors duration-500 ">
                    Secure login with multiple protection mechanisms
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
                        <img src="/Web-Nexus-Project/Assets/Images/github.svg" alt="Github" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Web-Nexus-Project/Assets/Images/linkedin.svg" alt="Linkedin" class="w-8">
                    </a>
                    <a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">
                        <img src="/Web-Nexus-Project/Assets/Images/twitter.svg" alt="Twitter" class="w-8">
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
    <script src="/Web-Nexus-Project/Malay/Animations/MisconfigAnimation/secure_login_animation.js"></script>
    
</body>
</html>