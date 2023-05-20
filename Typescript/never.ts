// if will add new payment method, we will get error
type TPaymentMethod = "cash" | "debit-card";

function pay(method: TPaymentMethod) {
  switch (method) {
    case "cash":
      //
      break;
    case "debit-card":
      //
      break;
    default:
      const _: never = method;
      throw new Error("Invalid payment method " + _);
  }
}
