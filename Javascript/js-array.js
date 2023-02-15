const range = ({from = 0, to, step = 1, length = Math.ceil((to - from) / step)}) => Array.from({length}, (_, i) => from + i * step);

range({from = 0, to, step = 1, length = Math.ceil((to - from) / step)}){
  return Array.from({length}, (_, i) => from + i * step);
}

console.log(
  range({length: 5}), // [0, 1, 2, 3, 4]
  range({to: 5}),    // [0, 1, 2, 3, 4]
  range({from: 2, to: 5}),    // [2, 3, 4] (inclusive `from`, exclusive `to`)
  range({from: 2, length: 4}), // [2, 3, 4, 5]
  range({from: 1, to: 5, step: 2}), // [1, 3]
  range({from: 1, to: 6, step: 2}), // [1, 3, 5]
)


const rangeOfObjects = ({from = 0, to, step = 1, length = Math.ceil((to - from) / step)}) =>
    Array.from({length}, (_, i) => {
      return {[from + i * step]: from + i * step};
    });
