import { bodyUnlock } from "../functions";

export default function menuScroll() {
    const is_home = document.querySelector("body.home");
    const menu_links = document.querySelectorAll("#js-main-menu a");
    menu_links.forEach((link) => {
        link.addEventListener("click", function(e) {
            e.preventDefault();
            const href = e.currentTarget.getAttribute("href");
            if (is_home) {
                const element = document.querySelector(href);
                clearActive();
                element.classList.add("active");
                const element_top = element.offsetTop;
                window.scrollTo({
                    top: element_top - 100,
                    behavior: "smooth",
                });
                menuClose();
            } else {
                window.location.href = window.location.origin + href;
            }
        });
    });
    document.addEventListener(
        "scroll",
        function() {
            const scrollPosition =
                document.documentElement.scrollTop || document.body.scrollTop;
            menu_links.forEach((link) => {
                const href = link.getAttribute("href");
                const element = document.querySelector(href);
                if (
                    scrollPosition >= element.offsetTop - 100 &&
                    scrollPosition < element.offsetTop + element.offsetHeight - 100
                ) {
                    clearActive();
                    if (!link.classList.contains("active")) {
                        link.classList.add("active");
                    }
                }
            });
        },
        {
            passive: true,
        }
    );
    function clearActive() {
        menu_links.forEach((link) => {
            link.classList.remove("active");
        });
    }
    function menuClose() {
        const menu = document.querySelector(".main-header__menu");
        const iconMenu = document.querySelector(".icon-menu");
        menu.classList.remove("active");
        iconMenu.classList.remove("_active");
        bodyUnlock(0);
    }
}
