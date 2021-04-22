export let one = 1;

let two = 2;
export {two};

//default must be just one
export default function sayHi(){ 
console.log('Hello');
}

import sayHi from './main';

import * as data from './main';
import {one, two, sayHi} from './main';
import {one as first} from './main';//rename

console.log(data.one, data.two);
