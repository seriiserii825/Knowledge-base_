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

function onChange(e) {
  console.log(e.target.value);
}

onChange = debounce(onChange, 300);
document.getElementById("search").addEventListener("keyup", onChange);
