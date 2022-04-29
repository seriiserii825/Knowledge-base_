//=============================== Extend
interface IPoint {
  x: number,
  y:number
};

interface I3DPoint extends IPoint {
  z: number
}


function print(point: I3DPoint): number{
  return point.x;
}

//=============================== Interface

interface ITest {
  a: string
}

interface ITest {
  b: string
}

function some(x: ITest): string{
  return x.b;
}

//================================ Cast type
const c = (point: IPoint) => {
  const e: I3DPoint = point as I3DPoint;
  return e;
}

const h =   document.querySelector('body');

