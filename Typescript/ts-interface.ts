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
const cv = (point: IPoint) => {
  const e: I3DPoint = point as I3DPoint;
  return e;
}

const h =   document.querySelector('body');


// homework
const data = {
  user: "name",
  info: {
    desc: "desc",
    isActive: true
  },
  tags: [
    {
      title: "tag",
      value: 1000
    }
  ]
}
interface IInfo  {
  desc: string
  isActive: boolean
}
interface Itags {
  title: string
  value: number
}
interface IUser  {
  userId: number
  id: number
  title: string
  info: IInfo
  tags: Itags[]
}
