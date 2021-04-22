import React, {useEffect} from 'react';
import somePlugin from "somePlugin";

const UseEffect = () => {
  // hook асинхронен, он не будет блокировать приложение
  
  function handler(){
  
  }
  
  // Анонимный useEffect
  useEffect(() => {
    document.addEventListener('click', handler);
    
    return () => {document.removeEventListener('click', handler)}
  }, [])
  
  //Если несколько useEffect на странице, нужно использовать именованные функции
  // Если [] пустой, то функция монтирования сработает один раз, и размонтирования тоже
  // Если [] будет отсутсвовать, то сначала произойдет размонтирование, потом монтирование только один раз
  // Если [props] не пустой, то функция размонтирования отработает столько раз, сколько раз будет менятся props
  useEffect(function initPlugin () {
    somePlugin.init();
    
    return () => {somePlugin.destroy()};
  }, []);
  
  return (
    <div>
    
    </div>
  );
};
export default UseEffect;
