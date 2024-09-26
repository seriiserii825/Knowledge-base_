import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
export default function menuScroll() {
  gsap.registerPlugin(ScrollTrigger);
  const is_home = document.querySelector("body.home");
  const menu_links = document.querySelectorAll("#js-main-menu a");
  const logo = document.querySelector(".logo a");
  clickLinks();
  clickLogo();
  if (is_home) {
    onScroll();
  }

  function menuClose() {
    const menu = document.querySelector("#js-main-menu");
    const sandwichWrap = document.querySelector("#js-sandwitch-wrap");
    menu?.classList.remove("fixed");
    sandwichWrap?.classList.toggle("sandwitch--active");
  }
  function clickLinks() {
    menu_links.forEach((link) => {
      link.addEventListener("click", function (e: any) {
        e.preventDefault();
        const li = link.closest("li");
        if (li) {
          li.classList.add("current-menu-item");
        }
        const href = e.currentTarget?.getAttribute("href");
        const hash = href?.split("#")[1];
        if (is_home) {
          if (hash) {
            // change hash in url without page reload
            window.history.pushState(null, "", href);
            const element = document.querySelector(href);
            const offset_top = 110;
            clearActive();
            element.classList.add("active");
            const viewportOffset = element.getBoundingClientRect();
            const element_top = viewportOffset.top + window.scrollY;
            const offset_total = element_top - offset_top;
            // console.log("offset_total", offset_total);
            window.scrollTo({
              top: offset_total,
              behavior: "smooth",
            });

            menuClose();
          } else {
            window.location.href = href;
          }
        } else {
          if (hash) {
            window.location.href = window.location.origin + href;
          } else {
            window.location.href = href;
          }
        }
      });
    });
  }
  function clickLogo() {
    logo?.addEventListener("click", function (e: any) {
      e.preventDefault();
      if (is_home) {
        window.scrollTo({
          top: 0,
          behavior: "smooth",
        });
      } else {
        window.location.href = window.location.origin;
      }
    });
  }
  function onScroll() {
    // Loop through all blocks
    menu_links.forEach((link) => {
      const href = link.getAttribute("href");
      const targetId = href?.split("#")[1]; // Extract the id from href (e.g., "#about" becomes "about")

      if (targetId) {
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
          // Create a ScrollTrigger for each block
          ScrollTrigger.create({
            trigger: targetElement,
            start: "top center", // When the block's top reaches the center of the viewport
            end: "bottom center", // When the block's bottom leaves the center of the viewport
            onEnter: () => setActive(link), // When the block enters the viewport
            onEnterBack: () => setActive(link), // When scrolling back up and the block enters again
            onLeave: () => removeActive(link), // When leaving the viewport
            onLeaveBack: () => removeActive(link), // When scrolling back up and the block leaves
            // markers: true, // Enable this to see where the triggers start/end (for debugging)
          });
        }
      }
    });
  }

  // Function to add the active class
  function setActive(link: any) {
    clearActive();
    link.closest('li').classList.add("current-menu-item"); // Add active class to the current link
  }

  // Function to remove the active class
  function removeActive(link: any) {
    link.closest('li').classList.remove("current-menu-item"); // Remove active class from the current link
  }

  function clearActive() {
    menu_links.forEach((link: any) => {
      link.classList.remove("active");
    });
  }
}
