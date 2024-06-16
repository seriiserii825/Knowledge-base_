let tl = gsap.timeline({
  scrollTrigger: {
    start: "80% 0%",
    end: "150% 0%",
    trigger: ".home-intro",
    // play pause resume reverse reset restart complete none
    // toggleActions: "first second third fourth"
    // first: top of section hits top of viewport
    // second: bottom of section leaves top of viewport
    // third: bottom of section reentering top of viewport
    // fourth: top of section exits out
    toggleActions: "play none reverse none",
    markers: true,
  },
});
