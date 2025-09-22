export default {};

// class Storage<T extends string> {
class Storage<T extends { id: number }> {
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
  getItem(id: number) {
    return this.items.find((item) => item.id === id);
  }
  removeItem(id: number): void {
    this.items = this.items.filter((item) => item.id !== id);
  }
  clean(): void {
    this.items = [];
  }
}

const storage = new Storage<{ id: number; name: string }>();
storage.addItem({ id: 4, name: "george" });
