import gsap from "gsap";
export default function servicesHover() {
  const services_items = document.querySelectorAll(".services__item");

  gsap.utils.toArray(services_items).forEach((services_item: any) => {
    const title = services_item.querySelector(".services__title");
    const content = services_item.querySelector(".services__content");
    const before = services_item.querySelector(".services__before");
    const after = services_item.querySelector(".services__after");
    const duration = 0.5;

    const item_height = services_item.clientHeight;
    const title_height = title.clientHeight;
    const content_height = content.clientHeight;
    const title_y_center = item_height / 2 - (title_height + content_height - 30); 
    const content_y_center = item_height / 2 - content_height;

    gsap.set([content, before, after], { opacity: 0 });
    gsap.set(title, { y: 0, color: "#000827", textAlign: "center" });
    gsap.set(before, { y: "100%" });

    const after_hover = gsap.to(after, { opacity: 0.4, duration });
    const before_hover = gsap.to(before, { opacity: 1, y: 0, duration });
    const title_hover = gsap.to(title, {
      y: title_y_center,
      color: "#fff",
      textAlign: "left",
      duration,
    });
    const content_hover = gsap.to(content, { opacity: 1, y: content_y_center, duration });

    after_hover.reverse();
    before_hover.reverse();
    title_hover.reverse();
    content_hover.reverse();

    services_item.addEventListener("mouseenter", () => {
      after_hover.play();
      before_hover.play();
      title_hover.play();
      content_hover.play();
    });
    services_item.addEventListener("mouseleave", () => {
      after_hover.reverse();
      before_hover.reverse();
      title_hover.reverse();
      content_hover.reverse();
    });
  });
}
