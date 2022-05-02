class Point {
  // need to initialize !
  // x!:number
  //private x:number
  //readonly x:number just read, not write, except constructor
  x:number
  y:number 

  constructor(x: number, y: number){
    this.x = x;
    this.y = y;
  }

  func (){
    this.x = 10;
  }
}

class D3Point extends Point {
  z:number;
  constructor(x: number, y: number, z:number){
    super(x, y);
    this.z = z;
  }
}

const point = new D3Point(4, 5, 8);

//=============== Static
class StaticTest {
  static c = 'some';
  static func() {
      console.log("some");
  }
}

const e = StaticTest.c;
const c = StaticTest.func();

//=============== Abstract
abstract class AbstractClass {
  func(){}
}

class NewAbstractClass extends AbstractClass {
  newFunc(){

  }
}

const absCl = new NewAbstractClass();


//================ Interface
interface IC {
  test: () => number;
}

class D implements IC {
  test(){
    return 4;
  }
}
