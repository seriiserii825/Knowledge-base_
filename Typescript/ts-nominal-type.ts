type Credits = number & { _kind: "credits" };
type AccountNumber = number & { _kind: "accountNumber" };
const account = 12345678 as AccountNumber;
let balance = 10000 as Credits;
const amount = 3000 as Credits;
function increase(balance: Credits, amount: Credits): Credits {
  return (balance + amount) as Credits;
}
balance = increase(balance, amount);
balance = increase(balance, account);
// ^ Argument of type 'AccountNumber' is not
//
// assignable to parameter of type 'Credits'.
// //
// Type 'AccountNumber' is not assignable to type '{ _kind: "credits"; }'.
// //
// Types of property '_kind' are incompatible.
// //
// Type '"accountNumber"' is not assignable to type '"credits"'.(2345)
