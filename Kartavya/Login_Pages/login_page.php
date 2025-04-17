<?php

session_start();

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];

$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error){
    return !empty($error) ? "<p class='text-red-400 mt-2 text-sm'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm){
    return $formName === $activeForm ? '' : 'hidden';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Lexend:wght@100..900&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#020617] text-white font-['Lexend'] selection:text-yellow-400 cursor-[url('/Assets/Images/cursor_01.png'),_auto]">
    <!-- HEADER -->
    <nav class="fixed z-[999] top-0 left-0 h-[10vh] w-screen flex items-center justify-between p-4 bg-[#020617] border-b-2 border-[#3E4B5E] max-md:p-0">
        <div class="flex items-center space-x-3">
            <a href="../Karan/index.html">
                <img src="/Web-Nexus-Project/Assets/Images/logo.svg" alt="logo" class="w-12" />
            </a>
            <span class="text-2xl text-white font-bold font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] max-md:text-xs">Web-Nexus</span>
        </div>

        <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
            <a
            href="#"
            class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs"
            >Vulnerabilities</a
            >
            <a
            href="#"
            class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs"
            >About Us</a
            >
            <a
            href="#"
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
            <div>
            
            </div>
        </div>
    </nav>

    <main class="flex items-center justify-center min-h-[64vh] pt-[5vh] px-4">
    <div class="w-full max-w-md bg-[#101728] p-6 rounded-xl border-2 border-[#3E4B5E]">
        <!-- Login Form -->
        <div id="login-form" class="<?= isActiveForm('login', $activeForm) ?>">
            <form action="login_register_handler.php" method="POST">
                <h2 class="text-xl mb-4 text-green-400 font-['Press_Start_2P']">🔐 Sign In</h2>
                <?= showError($errors['login']); ?>
                <input type="email" name="email" placeholder="Email" class="w-full p-3 mb-3 bg-[#1E293B] border border-[#3E4B5E] rounded-xl text-white placeholder:pl-2 ">
                <input type="password" name="password" placeholder="Password" class="w-full p-3 mb-3 bg-[#1E293B] border border-[#3E4B5E] rounded-xl text-white placeholder:pl-2 ">
                <button type="submit" name="login"
                    class="w-full bg-green-600 hover:bg-green-700 py-2 text-xl rounded-lg text-white font-semibold rounded mt-2 transition-all hover:shadow-xl hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                    Sign In
                </button>
                <p class="text-sm mt-4 text-green-200">Don’t have an account?
                    <a href="#" onclick="showform('register-box')"
                        class="text-green-400 underline hover:text-green-300 hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                        Register
                    </a>
                </p>
            </form>
        </div>
    
        <!-- Register Form -->
        <div id="register-box" class="<?= isActiveForm('register', $activeForm) ?> hidden">
            <form action="login_register_handler.php" method="POST">
                <h2 class="text-xl font-bold mb-4 text-green-400 font-['Press_Start_2P']">📝 Register</h2>
                <?= showError($errors['register']); ?>
                <input type="text" name="name" placeholder="Full Name" class="w-full p-2 mb-3 bg-[#1E293B] border border-[#3E4B5E] rounded-xl text-white placeholder:pl-2 hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                <input type="email" name="email" placeholder="Email" class="w-full p-2 mb-3 bg-[#1E293B] border border-[#3E4B5E] rounded-xl text-white placeholder:pl-2 hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                <input type="password" name="password" placeholder="Password" class="w-full p-2 mb-3 bg-[#1E293B] border border-[#3E4B5E] rounded-xl text-white placeholder:pl-2 hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                <button type="submit" name="register"
                    class="w-full bg-green-600 hover:bg-green-700 py-2 text-xl rounded-lg text-white font-semibold rounded mt-2 transition-all hover:shadow-xl hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">
                    Register
                </button>
                <p class="text-sm mt-4 text-green-200">Already have an account?
                    <a href="#" onclick="showform('login-form')"
                        class="text-green-400 underline hover:text-green-300 hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]">Login</a>
                </p>
            </form>
        </div>
    </div>
    </main>


    <!-- FOOTER SECTION -->
    <footer class="bg-gray-950 text-white py-16 mt-16">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-center md:text-left">
            <div>
                <img src="/Web-Nexus-Project/Assets/Images/logo.svg" alt="Web-Nexus Logo" class="w-24 mx-auto md:mx-0">
                <p class="mt-4 text-gray-400">Learn security the hands-on-way.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Company</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact_us.html" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">About Us</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#home" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-400">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#home" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="/Web-Nexus-Project/Karan/About Us/contact_us.html" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
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
    <script src="/Web-Nexus-Project/Malay/Animations/MisconfigAnimation/vulnerable_login_animation.js"></script>

    <script>
        function showform(id) {
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('register-box').classList.add('hidden');
            document.getElementById(id).classList.remove('hidden');
        }

        // Add this script at the end of your login_page.php file, before the closing </body> tag

        // Form validation script
        document.addEventListener('DOMContentLoaded', function() {
            // Get all forms on the page
            const loginForm = document.querySelector('#login-form form');
            const registerForm = document.querySelector('#register-box form');
            
            // Login form validation
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    const email = this.querySelector('input[name="email"]').value.trim();
                    const password = this.querySelector('input[name="password"]').value.trim();
                    let isValid = true;
                    
                    // Clear previous error messages
                    const existingErrors = this.querySelectorAll('.validation-error');
                    existingErrors.forEach(el => el.remove());
                    
                    // Email validation
                    if (!email) {
                        isValid = false;
                        showError(this.querySelector('input[name="email"]'), 'Email is required');
                    } else if (!isValidEmail(email)) {
                        isValid = false;
                        showError(this.querySelector('input[name="email"]'), 'Please enter a valid email');
                    }
                    
                    // Password validation
                    if (!password) {
                        isValid = false;
                        showError(this.querySelector('input[name="password"]'), 'Password is required');
                    }
                    
                    if (!isValid) {
                        e.preventDefault();
                    }
                });
            }
            
            // Register form validation
            if (registerForm) {
                registerForm.addEventListener('submit', function(e) {
                    const name = this.querySelector('input[name="name"]').value.trim();
                    const email = this.querySelector('input[name="email"]').value.trim();
                    const password = this.querySelector('input[name="password"]').value.trim();
                    let isValid = true;
                    
                    // Clear previous error messages
                    const existingErrors = this.querySelectorAll('.validation-error');
                    existingErrors.forEach(el => el.remove());
                    
                    // Name validation
                    if (!name) {
                        isValid = false;
                        showError(this.querySelector('input[name="name"]'), 'Full name is required');
                    }
                    
                    // Email validation
                    if (!email) {
                        isValid = false;
                        showError(this.querySelector('input[name="email"]'), 'Email is required');
                    } else if (!isValidEmail(email)) {
                        isValid = false;
                        showError(this.querySelector('input[name="email"]'), 'Please enter a valid email');
                    }
                    
                    // Password validation
                    if (!password) {
                        isValid = false;
                        showError(this.querySelector('input[name="password"]'), 'Password is required');
                    } else if (password.length < 6) {
                        isValid = false;
                        showError(this.querySelector('input[name="password"]'), 'Password must be at least 6 characters');
                    }
                    
                    if (!isValid) {
                        e.preventDefault();
                    }
                });
            }
            
            // Helper functions
            function showError(inputElement, message) {
                const errorElement = document.createElement('p');
                errorElement.classList.add('validation-error', 'text-red-400', 'text-sm', 'mt-1');
                errorElement.textContent = message;
                inputElement.parentNode.insertBefore(errorElement, inputElement.nextSibling);
                
                // Highlight the input field
                inputElement.classList.add('border-red-500');
                
                // Remove highlight when user types again
                inputElement.addEventListener('input', function() {
                    this.classList.remove('border-red-500');
                    const error = this.parentNode.querySelector('.validation-error');
                    if (error) {
                        error.remove();
                    }
                });
            }
            
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
        });
    </script>
</body>

</html>