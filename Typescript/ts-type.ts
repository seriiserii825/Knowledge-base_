type TCar = {
  brand: string;
  model: string;
  year: number;
}

type TUser = {
  name: string;
  age: number;
}

function renderUser(user: TUser) {
  console.log(user);
}

function renderCar(car: TCar) {
  console.log(car);
}

function renderUserCar(userCar: TUser & TCar) {
  console.log(userCar);
}
