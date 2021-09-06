npm install -g typescript ts-node
npm install @types/node --save-dev

Когда нужно прописывать тип переменной
1. Когда переменная объявляется, но присваевается позже.
2. Когда создается переменная, но вывод о типе не может быть сделан
3. Когда функция возвращает тип any

1. 
let a;
a =10;

2. 
isPositive = false;

if(a > b) {
isPositive = true;
}else{
isPositive = minus;
}

3. let some = JSON.parse(Object);
