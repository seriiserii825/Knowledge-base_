function debounce(fn, ms) {
  let timeout;

  return function () {
    const fnCall = () => {
      fn.apply(this, arguments);
    };
    clearTimeout(timeout);

    timeout = setTimeout(fnCall, ms);
  };
}

function onChange(e) {
  console.log(e.target.value);
}

onChange = debounce(onChange, 500);

document.querySelector("#js-search").addEventListener("keyup", onChange);
