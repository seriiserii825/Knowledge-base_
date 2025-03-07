// Partial
type User = Partial<{
  name: string;
  age: number;
  email: string;
}>; // { name?: string; age?: number; email?: string; }

// Required
type User2 = Required<User>; // { name: string; age: number; email: string; }

// Readonly
const hello: Readonly<{ test: string }> = {
  test: "test",
};
// hello.test = 44;

// Omit(Exclude)
type User3 = Omit<User, "name">; // { age: number; email: string; }

// Pick(Extract)
type User4 = Pick<User, "name" | "age">; // { name: string; age: number; }

// ReturnType
function getUser() {
  return { name: "mike", age: 23 };
}
type User5 = ReturnType<typeof getUser>; // { name: string; age: number; }

// Record
type User6 = Record<"name" | "age", string>; // { name: string; age: string; }

// NonNullable
type User7 = NonNullable<string | null | undefined>; // string

type T11 = {
  a: string;
  b: number;
  f?: () => number;
};

type F1 = ReturnType<NonNullable<T11["f"]>>; // number
