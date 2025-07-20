// HEADER STUFF ANIMATION

gsap.from(".headerStuff", {
    y: -50,
    opacity: 0,
    duration: 2,
    stagger: 0.2,
    ease: "power4.out",
})

// YELLOW BUTTON ANIMATION

gsap.from(".yellowButtonHeader", {
    scale: 0,
    opacity: 0,
    duration: 2,
    ease: "power4.out",
    delay: 1,

    scrollTrigger: {
        trigger: ".yellowButtonHeader",
        // start: "top top",
    }
})

//HEADING ANIMATION
gsap.from(".heading", {
    // delay: 0.8,
    x: 100,
    opacity: 0,
    duration: 3,
    stagger: 0.2,
    ease: "power4.out",

    scrollTrigger : {
        trigger: ".heading",
        start: "top 80%",
    }
})

// HEADING 2 ANIMATION
gsap.from(".heading2", {
    // delay: 0.8,
    y: 100,
    opacity: 0,
    duration: 3,
    stagger: 0.2,
    ease: "power4.out",
})


// POKEDEX ANIMATION
gsap.from(".pokedex", {
    x: -1000,
    rotate: 30,
    duration: 3.5,
    ease: "power4.out",
})

// CARD ANIMATION
gsap.from(".card", {
    scale: 0.2,
    duration: 1.2,
    stagger: 0.2,
    ease: "sine.out",

    scrollTrigger : {
        trigger: ".card",
      // start: "top 80%",
    }
});

// CONTACT US HEADING ANIMATION
gsap.from(".contactUsHeading", {
    // delay: 0.8,
    y: 70,
    opacity: 0,
    duration: 2.5,
    stagger: 0.2,
    ease: "power4.out",

    scrollTrigger : {
        trigger: ".contactUsHeading",
        start: "top 80%",
    }

});

// CONTACT US FORM ANIMATION
gsap.from(".contactUsForm", {
    opacity: 0,
    duration: 2,
    ease: "power4.out",

    scrollTrigger : {
        trigger: ".contactUsForm",
        start: "top 80%",
    }
})

//FOOTER ANIMATION

gsap.from("footer", {

    opacity: 0,
    y:100,
    duration: 2,
    ease: "power4.out",
    scrollTrigger: {
        trigger: "footer",
        start: "top 85%",
    }

});