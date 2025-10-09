type Person = {
  name: string;
  age: number;
  profession: string;
};
function createDemoPerson(name: string) {
  const person = {} as Person;
  person.name = name;
  person.age = Math.floor(Math.random() * 95);
  // person.profession is not set and no error is thrown due to type assertion
  return person;
}

const person = createDemoPerson("Alice");
console.log(person.profession, "person.profession");

type Person2 = {
  name: string;
  age: number;
  profession: string;
};
function createDemoPerson2(name: string) {
  // catch the error by initializing all properties
  const person: Person2 = {
    name,
    age: Math.floor(Math.random() * 95),
  };
  return person;
}

const person2 = createDemoPerson2("Bob");
console.log(person2.profession, "person2.profession");
