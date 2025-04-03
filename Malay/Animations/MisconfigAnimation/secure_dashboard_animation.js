
// HEADER STUFF ANIMATION

gsap.from(".headerStuff", {
    y: -50,
    opacity: 0,
    duration: 2,
    stagger: 0.2,
    ease: "power4.out",
})

// DASHBOARD ANIMATION

gsap.from(".dashboardSection", {
    opacity: 0,
    duration: 2,
    ease: "power4.out",
})

// POPUP WINDOW ANIMATION
gsap.utils.toArray(".windowPopup").forEach((windowPopup) => {
    gsap.from(windowPopup, {
      scale: 0,
      translateX: "-50%",
      translateY: "-50%",
      duration: 1.2,
      ease: "power4.out",
      scrollTrigger: {
        trigger: windowPopup,
        scrub: 1,
        // end: "bottom 50%",
        toggleActions: "play reverse play reverse",
        // start: "top 85%",
        
      }
    });
});


console.log(isAdmin);
document.addEventListener("DOMContentLoaded", function () {
  if (!isAdmin) {

    // POPUP TEXT ANIMATION

    // POPUP1 TEXT ANIMATION

    const textElement1 = document.querySelector(".popupText1");

    const text1 = textElement1.textContent;
    textElement1.textContent = "";

    text1.split("").forEach(char => {
      const span = document.createElement("span");
      span.textContent = char;
      textElement1.appendChild(span);
    });

    gsap.from(
      textElement1.children,
      {
        display: "none",
        stagger: 0.05, 
        duration: 0.5,
        ease: "power4.out", 
        scrollTrigger: {
          trigger: ".popupText1",
          start: "top 40%",
        }
      }
    );

    // POPUP2 TEXT ANIMATION

    const textElement2 = document.querySelector(".popupText2");

    const text2 = textElement2.textContent;
    textElement2.textContent = "";

    text2.split("").forEach(char => {
      const span = document.createElement("span");
      span.textContent = char;
      textElement2.appendChild(span);
    });

    gsap.from(
      textElement2.children,
      {
        display: "none",
        delay: 0.5,
        stagger: 0.05,
        duration: 1,
        ease: "power4.out",
        scrollTrigger: {
          trigger: ".popupText2",
          start: "top 40%",
        }
      }
    );

    // POPUP3 TEXT ANIMATION

    const textElement3 = document.querySelector(".popupText3");

    const text3 = textElement3.textContent;
    textElement3.textContent = "";

    text3.split("").forEach(char => {
      const span = document.createElement("span");
      span.textContent = char;
      textElement3.appendChild(span);
    });

    gsap.from(
      textElement3.children,
      {
        display: "none",
        delay: 0.8,
        stagger: 0.05,
        duration: 1.5,
        ease: "power4.out",
        scrollTrigger: {
          trigger: ".popupText3",
          start: "top 40%",
        }
      }
    );

    // POPUP4 TEXT ANIMATION

    const textElement4 = document.querySelector(".popupText4");

    const text4 = textElement4.textContent;
    textElement4.textContent = "";

    text4.split("").forEach(char => {
      const span = document.createElement("span");
      span.textContent = char;
      textElement4.appendChild(span);
    });

    gsap.from(
      textElement4.children,
      {
        display: "none",
        delay: 2,
        stagger: 0.05,
        duration: 2,
        ease: "power4.out",
        scrollTrigger: {
          trigger: ".popupText4",
          start: "top 40%",
        }
      }
    );

    // POPUP5 TEXT ANIMATION

    const textElement5 = document.querySelector(".popupText5");

    const text5 = textElement5.textContent;
    textElement5.textContent = "";

    text5.split("").forEach(char => {
      const span = document.createElement("span");
      span.textContent = char;
      textElement5.appendChild(span);
    });

    gsap.from(
      textElement5.children,
      {
        display: "none",
        delay: 4.8,
        stagger: 0.05,
        duration: 2.5,
        ease: "power4.out",
        scrollTrigger: {
          trigger: ".popupText5",
          start: "top 40%",
        }
      }
    );

    // POPUP6 TEXT ANIMATION

    const textElement6 = document.querySelector(".popupText6");

    const text6 = textElement6.textContent;
    textElement6.textContent = "";

    text6.split("").forEach(char => {
      const span = document.createElement("span");
      span.textContent = char;
      textElement6.appendChild(span);
    });

    gsap.from(
      textElement6.children,
      {
        display: "none",
        delay: 5,
        stagger: 0.05,
        duration: 3,
        ease: "power4.out",
        scrollTrigger: {
          trigger: ".popupText6",
          start: "top 40%",
        }
      }
    );

    
    
  } else {
    const dashboardHeading = document.querySelector(".dashboardHeading");
    dashboardHeading.textContent = "Secure Admin Dashboard";

    // POPUP TEXT ANIMATION

    // POPUP1 TEXT ANIMATION

    const textElement1 = document.querySelector(".popupText1");

    const text1 = "Welcome Admin!, Who is totally the admin ";
    textElement1.textContent = "";

    text1.split("").forEach(char => {
      const span = document.createElement("span");
      span.textContent = char;
      textElement1.appendChild(span);
    });

    gsap.from(
      textElement1.children,
      {
        display: "none",
        stagger: 0.05, 
        duration: 0.5,
        ease: "power4.out", 
        scrollTrigger: {
          trigger: ".popupText1",
          start: "top 40%",
        }
      }
    );

    // POPUP2 TEXT ANIMATION

    const textElement2 = document.querySelector(".popupText2");

    const text2 = "";
    textElement2.textContent = "";

    text2.split("").forEach(char => {
      const span = document.createElement("span");
      span.textContent = char;
      textElement2.appendChild(span);
    });

    gsap.from(
      textElement2.children,
      {
        display: "none",
        delay: 0.5,
        stagger: 0.05,
        duration: 1,
        ease: "power4.out",
        scrollTrigger: {
          trigger: ".popupText2",
          start: "top 40%",
        }
      }
    );

    // POPUP3 TEXT ANIMATION

    const textElement3 = document.querySelector(".popupText3");

    const text3 = ""
    textElement3.textContent = "";

    text3.split("").forEach(char => {
      const span = document.createElement("span");
      span.textContent = char;
      textElement3.appendChild(span);
    });

    gsap.from(
      textElement3.children,
      {
        display: "none",
        delay: 0.8,
        stagger: 0.05,
        duration: 1.5,
        ease: "power4.out",
        scrollTrigger: {
          trigger: ".popupText3",
          start: "top 40%",
        }
      }
    );

    // POPUP4 TEXT ANIMATION

    const textElement4 = document.querySelector(".popupText4");

    const text4 = "and not some intruder";
    textElement4.textContent = "";

    text4.split("").forEach(char => {
      const span = document.createElement("span");
      span.textContent = char;
      textElement4.appendChild(span);
    });

    gsap.from(
      textElement4.children,
      {
        display: "none",
        delay: 2,
        stagger: 0.05,
        duration: 2,
        ease: "power4.out",
        scrollTrigger: {
          trigger: ".popupText4",
          start: "top 40%",
        }
      }
    );

    // POPUP5 TEXT ANIMATION

    const textElement5 = document.querySelector(".popupText5");

    const text5 = "Your data is ";
    textElement5.textContent = "";

    text5.split("").forEach(char => {
      const span = document.createElement("span");
      span.textContent = char;
      textElement5.appendChild(span);
    });

    gsap.from(
      textElement5.children,
      {
        display: "none",
        delay: 4.8,
        stagger: 0.05,
        duration: 2.5,
        ease: "power4.out",
        scrollTrigger: {
          trigger: ".popupText5",
          start: "top 40%",
        }
      }
    );

    // POPUP6 TEXT ANIMATION

    const textElement6 = document.querySelector(".popupText6");

    const text6 = "safe!";
    textElement6.textContent = "";

    text6.split("").forEach(char => {
      const span = document.createElement("span");
      span.textContent = char;
      textElement6.appendChild(span);
    });

    gsap.from(
      textElement6.children,
      {
        display: "none",
        delay: 5,
        stagger: 0.05,
        duration: 3,
        ease: "power4.out",
        scrollTrigger: {
          trigger: ".popupText6",
          start: "top 40%",
        }
      }
    );


  }
});


