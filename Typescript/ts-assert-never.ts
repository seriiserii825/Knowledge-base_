type Circle = {
  radius: number;
  kind: "circle";
};
type Square = {
  x: number;
  kind: "square";
};
type Triangle = {
  x: number;
  y: number;
  kind: "triangle";
};
type Rectangle = {
  x: number;
  y: number;
  kind: "rectangle";
};
type Shape = Circle | Triangle | Square | Rectangle;

function area(shape: Shape) {
  switch (shape.kind) {
    case "circle": // Круга
      return Math.PI * shape.radius * shape.radius;
    case "triangle": // Треугольник
      return (shape.x * shape.y) / 2;
    case "square": // Квадрат
      return shape.x * shape.x;
    case "rectangle": // Прямоугольник
      return shape.x * shape.y;
    default: // Прямоугольник
      assertNever(shape);
  }
}

function assertNever(value: never) {
  console.error("Unknown value", value);
  throw Error("Not possible");
}
