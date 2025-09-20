export default function routesNever() {
  type Component = () => string;

  type RouteRecordBase = {
    path: string;
  };

  type RouteRecordComponent = RouteRecordBase & {
    component: Component;
    children?: RouteRecord[];
    redirect?: never;
  };
  type RouteRecordRedirect = RouteRecordBase & {
    redirect: string;
    component?: never;
    children?: never;
  };

  type RouteRecord = RouteRecordRedirect | RouteRecordComponent;

  createRouter([
    {
      path: "/",
      component: () => "Home Page",
    },
    {
      path: "/about",
      redirect: "/info",
    },
    {
      path: "/products",
      component: () => "Products Page",
      children: [
        {
          path: "electronics",
          component: () => "Electronics Page",
        },
      ],
    },
  ]);

  function createRouter(routes: RouteRecord[]) {
    console.log("Router initialized with routes:", routes);
  }
}
