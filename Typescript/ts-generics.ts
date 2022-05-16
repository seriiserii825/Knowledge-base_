// Инструмент переиспользования кода
// пример: функции и объекты для разных типов данных
// T - generic type
function logTime<T>(num: T): T{
  console.log(new Date());
  return num;
}
logTime<string>('4');
logTime<number>(4);

//interface 
interface MyInterface {
  transform: <T, F>(a: T) =>  F
}

//class
class MyGen<T> {
  value: T
}

const mg = new MyGen <number>();
mg.value;

// generic can extend
interface TimeStamp {
  stamp: number
}

function logTimeStamp<T extends TimeStamp>(num: T): T{
  console.log(num.stamp);
  return num;
}


