<?php
// secure-page.php
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS Vulnerable Page</title>
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

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
            <a href="/Kavy (Main Branch)/Home/Home-Page.html#vulnerabilities" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
            <a href="/Kavy (Main Branch)/Home/Home-Page.html" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Home</a>
            <a href="/Karan/About Us/contact_us.html" class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]  text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
        </div>
        
        

        <div class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
                <!-- <img id="headerStuff theme-icon" src="/Assets/Images/dark-mode.svg" alt="dark-mode" class="w-10 p-2 max-md:w-6"> -->
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

    <div class="flex flex-row max-md:flex-col items-start justify-center h-full w-full mt-[10vh] ">

    <div class="w-[50vw] h-full max:md-h[50vh] max-md:w-full p-10">
            
            <!-- SPEECH BUBBLE -->
            <div class="relative h-40 max-md:mt-[20vh]">

                                    

                <div class="absolute bottom-0 left-0 translate-y-1/2 translate-x-[50%] rotate-45 w-16 h-16  border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">
                    
                </div>

                <div class="absolute p-5 text-white font-['Press_Start_2P'] text-xl font-thin  left-0 w-full h-full border-3 rounded-md border-[#3E4B5E] bg-[#1E293B]">
                    
                    <p class="popupText popupText1 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs">Ready to make a<p class="popupText2 inline text-green-400 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"> &lt;scripture&gt; </p> <p class="popupText3 inline drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"> again? Try it now!</p>
                    <p class="popupText popupText4 inline text-white drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"></p> <p class="popupText5 inline text-red-300 drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"></p> <p class="popupText6 inline text-white drop-shadow-[5px_5px_0px_#020617] max-md:text-xs"></p>
                    
                </div>
                
            </div>

            <!-- MASCOT -->
                        
            <img src="/Assets/Images/mascot.gif" class="w-100 h-auto max-md:w-40" alt="mascot">
            

        </div>

        <div class="h-[170vh] w-[2px] bg-[#3E4B5E] max-md:hidden"></div>

        <!-- SECURE XSS PAGE SECTION -->
        <div class="xssPageSection flex items-center justify-center w-[50vw] h-full max-md:h[50vh] max-md:w-full">

            <div class="bg-[#1E293B] border-3 border-[#3E4B5E] rounded-lg p-6 m-12">
                <h1 class="dashboardHeading  w-full text-center text-2xl font-['Press_Start_2P'] font-bold drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] mb-10 text-green-400">XSS Secure Page</h1>
                
                <div class="bg-[#3E4B5E] border-l-6 border-[#0F172A] p-4 mb-6" role="alert">
                        <p class="font-bold text-[#0F172A]">NOTE</p>
                        <p class="text-[#0F172A]">This page implements security against XSS attacks.</p>
                </div>
                
                <h2 class="text-xl text-white font-semibold mb-6">Leave a Comment</h2>
                <form id="commentForm" method="POST" action="" class="mb-6">
                <div class="mb-4">
                        <!-- <label for="name" class="block mb-3 font-semibold text-xl text-blue-100 ">Your Name:</label> -->
                        <input type="text" placeholder="Your Name" id="name" name="name" required class="w-full p-3 border-3 border-[#3E4B5E] font-semibold text-white rounded-md placeholder-[#3E4B5E] focus:border-white outline-none">
                    </div>
                    <div class="mb-4">
                        <!-- <label for="comment" class="block mb-1">Your Comment:</label> -->
                        <textarea id="comment" placeholder="Your Commment..." name="comment" rows="4" required class="w-full p-3 border-3 border-[#3E4B5E] font-semibold text-white rounded-md placeholder-[#3E4B5E] focus:border-white outline-none"></textarea>
                    </div>
                    <div>
                        <button type="submit" id="postComment" class="submitButton hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] flex items-center justify-center font-bold w-full mt-6 bg-[#3E4B5E] text-[#0F172A] text-xl hover:text-[#3E4B5E] py-3 rounded-md hover:bg-[#0F172A] transition duration-300 mb-6">Post Comment</button>
                        <a href="xss.html" class="flex items-center justify-center w-full py-3 mt-6 bg-[#3E4B5E] text-[#0F172A] font-bold text-xl px-4  rounded hover:bg-[#0F172A] hover:text-[#3E4B5E] transition-colors duration-500">
                            Go Back
                        </a>
                    </div>
                </form>
                
                <h2 class="text-xl text-white font-semibold mb-6">Comments</h2>
                <?php
                // Display submitted comment (protected against XSS)
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['comment'])) {
                    // Sanitize inputs using htmlspecialchars
                    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
                    $comment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');
                    
                    echo '<div class="bg-[#3E4B5E] border-l-6 border-[#0F172A] p-4 mb-20">';
                    echo '<p><strong>Name:</strong> ' . $name . '</p>';
                    echo '<p><strong>Comment:</strong> ' . $comment . '</p>';
                    echo '</div>';
                }
                ?>
                
                <h2 class="text-xl text-white font-semibold mb-6">Security Measures</h2>
                <ul class="list-disc pl-5 space-y-2">
                    <li class="text-[#3E4B5E] font-semibold mb-6">Uses POST instead of GET to prevent XSS payloads in URLs</li>
                    <li class="text-[#3E4B5E] font-semibold mb-6">Applies htmlspecialchars() to escape special characters</li>
                    <li class="text-[#3E4B5E] font-semibold mb-6">Specifies ENT_QUOTES flag to convert both single and double quotes</li>
                    <li class="text-[#3E4B5E] font-semibold mb-6">Sets character encoding explicitly to UTF-8</li>
                </ul>
                
                <h2 class="text-xl text-white font-bold mt-6 mb-3">Try It</h2>
                <p class="text-[#3E4B5E] font-semibold mb-6">Try entering the same XSS payloads that worked on the vulnerable page:</p>
                <pre class="bg-gray-100 rounded mb-8"><code>Nice post, also 
&lt;script&gt;

    let i = 0;
        while(i&lt;5){
            alert(' lol ');
            i++;
        }
        
&lt;/script&gt;</code></pre>
                <p class="mb-2 text-[#3E4B5E] font-semibold">Or try more complex payloads like image tags with onerror attributes:</p>
                <pre class="bg-gray-100 rounded mb-4"><code>&lt;img src="x" onerror="alert(' Greetings! ')"&gt;</code></pre>
                <p class="text-[#3E4B5E] font-semibold mb-6">You'll notice they are rendered as plain text rather than being executed as code.</p>
            </div>

        </div>

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
    <script src="/Malay/Animations/XssAnimation/secure_xss_animation.js"></script>

</body>
</html>