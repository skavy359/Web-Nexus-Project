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
  delay: 1,
  ease: "power4.out",

  scrollTrigger: {
      trigger: ".yellowButtonHeader",
      // start: "top top",
  }
})

//HEADING ANIMATION
gsap.from(".heading", {
    delay: 0.8,
    y: 50,
    opacity: 0,
    duration: 2,
    stagger: 0.2,
    ease: "power4.out",

    scrollTrigger : {
      trigger: ".heading",
      start: "top 80%",
    }
})

//HEADING ANIMATION
gsap.from(".secondHeading", {
  delay: 0.8,
  y: 50,
  opacity: 0,
  duration: 2,
  stagger: 0.2,
  ease: "power4.out",

  scrollTrigger : {
    trigger: ".secondHeading",
    start: "top 80%",
  }
})

// ANOTHER HEADING ANIMATION
gsap.from(".anotherHeading", {
  // delay: 0.8,
  y: 50,
  opacity: 0,
  duration: 2,
  stagger: 0.2,
  ease: "power4.out", 

  scrollTrigger : {
    trigger: ".anotherHeading",
    start: "top 80%",
  }
})

// VULNERABILITY TILE ANIMATION
gsap.utils.toArray(".vulnerabilityTile").forEach((vulnerabilityTile) => {
    gsap.from(vulnerabilityTile, {
      opacity: 0,
      duration: 2.5,
      ease: "power4.out",

      scrollTrigger : {
        trigger: vulnerabilityTile,
        start: "top 80%",
      }

    });
});

// REVIEW HEADING ANIMATION 
gsap.from(".reviewHeading", {
    duration: 2,
    opacity: 0,
    y: 50,
    stagger: 0.2,
    ease: "power4.out",
    scrollTrigger : {
      trigger: ".reviewHeading",
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

