// koff, получить список x,y, чтобы использовать как отдельный тип
type TPoint = {x: number, y: number}
// P - union type for x and y
type P = keyof TPoint;

// function type
function myF(){
  return {a:1}
}

type K = ReturnType<typeof myF>


