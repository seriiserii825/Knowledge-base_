// Awaited
type A = Awaited<Promise<string>>;
// type A = string
type B = Awaited<Promise<Promise<number>>>;
// type B = number
type C = Awaited<boolean | Promise<number>>;
// type C = number | boolean
// ------------ Partial -------------
interface Todo {
  title: string;
  description: string;
}
function updateTodo(todo: Todo, fieldsToUpdate: Partial<Todo>) {
  return { ...todo, ...fieldsToUpdate };
}
const todo1 = {
  title: "organize desk",
  description: "clear clutter",
};
const todo2 = updateTodo(todo1, {
  description: "throw out trash",
});
// ------------ Required -------------
interface Props {
  a?: number;
  b?: string;
}
const obj: Props = { a: 5 };
const obj2: Required<Props> = { a: 5 }; // Error: Property 'b' is missing in type '{ a: number; }' but required in type 'Required<Props>'.
// ------------ Readonly -------------
interface Todo2 {
  title: string;
}
const todo: Readonly<Todo2> = {
  title: "Delete inactive users",
};
todo.title = "Hello"; // Error: Cannot assign to 'title' because it is a read-only property.
// ------------ Record -------------
type CatName = "miffy" | "boris" | "mordred";
interface CatInfo {
  age: number;
  breed: string;
}
const cats: Record<CatName, CatInfo> = {
  miffy: { age: 10, breed: "Persian" },
  boris: { age: 5, breed: "Maine Coon" },
  mordred: { age: 16, breed: "British Shorthair" },
};
// ------------ Pick -------------
// Constructs a type by picking the set of properties K from T
interface Todo3 {
  title: string;
  description: string;
  completed: boolean;
}
type Todo3Preview = Pick<Todo3, "title" | "completed">;
const todo3: Todo3Preview = {
  title: "Clean room",
  completed: false,
};
// ------------ Omit -------------
// Constructs a type by picking all properties from T and then removing K
interface Todo4 {
  title: string;
  description: string;
  completed: boolean;
  createdAt: number;
}
type Todo4Preview = Omit<Todo4, "description">;
const todo4: Todo4Preview = {
  title: "Clean room",
  completed: false,
  createdAt: 1615544252770,
};
type Todo4Info = Omit<Todo4, "completed" | "createdAt">;
const todoInfo: Todo4Info = {
  title: "Pick up kids",
  description: "Kindergarten closes at 5pm",
};

// ------------ Exclude -------------
type Shape =
  | { kind: "circle"; radius: number }
  | { kind: "square"; x: number }
  | { kind: "triangle"; x: number; y: number };
type T3 = Exclude<Shape, { kind: "circle" }>;

// result type T3 = { kind: "square"; x: number } | { kind: "triangle"; x: number; y: number }

//=----------- Extract -------------
// Constructs a type by extracting from T all properties that are assignable to K(oposite of Exclude)
type TShape =
  | { kind: "circle"; radius: number }
  | { kind: "square"; x: number }
  | { kind: "triangle"; x: number; y: number };
type T5 = Extract<Shape, { kind: "circle" }>;
// result type T5 = { kind: "circle"; radius: number }

// ReturnType =------------
declare function f1(): { a: number; b: string };
type T6 = ReturnType<typeof f1>;

// result type T6 = { a: number; b: string }
