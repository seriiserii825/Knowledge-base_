export default function accessIndexType() {
  type TCompany = {
    name: string;
    location: string;
    established: number;
    debts: number;
    departments: TDepartment;
    management: {
      owner: string;
    };
  };

  type TDepartment = {
    [key: string]: string;
  };

  const colors = ["red", "green", "blue"] as const;
  type Color = (typeof colors)[number];
  const new_color: Color = "red";

  const debts = "debts";

  // Using Access Index Type to create a new type based on an existing type
  type TDebts = TCompany["debts"];
  // Creating a type that represents the debts property of TCompany using a variable
  type TDebtsType = TCompany[typeof debts];

  // Creating a type that represents the owner property inside the management object
  type TCOmpanyOwnerTGype = TCompany["management"]["owner"];

  // Creating a type that represents all possible keys of the departments object
  type TCmpanyDepartment = keyof TCompany["departments"];

  // Creating a type that represents all possible value types of TCompany
  type TCompanyKeysType = TCompany[keyof TCompany];

  const company: TCompany = {
    name: "TechCorp",
    location: "New York",
    established: 2005,
    debts: 500000,
    departments: {
      HR: "Human Resources",
      IT: "Information Technology",
      Sales: "Sales Department",
    },
    management: {
      owner: "Alice Johnson",
    },
  };

  function printDebs<T, K extends keyof T, S extends keyof T>(company: T, name: K, debts: S) {
    const message = `Company: ${company[name]} has debts ${company[debts]}`;
    console.log(message);
  }
  printDebs(company, "name", "debts");

  type TCompanyTypeKeys = keyof TCompany;

  type TCompanyObjectKeys = keyof typeof company;
}
