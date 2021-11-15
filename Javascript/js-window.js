const termsMenu = document.querySelector(".category-list");
const termsRectTop = termsMenu.getBoundingClientRect().top;

window.addEventListener("scroll", function(event) {
    var top = this.scrollY,
        left =this.scrollX;
}, false);
