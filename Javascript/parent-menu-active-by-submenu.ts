export default function parentMenuActiveBySubMenu() {
  const sub_menus = document.querySelectorAll("#js-main-menu .sub-menu");
  sub_menus.forEach((sub_menu) => {
    const children = sub_menu.querySelectorAll("li");
    children.forEach((child) => {
      if (child.classList.contains("current-menu-item")) {
        const parent_menu = sub_menu.closest("li");
        if (parent_menu) {
          parent_menu.classList.add("current-menu-item");
        }
      }
    });
  });
}
