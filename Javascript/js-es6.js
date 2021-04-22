//rest
function sum(...numbers){
console.log(numbers);
}
sum(1,2,3,4);
const arr1 = [1,3,4];
const arr2 = [5,76,3];
const res = Math.max(...arr1, ...arr2);

//Оператор разворота
const user = {
name: "user",
pass: "some"
};
const admin {
name: "admin",
pass: "1234"
}

const res = Object.assign(...user, ...admin);

//Деструктуризация

const user = {
  name: "user",
  pass: "some",
  age: {
    small: 22,
    big: 44
  }
};

const {name, pass, {small, big}} = user;

//Деструктуризация массивов
const array1 = [1,2,3,4];
const [,b,,c] = array1;

//export
export {button};
export default Slider;// export default может быть только один. 

//import
import Slider, {button} from './script.js';
import * as total from './script.js';

