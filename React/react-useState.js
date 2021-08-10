  const [count, setCount] = useState(0);
  const decrement = () => {
    if (count >= 1) {
      setCount(count - 1);
    }
  };

  const handleClick = () => {
    setCount((prevCount) => prevCount + 1);
    setCount((prevCount) => prevCount + 1);
    setCount((prevCount) => prevCount + 1);
  }
