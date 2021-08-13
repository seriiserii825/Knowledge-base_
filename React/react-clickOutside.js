import { useEffect } from "react";

function useOutsideClick(el, fn) {
  const handler = (e) => {
    let path = e.path || e.composedPath();
    if (!path.includes(el.current)) {
      fn();
    }
  }
  useEffect(() => {
    document.addEventListener('mousedown', handler);
    document.addEventListener('touchstart', handler);
    return () => {
      document.removeEventListener('mousedown', handler);
      document.removeEventListener('touchstart', handler);
    }
  }, [el, fn]);
}

export default useOutsideClick;
