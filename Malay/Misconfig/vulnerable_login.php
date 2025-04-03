<?php
session_start();

// Extremely insecure user "database"
$users = [
    'john' => ['password' => '123', 'role' => 'user', 'id' => 1234],
    'admin' => ['password' => '123', 'role' => 'admin', 'id' => 9999]
];

$error = '';

// Check for URL parameters
if (isset($_GET['username']) && isset($_GET['password'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];

    // VULNERABLE: Simple direct comparison via URL parameters
    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $_SESSION['user'] = $users[$username];
        header("Location: vulnerable_dashboard.php?username=$username&password=$password");
        exit();
    } else {
        $error = 'Invalid credentials';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable Login</title>
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
            <img src="/Assets/Images/logo.svg" alt="logo" class="w-12">
            <span class="text-2xl text-white font-bold font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] max-md:text-xs">
                Web-Nexus</span>
        </div>

        <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
            <a href="#" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="#" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">About Us</a>
            <a href="#" class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]  text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
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



    <!-- MAIN CONTENT -->
    <div class="flex flex-row max-md:flex-col items-center justify-center h-full w-full mt-[10vh] ">


        <!-- MASCOT WITH SPEECH BUBBLE -->
        <div class="w-[50vw] h-full max:md-h[50vh] max-md:w-full p-10">
            
            <!-- SPEECH BUBBLE -->
            <div class="relative h-30 max-md:mt-[20vh]">

                                    

                <div class="absolute bottom-0 left-0 translate-y-1/2 translate-x-[50%] rotate-45 w-16 h-16  border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">
                    
                </div>

                <div class="absolute p-5 text-white font-['Press_Start_2P'] text-xl font-thin  left-0 w-full h-full border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">
                    
                    <p class="popupText popupText1 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">Now <p class="popupText2 inline text-yellow-400 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">login</p> <p class="popupText3 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"> as one of the users.</p>
                    <p class="popupText popupText4 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">Fair Warning though, you're about to do something</p> <p class="popupText5 inline text-yellow-400 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">unethical</p> <p class="popupText6 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"> !</p>
                    
                </div>
                
            </div>

            <!-- MASCOT -->
                        
            <img src="/Assets/Images/mascot.gif" class="w-100 h-auto max-md:w-40" alt="mascot">
            

        </div>


        <div class="h-screen w-[2px] bg-[#3E4B5E] max-md:hidden"></div>
        
        <!-- VULNERABLE FORM SECTION -->
        <div class="formSection flex items-center justify-center w-[50vw] h-full max-md:h[50vh] max-md:w-full">
            <div class="bg-[#1E293B] border-3 border-[#3E4B5E]  p-8 rounded-lg shadow-md w-96 h-120 flex flex-col items-center justify-center">
                <h2 class="text-2xl font-['Press_Start_2P'] font-bold mb-14 text-center text-white drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black]">Vulnerable Login</h2>
                
                <?php if ($error): ?>
                    <div class=" text-red-300 px-4 py-3 rounded relative mb-4 -mt-8" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                

                <form method="GET" class="space-y-4">
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
                
                <div class="mt-6 text-center text-sm text-white drop-shadow-[3px_3px_0px_black] drop-shadow-[-3px_-3px_0px_black] font-semibold hover:text-red-300 transition-colors duration-500 ">
                    Warning: This login system has MULTIPLE security vulnerabilities!
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/gsap.min.js" integrity="sha512-f6bQMg6nkSRw/xfHw5BCbISe/dJjXrVGfz9BSDwhZtiErHwk7ifbmBEtF9vFW8UNIQPhV2uEFVyI/UHob9r7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/ScrollTrigger.min.js" integrity="sha512-AcqPGqrrAEtEwe+ADO5R8RbdFi7tuU7b/A2cJJH0Im0D18NRk5p5s4B3E5PMuO81KFw0ClN7J5SHVUJz7KOb0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/Malay/Animations/MisconfigAnimation/vulnerable_login_animation.js"></script>
</body>
</html>