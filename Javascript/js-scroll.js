html {
  scroll-behavior: smooth;
}
// Scroll to specific values
// scrollTo is the same
window.scroll({
  top: 2500, 
  left: 0, 
  behavior: 'smooth'
});

// Scroll certain amounts from current position 
window.scrollBy({ 
  top: 100, // could be negative value
  left: 0, 
  behavior: 'smooth' 
});

// Scroll to a certain element
document.querySelector('.hello').scrollIntoView({ 
  behavior: 'smooth' 
});

// Scroll to element
 const homeIntro = document.querySelector('.home-intro');
    const homeIntroHeight = homeIntro.clientHeight;

    homeIntro.addEventListener('scroll', () => {
        if (homeIntro.offsetHeight + homeIntro.scrollTop >= homeIntro.scrollHeight) {
            homeIntro.classList.add('in-back');
            window.scrollTo({
                top: homeIntroHeight + 100,
                behavior: "smooth"
            });
        }
    })
