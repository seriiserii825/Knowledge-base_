type TAdminUser = {
  type: "admin";
  id: number;
  name: string;
  accessLevel: number;
};

type TManagerUser = {
  type: "manager";
  id: number;
  name: string;
  accessLevel: number;
  roles: string[];
};

type TClientUser = {
  type: "client";
  id: number;
  name: string;
};

function loadUser(): TAdminUser | TManagerUser | TClientUser {
  return {
    type: "manager",
    id: 1,
    name: "Alice",
    accessLevel: 5,
    roles: ["editor", "viewer"],
  };
}

const user = loadUser();

if (user.type === "manager") {
  console.log(`Manager Roles: ${user.roles.join(", ")}`);
}
