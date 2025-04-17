<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /Web-Nexus-Project/Kartavya/Login_Pages/login_page.php");
    exit;
}
?>

<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="output.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Grand+Hotel&family=Poiret+One&family=Press+Start+2P&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
      .perspective {
        perspective: 1000px;
      }
      .preserve-3d {
        transform-style: preserve-3d;
      }
      .transition-transform {
        transition: transform 0.6s;
      }
      .rotate-y-180 {
        transform: rotateY(180deg);
      }
    </style>
  </head>
  <body
    class="w-full min-h-screen bg-[url('/Web-Nexus-Project/Assets/Images/webNexusBackground.svg')] bg-cover bg-center bg-no-repeat  custom-cursor"
    
  >
    <!-- HEADER -->
    <nav class="fixed z-[999] top-0 left-0 h-[10vh] w-screen flex items-center justify-between p-4 bg-[#020617] border-b-2 border-[#3E4B5E] max-md:p-0">
      <div class="headerStuff flex items-center space-x-3">
          <img src="/Web-Nexus-Project/Assets/Images/logo.svg" alt="logo" class="w-12">
          <span class="text-2xl text-white font-bold font-['Press_Start_2P'] font-black drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] max-md:text-xs">
              Web-Nexus</span>
      </div>

      <div class="flex items-center justify-between space-x-10 max-md:space-x-4">
          <a href="/Web-Nexus-Project/Kavy/Home/Home-Page.html#vulnerabilities" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs">Vulnerabilities</a>
          <a href="/Web-Nexus-Project/Kavy/Home/Home-Page.php" class="headerStuff  hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Home</a>
          <a href="/Web-Nexus-Project/Karan/About Us/contact_us.php" class="headerStuff hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer]  text-center font-semibold text-white hover:text-gray-300 max-md:text-xs max-md:hidden">Contact Us</a>
      </div>
      
      

      <div class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] flex justify-center items-center">
              
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
    <main class="p-4 mt-20 flex flex-col items-center justify-center">
      <div class="flex justify-center gap-x-20 mt-13">
        <div class="pokedex mt-5 flex justify-center relative">
          <img
            src="/Web-Nexus-Project/Assets/Images/Pokédex.svg"
            height="240"
            width="240"
            alt="Night Sky"
            class="transform -rotate-6 ml-30"
          />

          <img src="/Web-Nexus-Project/Assets/Images/mascot.gif" class="absolute -rotate-6 h-40  -translate-y-1/2 top-[43%] left-1/2" alt="">
        </div>
        <div class="mt-5 text-center w-[40vw] max-md:w-[40vw]">
          <h1
            class="overflow-hidden drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] heading text-center text-zinc-200 text-3xl max-md:text-sm font-semibold text-left mt-20 leading-relaxed"
            style="font-family: 'Press Start 2P'"
          >
            YOUR ULTIMATE GUIDE TO OWASP TOP 10 VULNERABILITIES
          </h1>
        </div>
      </div>
      <div class="mt-20 flex flex-col items-center">
        <h1
          class="drop-shadow-[5px_5px_0px_black] drop-shadow-[-5px_-5px_0px_black] heading2 text-zinc-200 text-4xl font-semibold text-center"
          style="font-family: 'Press Start 2P'"
        >
          MEET THE TEAM
        </h1>
        <p class="heading2 text-blue-500 text-2xl font-medium text-center pt-5">
          The Team behind the website
        </p>
      </div>
      <div class="flex items-center justify-center flex-wrap gap-y-10 gap-x-20 mt-20">
        <div class="card flex flex-col items-center relative">
          <img
            src="/Web-Nexus-Project/Assets/Images/team-card-image.svg"
            height="300"
            width="300"
            alt="team card"
          />
          <img
            src="/Web-Nexus-Project/Assets/Images/red-dot.svg"
            height="80"
            width="80"
            alt="red dot"
            class="bottom-20 left-2 absolute"
          />
          <img
            src="/Web-Nexus-Project/Assets/Images/smaller-red-dots.svg"
            height="60"
            width="60"
            alt="red dot"
            class="top-7 right-28 absolute"
          />
          <div
            class="flip-card top-15 right-8 absolute preserve-3d transition-transform duration-700"
          >
            <div class="absolute backface-hidden">
              <img
                src="/Web-Nexus-Project/Assets/Images/karan.png"
                height="230"
                width="230"
                alt="sonny avatar"
                class="rounded-md border-2 border-black special-area"
              />
            </div>
            <div class="backface-hidden transform rotate-y-180">
              <img
                src="/Web-Nexus-Project/Assets/Images/karan.jpg"
                height="230"
                width="230"
                alt="sonny avatar"
                class="rounded-md border-2 border-black special-area"
              />
            </div>
          </div>
          <div>
            <p class="text-xl text-white font-semibold mt-2">Karan Attri</p>
          </div>
          <div class="flex flex-row justify-around mt-4 space-x-5">
            <a
              href="https://www.instagram.com/karan02204"
              target="_blank"
              rel="noopener noreferrer"
            >
              <img
                src="/Web-Nexus-Project/Assets/Images/instagram.jpg"
                height="45"
                width="45"
                alt="instagram"
                class="hover:transition-transform hover:scale-130 duration-300 special-area"
              />
            </a>
            <a
              href="https://github.com/Karan02204"
              target="_blank"
              rel="noopener noreferrer"
            >
              <img
                src="/Web-Nexus-Project/Assets/Images/github.png"
                height="45"
                width="45"
                alt="github"
                class="hover:transition-transform hover:scale-130 duration-300 special-area"
              />
            </a>
            <a
              href="https://www.linkedin.com/in/karanattri022"
              target="_blank"
              rel="noopener noreferrer"
            >
              <img
                src="/Web-Nexus-Project/Assets/Images/LinkedIn.jpg"
                height="45"
                width="45"
                alt="LinkedIn"
                class="hover:transition-transform hover:scale-130 duration-300 special-area"
              />
            </a>
          </div>
        </div>
        <div class="card flex flex-col items-center relative">
          <img
            src="/Web-Nexus-Project/Assets/Images/team-card-image.svg"
            height="300"
            width="300"
            alt="team card"
          />
          <img
            src="/Web-Nexus-Project/Assets/Images/red-dot.svg"
            height="80"
            width="80"
            alt="red dot"
            class="bottom-20 left-2 absolute"
          />
          <img
            src="/Web-Nexus-Project/Assets/Images/smaller-red-dots.svg"
            height="60"
            width="60"
            alt="red dot"
            class="top-7 right-28 absolute"
          />
          <div
            class="flip-card top-15 right-8 absolute preserve-3d transition-transform duration-700"
          >
            <div class="absolute backface-hidden">
              <img
                src="/Web-Nexus-Project/Assets/Images/Kavya.png"
                height="230"
                width="230"
                alt="sonny avatar"
                class="rounded-md border-2 border-black special-area"
              />
            </div>
            <div class="backface-hidden transform rotate-y-180">
              <img
                src="/Web-Nexus-Project/Assets/Images/kavya.jpeg"
                height="230"
                width="230"
                alt="sonny avatar"
                class="rounded-md border-2 border-black special-area"
              />
            </div>
          </div>
          <div>
            <p class="text-xl text-white font-semibold mt-2">Kavy Sharma</p>
          </div>
          <div class="flex flex-row justify-around mt-4 space-x-5">
            <a
              href="https://github.com/skavy359"
              target="_blank"
              rel="noopener noreferrer"
            >
              <img
                src="/Web-Nexus-Project/Assets/Images/github.png"
                height="45"
                width="45"
                alt="github"
                class="hover:transition-transform hover:scale-130 duration-300 special-area"
              />
            </a>
            <a
              href="https://www.linkedin.com/in/kavy-sharma-a1315328b/"
              target="_blank"
              rel="noopener noreferrer"
            >
              <img
                src="/Web-Nexus-Project/Assets/Images/LinkedIn.jpg"
                height="45"
                width="45"
                alt="LinkedIn"
                class="hover:transition-transform hover:scale-130 duration-300 special-area"
              />
            </a>
          </div>
        </div>
        <div class="card flex flex-col items-center relative">
          <img
            src="/Web-Nexus-Project/Assets/Images/team-card-image.svg"
            height="300"
            width="300"
            alt="team card"
          />
          <img
            src="/Web-Nexus-Project/Assets/Images/red-dot.svg"
            height="80"
            width="80"
            alt="red dot"
            class="bottom-20 left-2 absolute"
          />
          <img
            src="/Web-Nexus-Project/Assets/Images/smaller-red-dots.svg"
            height="60"
            width="60"
            alt="red dot"
            class="top-7 right-28 absolute"
          />
          <div
            class="flip-card top-15 right-8 absolute preserve-3d transition-transform duration-700"
          >
            <div class="absolute backface-hidden">
              <img
                src="/Web-Nexus-Project/Assets/Images/Malay.jpeg"
                height="230"
                width="230"
                alt="sonny avatar"
                class="rounded-md border-2 border-black special-area object-cover"
              />
            </div>
            <div class="backface-hidden transform rotate-y-180">
              <img
                src="/Web-Nexus-Project/Assets/Images/malay.jpg"
                height="230"
                width="230"
                alt="sonny avatar"
                class="rounded-md border-2 border-black object-cover special-area"
              />
            </div>
          </div>
          <div>
            <p class="text-xl text-white font-semibold mt-2">
              Malay Shikhar Soni
            </p>
          </div>
          <div class="flex flex-row justify-around mt-4 space-x-5">
            <a
              href="https://x.com/MalayShikhar"
              target="_blank"
              rel="noopener noreferrer"
            >
              <img
                src="/Web-Nexus-Project/Assets/Images/twitter.jpg"
                height="45"
                width="45"
                alt="twitter"
                class="hover:transition-transform hover:scale-130 duration-300 special-area"
              />
            </a>
            <a
              href="https://www.instagram.com/malay_shikhar_soni"
              target="_blank"
              rel="noopener noreferrer"
            >
              <img
                src="/Web-Nexus-Project/Assets/Images/instagram.jpg"
                height="45"
                width="45"
                alt="instagram"
                class="hover:transition-transform hover:scale-130 duration-300 special-area"
              />
            </a>
            <a
              href="https://github.com/MalayShikharSoni"
              target="_blank"
              rel="noopener noreferrer"
            >
              <img
                src="/Web-Nexus-Project/Assets/Images/github.png"
                height="45"
                width="45"
                alt="github"
                class="hover:transition-transform hover:scale-130 duration-300 special-area"
              />
            </a>
            <a
              href="https://www.linkedin.com/in/malay-shikhar-soni/"
              target="_blank"
              rel="noopener noreferrer"
            >
              <img
                src="/Web-Nexus-Project/Assets/Images/LinkedIn.jpg"
                height="45"
                width="45"
                alt="LinkedIn"
                class="hover:transition-transform hover:scale-130 duration-300 special-area"
              />
            </a>
          </div>
        </div>
        <div class="card flex flex-col items-center relative">
          <img
            src="/Web-Nexus-Project/Assets/Images/team-card-image.svg"
            height="300"
            width="300"
            alt="team card"
          />
          <img
            src="/Web-Nexus-Project/Assets/Images/red-dot.svg"
            height="80"
            width="80"
            alt="red dot"
            class="bottom-20 left-2 absolute"
          />
          <img
            src="/Web-Nexus-Project/Assets/Images/smaller-red-dots.svg"
            height="60"
            width="60"
            alt="red dot"
            class="top-7 right-28 absolute"
          />
          <div
            class="flip-card top-15 right-8 absolute preserve-3d transition-transform duration-700"
          >
            <div class="absolute backface-hidden">
              <img
                src="/Web-Nexus-Project/Assets/Images/kartavya.png"
                height="230"
                width="230"
                alt="sonny avatar"
                class="rounded-md border-2 border-black special-area object-cover"
              />
            </div>
            <div class="backface-hidden transform rotate-y-180">
              <img
                src="/Web-Nexus-Project/Assets/Images/kartavya.jpg"
                height="230"
                width="230"
                alt="sonny avatar"
                class="rounded-md border-2 border-black object-cover special-area"
              />
            </div>
          </div>
          <div>
            <p class="text-xl text-white text-center font-semibold mt-2">
              Kartavya Shrivastav
            </p>
          </div>
          <div class="flex flex-row justify-around mt-4 space-x-5">
            <a
              href="https://www.instagram.com/iamkartavya"
              target="_blank"
              rel="noopener noreferrer"
            >
              <img
                src="/Web-Nexus-Project/Assets/Images/instagram.jpg"
                height="45"
                width="45"
                alt="instagram"
                class="hover:transition-transform hover:scale-130 duration-300 special-area"
              />
            </a>
            <a
              href="https://github.com/Kartavya-Shrivastav"
              target="_blank"
              rel="noopener noreferrer"
            >
              <img
                src="/Web-Nexus-Project/Assets/Images/github.png"
                height="45"
                width="45"
                alt="github"
                class="hover:transition-transform hover:scale-130 duration-300 special-area"
              />
            </a>
            <a
              href="https://www.linkedin.com/in/kartavyashrivastav"
              target="_blank"
              rel="noopener noreferrer"
            >
              <img
                src="/Web-Nexus-Project/Assets/Images/LinkedIn.jpg"
                height="45"
                width="45"
                alt="LinkedIn"
                class="hover:transition-transform hover:scale-130 duration-300 special-area"
              />
            </a>
          </div>
        </div>
      </div>
      <script>
        const flipCards = document.querySelectorAll(".flip-card");

        flipCards.forEach((card) => {
          card.addEventListener("click", () => {
            card.classList.add("rotate-y-180");

            setTimeout(() => {
              card.classList.remove("rotate-y-180");
            }, 3000); // 3 seconds later it flips back
          });
        });
      </script>
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-950 text-white py-16 mt-16">
      <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-center md:text-left">
          <div>
              <img src="/Web-Nexus-Project/Assets/Images/logo.svg" alt="Web-Nexus Logo" class="w-24 mx-auto md:mx-0">
              <p class="mt-4 text-gray-400">Learn security the hands-on-way.</p>
          </div>
          <div>
              <h3 class="text-lg font-semibold text-blue-400">Company</h3>
              <ul class="mt-4 space-y-2">
                  <li><a href="/Web-Nexus-Project/Karan/About Us/contact_us.php" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">About Us</a></li>
                  <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Careers</a></li>
                  <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Blog</a></li>
              </ul>
          </div>
          <div>
              <h3 class="text-lg font-semibold text-blue-400">Support</h3>
              <ul class="mt-4 space-y-2">
                  <li><a href="/Web-Nexus-Project/Karan/About Us/contact_us.php" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Help Center</a></li>
                  <li><a href="/Web-Nexus-Project/Karan/About Us/contact_us.php" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">Contact</a></li>
                  <li><a href="#" class=" hover:cursor-[url('/Assets/Images/cursor_02.png'),_pointer] text-gray-300 hover:text-white">FAQs</a></li>
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

  </body>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/gsap.min.js" integrity="sha512-f6bQMg6nkSRw/xfHw5BCbISe/dJjXrVGfz9BSDwhZtiErHwk7ifbmBEtF9vFW8UNIQPhV2uEFVyI/UHob9r7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/ScrollTrigger.min.js" integrity="sha512-AcqPGqrrAEtEwe+ADO5R8RbdFi7tuU7b/A2cJJH0Im0D18NRk5p5s4B3E5PMuO81KFw0ClN7J5SHVUJz7KOb0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="/Web-Nexus-Project/Malay/Animations/ContactUsAnimation/contact_us_animation.js"></script>

</html>
