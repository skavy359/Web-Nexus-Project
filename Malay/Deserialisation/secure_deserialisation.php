<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /Web-Nexus-Project/Kartavya/Login_Pages/login_page.php");
    exit;
}
// Define allowed classes for deserialization
class SecureUser {
    private $username;
    private $isAdmin = false;
    private $token;
    
    function __construct($username) {
        $this->username = $username;
        // Generate a unique token for validation
        $this->token = bin2hex(random_bytes(16));
    }
    
    function __wakeup() {
        // Security check during unserialization
        // echo "<div class='bg-[#3E4B5E] border-l-6 border-[#0F172A] p-4 mb-4' role='alert'>
        //     <p class='text-white'>Security validation performed during unserialization!</p>
        // </div>";
        
        // Prevent tampering with admin status
        if ($this->isAdmin && (!isset($_SESSION['admin_token']) || $_SESSION['admin_token'] !== $this->token)) {
            $this->isAdmin = false;
            // echo "<div class='bg-[#3E4B5E] border-l-6 border-[#0F172A] p-4 mb-4' role='alert'>
            //     <p class='text-red-300'>Security alert: Attempt to modify admin status detected and prevented!</p>
            // </div>";
        }
    }
    
    function displayGreeting() {
        echo "<div>";
        echo "<p class='text-lg text-white'>Hello, " . htmlspecialchars($this->username) . "!</p>";
        
        if ($this->isAdmin) {
            echo "<div class='bg-[#3E4B5E] border-l-6 border-[#0F172A] p-4 mt-4'>
                <p class='font-bold text-green-400'>Admin Access Granted!</p>
                <p class='text-white'>You are properly authenticated as an admin.</p>
            </div>";
        }
        echo "</div>";
    }
    
    public function getUsername() {
        return htmlspecialchars($this->username);
    }
    
    public function getToken() {
        return $this->token;
    }
    
    // For demonstration purposes only - in a real app you'd use proper authentication
    public function setAdminStatus($status) {
        $this->isAdmin = (bool)$status;
        if ($this->isAdmin) {
            $_SESSION['admin_token'] = $this->token;
        }
    }
}

// Custom unserializer function with whitelist
function secure_unserialize($data) {
    // Basic validation - check if it looks like a serialized string
    if (!is_string($data) || trim($data) === '') {
        return false;
    }
    
    // Define options for unserialize with allowed_classes
    $options = [
        'allowed_classes' => ['SecureUser']
    ];
    
    // Use PHP's built-in unserialize with options and error suppression
    $result = @unserialize($data, $options);
    return $result;
}

$serializedData = "";
$user = null;
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"])) {
        // Create and serialize user object
        $user = new SecureUser($_POST["username"]);
        $serializedData = serialize($user);
        $_SESSION["secure_user_data"] = $serializedData;
        $message = "User object has been securely serialized and stored in session.";
    } 
    elseif (isset($_POST["serialized_data"])) {
        // Secure handling: Using whitelist and validation
        $serializedData = $_POST["serialized_data"];
        try {
            // Use secure_unserialize with whitelisting
            $user = secure_unserialize($serializedData);
            
            if ($user instanceof SecureUser) {
                $message = "User object has been securely unserialized with proper validation.";
            } else {
                $message = "Error: Unserialized object is not of type SecureUser.";
            }
        } catch (Exception $e) {
            $message = "Error during secure unserialization: " . $e->getMessage();
        }
    }
    elseif (isset($_POST["make_admin"]) && isset($_SESSION["secure_user_data"])) {
        // For demo purposes only
        $serializedData = $_SESSION["secure_user_data"];
        $user = secure_unserialize($serializedData);
        $user->setAdminStatus(true);
        $serializedData = serialize($user);
        $_SESSION["secure_user_data"] = $serializedData;
        $message = "Admin status granted through proper channel.";
    }
}

// Retrieve serialized data from session if it exists
if (!isset($user) && isset($_SESSION["secure_user_data"])) {
    $serializedData = $_SESSION["secure_user_data"];
    $user = secure_unserialize($serializedData);
}

// $serializedData = "";


?>
<!DOCTYPE html>
<html lang="en" class="mi">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Deserialization Page</title>

    <!-- Highlight.js CSS for syntax highlighting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/night-owl.min.css">

    <!-- Highlight.js script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
        hljs.highlightAll();
        });
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

