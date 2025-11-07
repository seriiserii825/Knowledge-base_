export default function functionOverloading() {
  type TSquare = {
    aside: number;
    area: number;
  };
  type TRectangle = {
    length: number;
    width: number;
    area: number;
  };

  function calculateArea(side: number): TSquare;
  function calculateArea(width: number, height: number): TRectangle;
  function calculateArea(a: number, b?: number): TSquare | TRectangle {
    if (b) {
      const area = a * b;
      return { length: a, width: b, area };
    } else {
      const area = a * a;
      return { aside: a, area };
    }
  }

  const square = calculateArea(4);
  const rectangle = calculateArea(4, 8);
}
