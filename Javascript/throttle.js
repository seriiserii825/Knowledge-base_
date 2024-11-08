function throttle(func, ms) {
  let isThrottled = false;
  let savedArgs;
  let savedThis;
  function wrapper() {
    if (isThrottled) {
      savedArgs = arguments;
      savedThis = this;
      return;
    }
    func.apply(this, arguments);
    isThrottled = true;
    setTimeout(function () {
      isThrottled = false;
      if (savedArgs) {
        wrapper.appply(savedThis, savedArgs);
        savedArgs = savedThis = null;
      }
    }, ms);
  }
  return wrapper;
}

function mouseMove(){
    console.log(newDate(), "newDate()");
}

mouseMove = throttle(mouseMove, 3000);
setInterval(mouseMove, 1000);
