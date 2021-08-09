1. Create .env.local
2. Create const  REACT_APP_API_KEY=xxxxxxx
3. In component create const outsite de function or class 
const API_KEY = process.env.REACT_APP_API_KEY;

And use this key inside fetch or axios.
