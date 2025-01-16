// value
let value: unknown;
value = 'Max';
const s = value.toUpperCase(); // Error: Object is of type 'unknown'
const t = (value as string).toUpperCase(); // OK
// interface
interface UserData {
  name: string;
  age: number;
}
const user: UserData = {} // Error: Property 'name' is missing in type '{}'
const user2 = {} as UserData; // OK
user2.name = 'Max';
user2.age = 30;
// object keys
const person = {
  name: 'Max',
  age: 30
}
const keys = Object.keys(person); // Keys is string[]
const keys2 = Object.keys(person) as Array<keyof typeof person>; // Keys2 is ("name" | "age")[]
keys2.forEach(key => {
  console.log(person[key]);
});
// json
type ErrorMessage = Error | string | string[];
const apiError: ErrorMessage = JSON.parse(JSON.stringify([]));
const formated_message = (apiError as string[]).map((message) => {
  return message.toUpperCase(); // Error: Property 'toUpperCase' does not exist on type 'string | string[]'
})

// const

const test = {
  name: 'Max',
  age: 30
} as const;

type TUser = typeof test // { readonly name: "Max"; readonly age: 30; }

const months = ['Jan', 'Feb', 'Mar'] as const;
for (const month of months) {
  console.log(month); // Jan, Feb, Mar
}
months.push('Apr'); // Error: Property 'push' does not exist on type 'readonly ["Jan", "Feb", "Mar"]'
