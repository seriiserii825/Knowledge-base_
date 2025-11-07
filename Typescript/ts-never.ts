function Store(): { username: string } | null {
  return null;
}

function getUsername(): string | never {
  const user = Store();
  if (user) {
    return user.username;
  }
  throw new Error("User not found");
}

const user_name = getUsername();

export default function neverCase() {
  type TCar = {
    name: 'car';
    engine: string;
    wheels: number;
  };
  type TShip = {
    name: 'ship';
    engine: string;
    sail: number;
  };

  type TPlane = {
    name: 'plane';
    engine: string;
    wings: number;
  };

  type TBus = {
    name: 'bus';
    engine: string;
    seats: number;
  };

  type TVehicle = TCar | TShip | TPlane | TBus; 

  function isCar(car: TVehicle): car is TCar {
    return "wheels" in car;
  }
  function isShip(ship: TVehicle): ship is TShip {
    return "sail" in ship;
  }

  function repairVehicle(vehicle: TVehicle): void {
    switch (vehicle.name) {
      case 'car':
        console.log(`Repairing car with ${vehicle.wheels} wheels and engine ${vehicle.engine}`);
        break;
      case 'ship':
        console.log(`Repairing ship with ${vehicle.sail} sails and engine ${vehicle.engine}`);
        break;
      case 'plane':
        console.log(`Repairing plane with ${vehicle.wings} wings and engine ${vehicle.engine}`);
        break;
      case 'bus':
        console.log(`Repairing bus with ${vehicle.seats} seats and engine ${vehicle.engine}`);
        break;
      default:
        const _exhaustiveCheck: never = vehicle;
        throw new Error(`Unhandled vehicle type: ${_exhaustiveCheck}`);
    }
  }
}
