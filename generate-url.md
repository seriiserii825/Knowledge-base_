# image

https://unsplash.it/800/800


export default function useAddCategoryToUrl(slug) {
    let site_url = window.location.origin;
    if (slug) {
        window.location = `${site_url}?category=${slug}`;
    } else {
        window.location = `${site_url}`;
    }
}


function getUrlValue(value) {
  let url = new URL(window.location.href);
  let searchParams = new URLSearchParams(url.search);
  return searchParams.get(value);
}
