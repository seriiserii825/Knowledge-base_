class AsyncM {
  x: number;
  y: number;

  constructor(x: number, y: number) {
    this.x = x;
    this.y = y;
  }

  // function signature with a callback
  sum(onDone: (result: number) => void) {
    setTimeout(() => {
      onDone(this.x + this.y);
    }, 1000);
  }
}

const asyncM = new AsyncM(5, 10);
// using the function with a callback
asyncM.sum((result) => {
  console.log(`The sum is: ${result}`);
});
