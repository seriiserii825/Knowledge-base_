export function useGetUrlParam(value) {
  let url = new URL(window.location.href);
  let searchParams = new URLSearchParams(url.search);
  return searchParams.get(value);
}
