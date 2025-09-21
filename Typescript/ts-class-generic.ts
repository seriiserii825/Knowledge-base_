export default {};

// class Storage<T extends string> {
class Storage<T> {
  items: Array<T>;

  constructor() {
    this.items = [];
  }
  addItem(item: T): void {
    this.items.push(item);
  }
  getItems(): Array<T> {
    return this.items;
  }
  removeItem(item: T): void {
    const index = this.items.indexOf(item);
    if (index !== -1) {
      this.items.splice(index, 1);
    }
  }
  clean(): void {
    this.items = [];
  }
}

const stringStorage = new Storage<string>();
stringStorage.addItem("Hello");

const clientsStorage = new Storage<{ name: string; age: number }>();
clientsStorage.addItem({
  name: "charlie",
  age: 44,
});
