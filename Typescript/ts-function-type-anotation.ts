type Person = {name: string};
const people = ['alice', 'bob', 'jan'].map(
  (name): Person => ({name})
); // Тип Person[]

