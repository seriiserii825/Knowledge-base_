const debounce = (fn, ms) => {
  let timeout;
  return function () {
    const fnCall = () => {
      fn.apply(this, arguments);
    };
    clearTimeout(timeout);
    timeout = setTimeout(fnCall, ms);
  };
};

function onChange(e) {
  console.log(e.target.value);
}

onChange = debounce(onChange, 300);
document.getElementById("search").addEventListener("keyup", onChange);

// for vue
import { ref, watch } from "vue";
import { debounce } from "lodash";

const search = ref("");
const first_load = ref(true);

// Create debounced function
const debouncedFetchProjects = debounce(async () => {
  await fetchProjects();
}, 300);

watch(search, () => {
  if (first_load.value) {
    debouncedFetchProjects();
  }
});
