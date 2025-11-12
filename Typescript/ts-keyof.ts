export default function keyOfFunc(){
  type TCompany = {
    name: string;
    location: string;
    established: number;
    debts: number;
  }
  type TCompanyKeys = keyof TCompany;
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
}
