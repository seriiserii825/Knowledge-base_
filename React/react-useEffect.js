  useEffect(() => {
    console.log("counter ", count);

    return () => {
      console.log('good buy clicker')
    }
  }, [count]);

Когда много useEffect, можно именовать стрелочные функции, чтобы понять что он делает. 
Можно повесить addEventListener в useEffect, и через return функцию removeEventListener.


  useEffect(() => {
    let isMounted = true;
    async function fetchPost() {
      const result = await axios.get(`${API_AXIOS_URL}/post/${id}`);
      if (isMounted) {
        setPost(result.data);
        setLoading(false);
      }
    }
    fetchPost();

    return () => (isMounted = false);
  }, [post, id]);
