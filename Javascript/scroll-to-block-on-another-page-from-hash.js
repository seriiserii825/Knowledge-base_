export default function serviceScroll() {
  const services_icons = document.querySelectorAll(".services__item");

  if (services_icons.length) {
    services_icons.forEach((icon) => {
      icon.addEventListener("click", (e) => {
        e.preventDefault();
        const href = icon.getAttribute("href");
        const hash = href?.split("#")[1];
        const url = href?.split("#")[0];
        if (!hash || !url) return;
        localStorage.setItem("services_scroll", href);
        window.location.href = url;
      });
    });
  }

  setTimeout(() => {
    scrollToBlock();
  }, 400);

  function scrollToBlock() {
    const url = localStorage.getItem("services_scroll");
    const url_hash = url?.split("#")[1];
    if (!url_hash) return;
    if (url_hash.includes("service-")) {
      const block = document.querySelector("#" + url_hash);
      if (block) {
        const block_top = block.getBoundingClientRect().top;
        const scroll_top = window.pageYOffset;
        const header = document.querySelector(".main-header");
        const header_height = header ? header.clientHeight : 0;
        const scroll_to = block_top + scroll_top - header_height;
        window.scrollTo({
          top: scroll_to,
          behavior: "smooth",
        });
        setTimeout(() => {
          localStorage.removeItem("services_scroll");
        }, 1000);
      }
    }
  }
}
