export default function productsLoopFilter() {

  if (current_taglia) {
    menu_category_links.forEach((link) => {
      addParamToLinks(link, "taglia", current_taglia);
    });
    main_menu_links.forEach((link, index) => {
      const indexes = [1, 2];
      if (indexes.includes(index)) return;
      addParamToLinks(link, "taglia", current_taglia);
    });
  }

  size_select.addEventListener("change", () => {
    addParamToUrl("taglia", size_select.value);
    window.location.reload();
  });

  function addParamToUrl(param: string, value: string) {
    const url = new URL(window.location.href);
    url.searchParams.set(param, value);
    window.history.pushState({}, "", url.toString());
  }

  function getParamFromUrl(param: string): string | null {
    const url = new URL(window.location.href);
    return url.searchParams.get(param);
  }

  function addParamToLinks(link: HTMLAnchorElement, param: string, value: string) {
    const url = new URL(link.href);
    if (value === "") {
      url.searchParams.delete(param);
      link.setAttribute("href", url.toString());
      return;
    }
    url.searchParams.set(param, value);
    link.setAttribute("href", url.toString());
  }
}
