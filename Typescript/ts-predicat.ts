const user = users[0];

if (isManager(user)) {
  console.log(user.roles, "user.roles");
}

function isManager(user: TUser): user is TManagerUser {
  return user.type === "manager";
}

const users = loadUser();

// Example of usage with filter and map
users.filter((user) => user.type === "manager").map((user) => user.roles);

// Using the type predicate function
users.filter(isManager).map((user) => user.roles);

function userFilterOriginal<T>(type: T) {
  return (u: TUser) => u.type === type;
}

function userFilter<T extends TUser["type"]>(type_prop: T) {
  return (u: TUser): u is Extract<TUser, { type: typeof type_prop }> => u.type === type_prop;
}
