export default function unionTypes() {
// 1. Partial<T> — делает все свойства необязательными
interface User {
  name: string;
  age: number;
}

const u: Partial<User> = {
  name: "Ivan", // age можно не указывать
};
// 2. Required<T> — делает все свойства обязательными
interface Props {
  title?: string;
  count?: number;
}

const p: Required<Props> = {
  title: "Hello",
  count: 5,
};
// 3. Readonly<T> — запрещает менять свойства
interface Point {
  x: number;
  y: number;
}

const p: Readonly<Point> = { x: 1, y: 2 };
// p.x = 10  // ❌ ошибка
// 4. Record<K, T> — объект с фиксированными ключами
type Role = "admin" | "user";

const access: Record<Role, number> = {
  admin: 10,
  user: 1,
};
// 5. Pick<T, K> — выбирает несколько свойств
interface User {
  id: number;
  login: string;
  email: string;
}

const u: Pick<User, "login" | "email"> = {
  login: "ivan",
  email: "ivan@mail.com",
};
// 6. Omit<T, K> — исключает свойства
interface User {
  id: number;
  login: string;
  email: string;
}

const u: Omit<User, "id"> = {
  login: "ivan",
  email: "ivan@mail.com",
};
// 7. Exclude<T, U> — убирает из union'a лишнее
type Letters = "a" | "b" | "c";

type WithoutA = Exclude<Letters, "a">;
// "b" | "c"
// 8. Extract<T, U> — берет только совпадающие
type All = "a" | "b" | "c";
type Target = "b" | "z";

type OnlyCommon = Extract<All, Target>;
// "b"
// 9. NonNullable<T> — убирает null и undefined
type T = string | null | undefined;
type Clean = NonNullable<T>;
// string
// 10. ReturnType<T> — тип возвращаемого значения
function sum(a: number, b: number) {
  return a + b;
}

type R = ReturnType<typeof sum>; // number
// 11. Parameters<T> — типы аргументов функции
function login(name: string, age: number) {}

type P = Parameters<typeof login>; 
// [string, number]
// 12. ConstructorParameters<T>
class Car {
  constructor(public model: string, public year: number) {}
}

type Params = ConstructorParameters<typeof Car>;
// [string, number]
// 13. InstanceType<T> — тип созданного экземпляра
class Car {
  model = "BMW";
}

type C = InstanceType<typeof Car>; 
// Car
}
