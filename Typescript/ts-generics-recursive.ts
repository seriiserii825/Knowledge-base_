type FilterRule = {
  field: string;
  operator: string;
  value: any;
};
type CombinatorialFilter = {
  combinator: "and" | "or";
  rules: FilterRule[];
};
type ChainedFilter = {
  rules: (CombinatorialFilter | FilterRule)[];
};
type Filter = CombinatorialFilter | ChainedFilter;

function reset<F extends Filter>(filter: F): F {
  const result = { ...filter };
  result.rules = [];

  if ("combinator" in result) {
    // фильтр — CombinatorialFilter
    result.combinator = "and";
  }
  // фильтр — ChainedFilter
  return result;
}
const filter: CombinatorialFilter = { rules: [], combinator: "or" };
const resetFilter = reset(filter); // resetFilter — это Filter


type BaseTreeItem = {
  id: string;
  children: BaseTreeItem[];
};
type TreeItem<Children extends TreeItem = BaseTreeItem> = {
  id: string;
  children: Children[];
  collapsed?: boolean;
};
function attachToRoot<T extends TreeItem>(children: T[]): TreeItem<T> {
  return {
    id: "root",
    children,
  };
}
const root = attachToRoot([
  {
    id: "child",
    children: [],
    collapsed: false,
    marked: true,
  },
]);

