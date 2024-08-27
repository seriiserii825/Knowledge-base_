export default function menuScroll() {
  const is_home = document.querySelector("body.home");
  const menu_links = document.querySelectorAll("#js-main-menu a");
  menu_links.forEach((link) => {
    link.addEventListener("click", function (e: any) {
      e.preventDefault();
      clearLiActive();
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
          console.log("offset_total", offset_total);
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
  if (is_home) {
    document.addEventListener(
      "scroll",
      function () {
        const scrollPosition =
          document.documentElement.scrollTop || document.body.scrollTop;
        menu_links.forEach((link) => {
          const href = link.getAttribute("href");
          const hash = href?.split("#")[1];
          if (hash) {
            const element = document.querySelector(href);
            if (
              element &&
              scrollPosition >= element.offsetTop - 100 &&
              scrollPosition < element.offsetTop + element.offsetHeight - 100
            ) {
              clearActive();
              const li = link.closest("li");
              if (!li?.classList.contains("current-menu-item")) {
                clearLiActive();
                li?.classList.add("current-menu-item");
              }
            }
          }
        });
      },
      {
        passive: true,
      }
    );
  }

  function clearActive() {
    menu_links.forEach((link: any) => {
      link.classList.remove("active");
    });
  }
  function clearLiActive() {
    const li = document.querySelectorAll("#js-main-menu li");
    li.forEach((el) => {
      el.classList.remove("current-menu-item");
    });
  }

  function menuClose() {
    const menu = document.querySelector("#js-main-menu");
    const sandwichWrap = document.querySelector("#js-sandwitch-wrap");
    menu?.classList.remove("fixed");
    sandwichWrap?.classList.toggle("sandwitch--active");
  }
}
