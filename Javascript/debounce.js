function onChange(e) {
  console.log(e.target.value);
}
document.getElementById("search").addEventListener("keyup", onChange);
const debounce = (fn, ms) => {
  let timeout;
  return function () {
    const fnCall = () => {
      fn.apply(this, arguments);
    };
    clearTimeout(timeout);
    timeout = setTimeout(fnCall, ms);
  };
};
