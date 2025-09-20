export default function typesInterfaces() {
  type TUser = {
    id: number;
    name: string;
  };
  type TAdmin = TUser & {
    role: "admin";
    accessLevel: number;
  };

  // =========================

  interface IUser {
    id: number;
    name: string;
  }

  interface IAdmin extends IUser {
    role: "admin";
    accessLevel: number;
  }

  // =========================
  // Type Alias vs Interface
  type A = number | string;

  // Interface Merging
  interface IAdmin {
    permissions: string[];
  }

  const admin: IAdmin = {
    id: 1,
    name: "Alice",
    role: "admin",
    accessLevel: 5,
    permissions: ["read", "write", "execute"],
  };
}
