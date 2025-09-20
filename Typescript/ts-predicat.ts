const user = users[0];

if (isManager(user)) {
  console.log(user.roles, "user.roles");
}

function isManager(user: TUser): user is TManagerUser {
  return user.type === "manager";
}
