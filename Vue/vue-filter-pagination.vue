<script setup lang="ts">
import { onMounted, Ref, ref } from "vue";
import CategoryMenu from "../components/CategoryMenu.vue";
import IconSearch from "../icons/IconSearch.vue";
import Subcategories from "../components/Subcategories.vue";
import { axiosWp } from "../utils/axios-wp";
import { IProduct, ITerm } from "../interfaces/IFilterResponse";
import ProductList from "../components/ProductList.vue";
import LoadingComponent from "../components/LoadingComponent.vue";
import Paginate from "../components/Paginate.vue";
const parent_loading = ref(true);
const child_loading = ref(true);
const current_parent_id = ref(0);
const current_child_id = ref(0);
const current_term_name = ref("");
const products_loading = ref(true);
const search = ref("");
const per_page = ref(9);
const current_page = ref(1);
const total_pages = ref(0);
const total_terms = ref<ITerm[]>([]);
const parent_terms = ref<ITerm[]>([]);
const child_terms = ref<ITerm[]>([]);
const products = ref<IProduct[]>([]);
const filtered_products = ref<IProduct[]>([]);
const paginated_products = ref<IProduct[]>([]);
const scroll_id = ref<HTMLElement | null>(null);

async function init() {
  try {
    const data = await axiosWp.get("/main-filter/v1/all");
    total_terms.value = data.data.terms;
    console.log(total_terms.value, "total_terms.value");
    parent_terms.value = total_terms.value.filter(
      (term: ITerm) => term.parent === 0
    );
    child_terms.value = total_terms.value.filter(
      (term: ITerm) => term.parent !== 0
    );
    products.value = data.data.products;
    filtered_products.value = [...products.value];
    total_pages.value = Math.ceil(
      filtered_products.value.length / per_page.value
    );
    paginateFilteredProducts();

    parent_loading.value = false;
    child_loading.value = false;
    products_loading.value = false;
  } catch (error) {
    console.log(error, "error");
    parent_loading.value = false;
    child_loading.value = false;
    products_loading.value = false;
  }
}

function emitParent(term_id: number) {
  search.value = "";
  current_page.value = 1;
  products_loading.value = true;
  current_child_id.value = 0;
  current_term_name.value = "";
  child_loading.value = true;
  current_parent_id.value = term_id;

  child_terms.value = total_terms.value.filter(
    (term: ITerm) => term.parent === term_id
  );

  filtered_products.value = [];

  products.value.forEach((product: IProduct) => {
    if (product.terms.length) {
      product.terms.forEach((term: ITerm) => {
        if (term.term_id === term_id) {
          filtered_products.value.push(product);
        }
      });
    }
  });

  total_pages.value = Math.ceil(
    filtered_products.value.length / per_page.value
  );
  paginateFilteredProducts();
  setTimeout(() => {
    child_loading.value = false;
    products_loading.value = false;
  }, 500);
}

function emitSubcategory(term: { term_id: number; term_name: string }) {
  products_loading.value = true;
  current_page.value = 1;
  current_term_name.value = term.term_name;
  current_child_id.value = term.term_id;
  search.value = "";
  if (current_parent_id.value === 0) {
    filtered_products.value = products.value.filter((product: IProduct) => {
      return (
        Array.isArray(product.terms) &&
        product.terms.some((t: ITerm) => t.name === term.term_name)
      );
    });
  } else {
    filtered_products.value = products.value.filter((product: IProduct) => {
      return (
        Array.isArray(product.terms) &&
        product.terms.some((t: ITerm) => t.term_id === term.term_id)
      );
    });
  }
  total_pages.value = Math.ceil(
    filtered_products.value.length / per_page.value
  );
  paginateFilteredProducts();
  setTimeout(() => {
    products_loading.value = false;
  }, 500);
}

function onInput() {
  filterProducts();
}

function filterProducts() {
  products_loading.value = true;
  current_page.value = 1; // Reset pagination on search/filter
  filtered_products.value = products.value.filter((product: IProduct) => {
    const matchesSearch =
      search.value.length === 0 ||
      product.title.toLowerCase().includes(search.value.toLowerCase());

    const matchesCategory =
      current_parent_id.value === 0 ||
      (Array.isArray(product.terms) &&
        product.terms.some(
          (term: ITerm) => term.term_id === current_parent_id.value
        ));

    const matchesSubcategory =
      current_child_id.value === 0 ||
      (Array.isArray(product.terms) &&
        product.terms.some(
          (term: ITerm) =>
            term.name === current_term_name.value ||
            term.term_id === current_child_id.value
        ));

    return matchesSearch && matchesCategory && matchesSubcategory;
  });
  total_pages.value = Math.ceil(
    filtered_products.value.length / per_page.value
  );
  paginateFilteredProducts();
  setTimeout(() => {
    products_loading.value = false;
  }, 500);
}

function paginateFilteredProducts() {
  const start = (current_page.value - 1) * per_page.value;
  const end = start + per_page.value;
  paginated_products.value = filtered_products.value.slice(start, end);
}

function updatePage(index: number) {
  scrollTo(scroll_id);
  products_loading.value = true;
  current_page.value = index;
  paginateFilteredProducts();
  setTimeout(() => {
    products_loading.value = false;
  }, 900);
}

function scrollTo(view: Ref<HTMLElement | null>) {
  view.value?.scrollIntoView({ behavior: "smooth" });
}

onMounted(() => {
  init();
});
</script>
<template>
  <section class="main-filter" ref="scroll_id">
    <header class="main-filter__header">
      <LoadingComponent v-if="parent_loading" />
      <CategoryMenu
        v-else-if="parent_terms && parent_terms.length"
        :terms="parent_terms"
        :active="current_parent_id"
        @emit_parent="emitParent"
      />
    </header>
    <div class="container">
      <div class="main-filter__wrap">
        <aside class="main-filter__sidebar">
          <div class="main-filter__search">
            <input
              type="text"
              @input="onInput"
              v-model="search"
              placeholder="Search"
            />
            <IconSearch />
          </div>
          <LoadingComponent v-if="child_loading" />
          <Subcategories
            v-else-if="child_terms && child_terms.length"
            :active_id="current_child_id"
            :terms="child_terms"
            @emit_subcategory="emitSubcategory"
          />
        </aside>
        <main class="main-filter__main">
          <div class="main-filter__body">
            <LoadingComponent v-if="products_loading" />
            <ProductList v-else-if="products" :products="paginated_products" />
          </div>
          <Paginate
            v-if="total_pages > 1"
            :current_page="current_page"
            :total_pages="total_pages"
            @update_current="updatePage"
          />
        </main>
      </div>
    </div>
  </section>
</template>
<style lang="scss">
.main-filter {
  padding-bottom: 15rem;
  &__body {
    min-height: 50rem;
  }
  &__header {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 12.2rem;
  }
  &__wrap {
    display: flex;
    justify-content: space-between;
    @media screen and (max-width: 768px) {
      display: block;
    }
  }
  &__sidebar {
    flex: 0 0 28.2rem;
    @media screen and (max-width: 768px) {
      margin-bottom: 6.4rem;
    }
  }
  &__main {
    flex: 1;
    padding-left: 1.6rem;
    @media screen and (max-width: 768px) {
      padding: 0;
    }
  }
  &__search {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 0.8rem;
    padding: 1.6rem;
    background: white;
    input {
      height: 2.4rem;
      font-size: 1.6rem;
      font-weight: 400;
      color: #959595;
      border: none;
      outline: 1px solid #e5e5e5;
    }
  }
}
</style>