</head>
<body class="bg-[#020617] font-['Lexend'] selection:text-yellow-400 cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_01.png'),_auto]">

    <!-- HEADER -->
    <nav class="fixed z-[999] top-0 left-0 h-[10vh] w-screen flex items-center justify-between p-4 bg-[#020617] border-b-2 border-[#3E4B5E] max-md:p-0">
        <div class="headerStuff flex items-center space-x-3 max-md:space-x-1">
            <img src="/Web-Nexus-Project/Assets/Images/logo.svg" alt="logo" class="w-12 max-md:w-8">
            <span class="text-2xl font-bold text-white font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] max-md:text-xs hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer]">Web-Nexus</span>
        </div>

        <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
            <a href="/Web-Nexus-Project/Kavy/Home/Home-Page.php#vulnerabilities" class="headerStuff hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="/Web-Nexus-Project/Kavy/Home/Home-Page.php" class="headerStuff hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Home</a>
            <a href="/Web-Nexus-Project/Karan/About Us/contact us.php" class="headerStuff hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
        </div>

        <div class="hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
            <div onclick="window.location.href='/Web-Nexus-Project/Kartavya/Login_Pages/logout.php'" class="yellowButton yellowButtonHeader hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer]">
                <div class="relative bg-yellow-300 hover:bg-yellow-600 px-3 py-2 mr-3 rounded-md border-3 border-[rgb(221,170,16)] transition-colors duration-500">
                    <div class="font-['Press_Start_2P'] drop-shadow-[2px_2px_0px_rgb(221,170,16)] text-black font-thin text-sm max-md:text-[8px]">
                        <a href="/Web-Nexus-Project/Kartavya/Login_Pages/logout.php">Log Out</a>
                    </div>
                    <div class="absolute w-[105%] h-[115%] bg-[rgb(221,170,16)] hover:bg-yellow-600 rounded-md transition-colors duration-500 -z-1 top-[1%] left-0"></div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex flex-row max-md:flex-col items-start justify-center h-full w-full mt-[10vh]">

    <div class="w-[50vw] h-full max-md:h-[50vh] max-md:w-full p-10">
            
            <!-- SPEECH BUBBLE -->
            <div class="relative h-40 max-md:mt-[20vh]">
                <div class="absolute bottom-0 left-0 translate-y-1/2 translate-x-[50%] rotate-45 w-16 h-16 border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">
                </div>

                <div class="absolute p-5 text-white font-['Press_Start_2P'] text-xl font-thin left-0 w-full h-full border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">
                    <p class="popupText popupText1 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">Ready to attempt a<p class="popupText2 inline text-green-400 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"> deserialization </p> <p class="popupText3 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"> attack? Try it now!</p>
                    <p class="popupText popupText4 inline text-white drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"></p> <p class="popupText5 inline text-red-300 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"></p> <p class="popupText6 inline text-white drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"></p>
                </div>
            </div>

            <!-- MASCOT -->
            <img src="/Web-Nexus-Project/Assets/Images/mascot.gif" class="w-100 h-auto max-md:w-40" alt="mascot">
        </div>

        <div class="h-[170vh] w-[2px] bg-[#3E4B5E] max-md:hidden"></div>

        <!-- SECURE DESERIALIZATION PAGE SECTION -->
        <div class="deserialisationPageSection flex items-center justify-center w-[50vw] h-full max-md:h[50vh] max-md:w-full">

            <div class="bg-[#1E293B] border-3 border-[#3E4B5E] rounded-lg p-6 m-12">
                <h1 class="dashboardHeading w-full text-center text-2xl font-['Press_Start_2P'] font-bold drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] mb-10 text-green-400">Secure Deserialization Demo</h1>
                
                <div class="bg-[#3E4B5E] border-l-6 border-[#0F172A] p-4 mb-6" role="alert">
                    <p class="font-bold text-white">NOTE</p>
                    <p class="text-white">This page implements security against PHP object deserialization attacks.</p>
                </div>
                
                <div>
                    <?php if (!empty($message)): ?>
                    <div class="bg-[#3E4B5E] border-l-6 border-[#0F172A] p-4 mb-6" role="alert">
                        <p class="text-white"><?php echo $message; ?></p>
                    </div>
                    <?php endif; ?>

                </div>
                
                <!-- Create User Form -->
                <div class="mb-6">
                    <h2 class="text-xl text-white font-semibold mb-6">Step 1: Create a User</h2>
                    <form method="post" class="mb-6">
                        <div class="mb-4">
                            <input type="text" id="username" name="username" placeholder="Your Username" required class="w-full p-3 border-3 border-[#3E4B5E] font-semibold text-white rounded-md placeholder-[#3E4B5E] focus:border-white outline-none">
                        </div>
                        <div>
                            <button type="submit" class="submitButton hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] flex items-center justify-center font-bold w-full mt-6 bg-[#3E4B5E] text-[#0F172A] text-xl hover:text-[#3E4B5E] py-3 rounded-md hover:bg-[#0F172A] transition duration-300 mb-6">Create & Serialize User</button>
                        </div>
                    </form>
                </div>
                
                <!-- Manipulate Serialized Data -->
                <div class="mb-6">
                    <h2 class="text-xl text-white font-semibold mb-6">Step 2: Try to Manipulate Serialized Data</h2>
                    <form method="post" class="mb-6">
                        <div class="mb-4">
                            <textarea id="serialized_data" name="serialized_data" rows="4" required placeholder="Serialized User Data" class="w-full p-3 border-3 border-[#3E4B5E] font-semibold text-white rounded-md placeholder-[#3E4B5E] focus:border-white outline-none font-mono text-sm"><?php echo htmlspecialchars($serializedData); ?></textarea>
                        </div>
                        <div class="mb-4">
                            <p class="text-[#3E4B5E] font-semibold">
                                <strong>Note:</strong> Even if you change <code>isAdmin</code> to <code>b:1;</code>, the security measures will prevent this attack.
                            </p>
                        </div>
                        <button type="submit" class="submitButton hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] flex items-center justify-center font-bold w-full mt-6 bg-[#3E4B5E] text-[#0F172A] text-xl hover:text-[#3E4B5E] py-3 rounded-md hover:bg-[#0F172A] transition duration-300 mb-6">Securely Unserialize Data</button>
                    </form>
                </div>
                
                <div>
                     <!-- User Information Display -->
                     <?php if (isset($user) && $user instanceof SecureUser): ?>
                     <div class="mb-6">
                         <h2 class="text-xl text-white font-semibold mb-6">User Information:</h2>
                         <div>
                             <?php $user->displayGreeting(); ?>
     
                         </div>
                     </div>

                     
                     <!-- Proper Admin Access -->
                     <div class="mb-6">
                         <h2 class="text-xl text-white font-semibold mb-6">Proper Admin Access Channel:</h2>
                         <form method="post">
                             <p class="mb-4 text-[#3E4B5E] font-semibold">In a real application, this would involve proper authentication.</p>
                             <input type="hidden" name="make_admin" value="1">
                             <button type="submit" class="submitButton hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] flex items-center justify-center font-bold w-full mt-6 bg-[#3E4B5E] text-[#0F172A] text-xl hover:text-[#3E4B5E] py-3 rounded-md hover:bg-[#0F172A] transition duration-300 mb-6">Grant Admin Access Through Proper Channel</button>
                            </form>
                        </div>
                        <?php endif; ?>
                </div>
                
                <h2 class="text-xl text-white font-bold mt-6 mb-3">Security Measures Implemented</h2>
                <ul class="list-disc pl-5 space-y-2">
                    <li class="text-[#3E4B5E] font-semibold mb-6">Class whitelisting with <code>allowed_classes</code> option</li>
                    <li class="text-[#3E4B5E] font-semibold mb-6">Validation in the <code>__wakeup()</code> method to prevent property tampering</li>
                    <li class="text-[#3E4B5E] font-semibold mb-6">Token-based validation to ensure object integrity</li>
                    <li class="text-[#3E4B5E] font-semibold mb-6">Private properties to limit direct access</li>
                    <li class="text-[#3E4B5E] font-semibold mb-6">Output escaping with <code>htmlspecialchars()</code> to prevent XSS</li>
                </ul>
                
                <h2 class="text-xl text-white font-bold mt-6 mb-3">Try It</h2>
                <p class="text-[#3E4B5E] font-semibold mb-6">Try modifying the serialized data to gain admin access:</p>
                <pre class="bg-gray-100 rounded mb-8"><code>O:10:"SecureUser":3:{s:11:"username";s:5:"admin";
s:10:"isAdmin";b:1;s:8:"token";s:32:"abc123"}</code></pre>
                <p class="text-[#3E4B5E] font-semibold mb-6">You'll notice the security measures prevent this attack.</p>
                
                <p class="mt-4">
                    <a href="deserialisation.php" class="flex items-center justify-center w-full py-3 mt-6 bg-[#3E4B5E] text-[#0F172A] font-bold text-xl px-4 rounded hover:bg-[#0F172A] hover:text-[#3E4B5E] transition-colors duration-500">
                        Go Back
                    </a>
                </p>
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
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact us.php" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">About Us</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#home" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact us.php" class=" hover:cursor-[url('/Web-Nexus-Project/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
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
    <script src="/Web-Nexus-Project/Malay/Animations/DeserialisationAnimation/secure_deserialisation_animation.js"></script>

</body>
</html>