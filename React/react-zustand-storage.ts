import { create, type StateCreator } from "zustand";

interface IActions {
  setSearch: (value: string) => void;
}

interface IInitialState {
  search: string;
}

interface IProductsState extends IInitialState, IActions {}

const initialState: IInitialState = {
  search: "",
};

const productsStore: StateCreator<IProductsState> = (set) => ({
  ...initialState,
  setSearch: (value: string) => set({ search: value }),
});

const useProductsStorage = create<IProductsState>()(productsStore);

export const useSearch = () => useProductsStorage((state) => state.search);
export const useSetSearch = () => useProductsStorage((state) => state.setSearch);

// Usage example:
const search = useSearch();
const setSearch = useSetSearch();
