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
