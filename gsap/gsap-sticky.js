import ScrollTrigger from "gsap/ScrollTrigger";
export default function SingleProductSticky() {
    const productSection = document.querySelectorAll(".single-product__wrap");
    console.log(productSection, "productSection");

    if (window.innerWidth > 850) {
        productSection.forEach((section) => {
            const img = section.querySelector(".single-product__img");
            ScrollTrigger.create({
                trigger: section,
                start: "top +=80",
                end: "bottom center",
                pin: img,
                pinSpacing: false,
                // markers: true,
            });
        });
    }
}
