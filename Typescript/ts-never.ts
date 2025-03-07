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

///
type TCurrency = "USD" | "EUR" | "RUB" | "YEN";

// assert enxhaustive
function getCurrency(currency: TCurrency): string | never {
  if (currency === "USD") {
    return "$";
  }
  if (currency === "EUR") {
    return "€";
  }

  if (currency === "RUB") {
    return "₽";
  }

  const _: never = currency; // have new currency but not implemented(YEN)

  throw new Error("Currency not found");
}

getCurrency('YEN');
