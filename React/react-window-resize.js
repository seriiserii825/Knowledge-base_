  const [ww, setWw] = useState(window.innerWidth);
  useEffect(() => {
    window.addEventListener('resize', function() {
      setWw(window.innerWidth);
    })
  }, []);
