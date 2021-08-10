  useEffect(() => {
    console.log("counter ", count);

    return () => {
      console.log('good buy clicker')
    }
  }, [count]);

Когда много useEffect, можно именовать стрелочные функции, чтобы понять что он делает. 
Можно повесить addEventListener в useEffect, и через return функцию removeEventListener.

