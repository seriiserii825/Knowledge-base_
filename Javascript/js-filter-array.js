function filterByPosition(array, number, position) {
   return array.filter(innerArray => innerArray[position - 1] !== number);
}

const items = [
  [1, 1, 2, 4],
  [2, 1, 4, 6],
  [5, 6, 4, 1],
  [1, 6, 3, 1]
];

const newItems1 = filterByPosition(items, 1, 2);
console.log('Items1:', newItems1);

const newItems2 = filterByPosition(items, 4, 3);
console.log('Items2:', newItems2);
