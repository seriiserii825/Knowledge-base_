const numbers = [1, 2, 3, 4, 5];
type NumberArray = typeof numbers;
const strings = ["Hello", "World"];

function getFilrstElement<T>(array: T[]) {
  return array[0];
}

const first_element = getFilrstElement(numbers);
const first_string = getFilrstElement(strings);

/////////////////////

function getData<T>(url: string): Promise<T> {
  return fetch(url).then((response) => response.json());
}

type User = {
  id: number;
  name: string;
  age: number;
}

type Post = {
  userId: number;
  id: number;
  title: string;
  body: string;
}

type ApiResponse<T> = {
  data: T;
  isError: boolean;
}

getData<ApiResponse<User[]>>("https://jsonplaceholder.typicode.com/posts/1").then((data) => {
  console.log(data.data);
});

getData<ApiResponse<Post[]>>("https://jsonplaceholder.typicode.com/posts/1").then((data) => {
  console.log(data.data);
});

/////////////////////////

function processing<T>(data: T): T {
  return data;
}

interface ProcessingFn {
  <T>(data: T): T;
}

let newFunc: ProcessingFn = processing;

interface DataSaver {
  processing: ProcessingFn
}
