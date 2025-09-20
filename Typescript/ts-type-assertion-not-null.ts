// Non-null assertion operator
const app = document.getElementById("app")!;
app.innerHTML = "Hello, TypeScript!";

// Type assertion
const a = document.querySelector("a") as HTMLAnchorElement;
console.log(a.href);

// Alternative type assertion syntax
const b = <HTMLAnchorElement>document.querySelector("a");
console.log(b.href);

const input = document.querySelector("input");
if (input instanceof HTMLInputElement) {
  input.value = "TypeScript is awesome!";
}
