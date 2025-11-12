export default function typeOfFunc(){
  type TCompany = {
    name: string;
    location: string;
    established: number;
    debts: number;
  }
  const company: TCompany = {
    name: "TechCorp",
    location: "New York",
    established: 2005,
    debts: 500000,
  }
  const companyKey: TCompanyKeys = "location";

  function printDebs<T, K extends keyof T, S extends keyof T>(company: T, name: K, debts: S) {
    const message = `Company: ${company[name]} has debts ${company[debts]}`
    console.log(message)
  }
  printDebs(company, 'name', 'debts')
  
  type TCompanyTypeKeys = keyof TCompany;

  type TCompanyObjectKeys = keyof typeof company;
}
