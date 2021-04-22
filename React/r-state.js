import React, {useState} from 'react';

const UseState = () => {
  //initialValue - можем присвоить из вне
  const initialValue = '';
  const [state, setState] = useState(initialValue);
  
  //В качестве useState, можем использовать и функцию
  const [count, setCount] = useState(() => {
    const value = localStorage.getItem('count');
    return count || 0;
  });
  
  // Можем в setState передать функцию, результат будет зависеть от предыдущего значения
  setState((prevState) => {
    return prevState + 1;
  });
  return (
    <div>
    
    </div>
  );
};
export default UseState;
