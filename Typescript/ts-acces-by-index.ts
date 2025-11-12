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

  const debts = "debts";

  // Using Access Index Type to create a new type based on an existing type
  type TDebts = TCompany["debts"];
  type TDebtsType = TCompany[typeof debts];

  type TCOmpanyOwnerTGype = TCompany["management"]["owner"];

  type TCmpanyDepartment = keyof TCompany["departments"];

  type TCompanyKeysType = TCompany[keyof TCompany]

  const company: TCompany = {
    name: "TechCorp",
    location: "New York",
    established: 2005,
    debts: 500000,
    departments: {
      HR: "Human Resources",
      IT: "Information Technology",
      Sales: "Sales Department"
    },
    management: {
      owner: "Alice Johnson"
    }
  };
}
