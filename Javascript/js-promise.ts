// promise type inference test
const a = new Promise<number>((r) => r(1));
// a is Promise<number>
type a = typeof a;
// b is number
type b = Awaited<a>;
