const user = users[0];

if (isManager(user)) {
  console.log(user.roles, "user.roles");
}

function isManager(user: TUser): user is TManagerUser {
  return user.type === "manager";
}


// Example of usage with filter and map
users.filter((user) => user.type === "manager").map((user) => user.roles);

// Using the type predicate function
users.filter(isManager).map((user) => user.roles);
