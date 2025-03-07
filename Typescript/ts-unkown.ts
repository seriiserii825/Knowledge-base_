try {
  //
} catch (error) {
  // error: unknown
  if (
    error instanceof Object &&
    "test" in error &&
    typeof error.test === "function"
  ) {
    error.test();
  }
}
function test(): unknown {
  return 1;
}

const data = test();

if (typeof data === "number") {
  console.log(data.toFixed(2));
}

if (
  data instanceof Object &&
  "test" in data &&
  typeof data.test === "function"
) {
  data.test();
}
