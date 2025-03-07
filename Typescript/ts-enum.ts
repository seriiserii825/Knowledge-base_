const user = {
  name: "John",
  age: 30,
};

// enum exists
enum user2 {
  name = "John",
  age = 30,
}

// enum does not exist until will be used in the code
const enum user3 {
  name = "John",
  age = 30,
}

const alex = user3.name;

// in js file
// const alex = "John";

const enum EStatus {
  NOT_FOUND = 404,
  OK = 200,
  ERROR = 500,
}

const status1 = EStatus.OK;
