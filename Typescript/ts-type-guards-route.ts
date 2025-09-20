type TUser = {
  id: number;
  name: string;
};

type TAdminUser = TUser & {
  type: "admin";
  accessLevel: number;
};

type TManagerUser = TUser & {
  type: "manager";
  accessLevel: number;
  roles: string[];
};

type TClientUser = TUser & {
  type: "client";
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

///////////////////////////////////////////////////////

type Component = () => string;

type RouteRecordBase = {
  path: string;
};

type RouteRecordComponent = RouteRecordBase & {
  type: "component";
  component: Component;
  children?: RouteRecord[];
};
type RouteRecordRedirect = RouteRecordBase & {
  type: "redirect";
  redirect: string;
};

type RouteRecord = RouteRecordRedirect | RouteRecordComponent;

createRouter([
  {
    type: "component",
    path: "/",
    component: () => "Home Page",
  },
  {
    type: "redirect",
    path: "/about",
    redirect: "/info",
  },
  {
    type: "component",
    path: "/products",
    component: () => "Products Page",
    children: [
      {
        type: "component",
        path: "electronics",
        component: () => "Electronics Page",
      },
    ],
  },
]);

function createRouter(routes: RouteRecord[]) {
  console.log("Router initialized with routes:", routes);
}
