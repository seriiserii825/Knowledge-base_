//======================= Check is array
const arr = [1,2, 12, 10, 14];
const value = Array.isArray(arr);
console.log(value);

//Find index
const arr = [1,2, 12, 10, 14];
const value = arr.indexOf(12);

//======================= Array methods
let value = arr.push(100); // push at the end
value = arr.pop(); // delete at the end
value = arr.unshift(999); // ad to start
value = arr.shift(); // delete from start
value = arr.slice(0, 2); // cut array
value = arr.splice(0, 1, 99); // replace
value = arr.reverse(); // reverse
value = arr.concat([1, 2, 3]); // join arrays
value = arr.join(' '); // array to string
value = 'some'.split(''); // string to array

// Unique values
let values = [3, 1, 3, 5, 2, 4, 4, 4];
let uniqueValues = [...new Set(values)];

// Find in array
let users = [
  { id: 11, name: 'Adam', age: 23, group: 'editor' },
  { id: 47, name: 'John', age: 28, group: 'admin' },
  { id: 85, name: 'William', age: 34, group: 'editor' },
  { id: 97, name: 'Oliver', age: 28, group: 'admin' }
];
let res = users.filter(it => it.name.includes('oli'));
// Нечувствительный к регистру
let res = users.filter(it => new RegExp('oli', "i").test(it.name));

//Union arrays
let arrA = [1, 4, 3, 2];
let arrB = [5, 2, 6, 7, 1];
[...new Set([...arrA, ...arrB])]; // returns [1, 4, 3, 2, 5, 6, 7]

// Пересечение в массивах
let arrA = [1, 4, 3, 2];
let arrB = [5, 2, 6, 7, 1];
arrA.filter(it => arrB.includes(it)); // returns [1, 2]
