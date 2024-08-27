const url = new URL('https://example.com?foo=1&bar=2');
const params = new URLSearchParams(url.search);
You can get params also using a shorthand .searchParams property on the URL object, like this:

const params = new URL('https://example.com?foo=1&bar=2').searchParams;
params.get('foo'); // "1"
params.get('bar'); // "2" 
You read/set parameters through the get(KEY), set(KEY, VALUE), append(KEY, VALUE) API. You can also iterate over all values for (let p of params) {}.
