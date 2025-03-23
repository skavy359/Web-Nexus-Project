const menuBtn=document.getElementById("menu-btn");
const closeBtn=document.getElementById("close-btn");
const mobileMenu=document.getElementById("mobile-menu");

menuBtn.addEventListener("click",()=>{
    mobileMenu.classList.remove("hidden");
});

closeBtn.addEventListener("click",()=>{
    mobileMenu.classList.add("hidden");
});

const darkModeToggle= document.getElementById("dark-mode-toggle");
const themeIcon=document.getElementById("theme-icon");
const body=document.documentElement;

if(localStorage.getItem("theme")==="dark"){
    body.classList.add("dark");
    themeIcon.src="/Assets/Images/light-mode.svg";
}

darkModeToggle.addEventListener("click",()=>{
    if(body.classList.contains("dark")){
        body.classList.remove("dark");
        localStorage.setItem("theme","light");
        themeIcon.src="/Assets/Images/dark-mode.svg";
    }
    else{
        body.classList.add("dark");
        localStorage.setItem("theme","dark");
        themeIcon.src="/Assets/Images/light-mode.svg";
    }
});