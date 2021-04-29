export default function fixedHeader() {
  const body = document.body;
  const header = document.querySelector(".main-header");
  const mainMenu = document.querySelector(".main-menu");
  const mainMenuLinks = document.querySelectorAll(".main-menu a");
  const mainMenuItems = document.querySelectorAll(".main-menu li");
  window.addEventListener("scroll", () => {
    if (window.pageYOffset > 500) {
      if (!header.classList.contains("active")) {
        header.classList.add("active");
        const headerActive = document.querySelector(".main-header.active");
        const headerHeight = headerActive.getBoundingClientRect().height;
        body.style.paddingTop = headerHeight + "px";
        setTimeout(() => {
          header.classList.remove("main-header--hidden");
        }, 400);
      }
    } else {
      if (header.classList.contains("active")) {
        header.classList.remove("active");
        body.style.paddingTop = "0";
      }
    }
  });
  function clearClassActive() {
    mainMenuItems.forEach((item) => {
      item.classList.remove("current-menu-item");
    });
  }
  function closeMenu() {
    mainMenu.classList.remove("fixed");
    document.body.style.overflow = "";
    document.body.style.paddingRight = "initial";
    document
      .querySelector("#js-sandwitch-wrap")
      .classList.remove("sandwitch--active");
  }

  function menuClickHandler() {
    mainMenuLinks.forEach((item) => {
      item.addEventListener("click", (e) => {
        const target = e.currentTarget;
        const href = target.getAttribute("href");

        if (href.includes("#")) {
          const blockId = item.getAttribute("href");
          if (
            !document.body.classList.contains("home") &&
            href !== "#contatti"
          ) {
            window.location = "/" + href;
          } else {
            clearClassActive();
            target.closest("li").classList.add("current-menu-item");
            const blockOffsetTop = document.querySelector(blockId).offsetTop;
            window.scrollTo({ top: blockOffsetTop, behavior: "smooth" });
            closeMenu();
          }
        }
      });
    });
  }
  menuClickHandler();

  function menuActiveClassByDefault() {
    mainMenuLinks.forEach((item) => {
      const href = item.getAttribute("href");
      const windowHref = window.location.hash;

      if (href.includes("#") && windowHref === href) {
        clearClassActive();
        item.closest("li").classList.add("current-menu-item");
      }
    });
  }
  menuActiveClassByDefault();
}

