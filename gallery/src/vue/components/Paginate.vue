<script setup>
const emits = defineEmits(["emit_update_current"]);
const props = defineProps({
  current_page: { type: Number, required: true },
  total_pages: { type: Number, required: true },
  // how many page numbers to show on each side of current
  window: { type: Number, default: 1 },
});

function goPrev() {
  if (props.current_page > 1) {
    emits("emit_update_current", props.current_page - 1);
  }
}
function goNext() {
  if (props.current_page < props.total_pages) {
    emits("emit_update_current", props.current_page + 1);
  }
}
function goTo(page) {
  if (typeof page === "number" && page !== props.current_page) {
    emits("emit_update_current", page);
  }
}

/**
 * Build array like: [1, 'dots', 4,5,6, 'dots', N]
 * Mirrors your PHP logic with a tunable "window".
 */
// win — сколько показывать слева/справа от current
// edge — сколько показывать у начала и у конца (после 1 и перед N)
function buildPages(current, total, win = 1, edge = 2) {
  if (total <= 0) return [];
  const cur = Math.max(1, Math.min(current, total));

  // Собираем уникальные номера страниц (края + окно вокруг текущей)
  const set = new Set();

  // Левый край: 1..edge
  for (let i = 1; i <= Math.min(edge, total); i++) set.add(i);

  // Окно вокруг текущей: cur - win .. cur + win
  for (let i = Math.max(1, cur - win); i <= Math.min(total, cur + win); i++) set.add(i);

  // Правый край: total - edge + 1 .. total
  for (let i = Math.max(1, total - edge + 1); i <= total; i++) set.add(i);

  // Сортируем и вставляем "dots" там, где пропуск > 1
  const sorted = Array.from(set).sort((a, b) => a - b);
  const out = [];
  let prev = 0;
  for (const p of sorted) {
    if (prev && p - prev > 1) out.push("dots");
    out.push(p);
    prev = p;
  }
  return out;
}
</script>

<template>
  <ul class="paginate" role="navigation" aria-label="Pagination">
    <!-- Prev -->
    <li
      class="paginate__prev paginate__arrow"
      :class="{ disabled: current_page === 1 }"
      @click="goPrev"
      aria-label="Previous page">
      <!-- your same SVG -->
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="17"
        height="16"
        viewBox="0 0 17 16"
        fill="none">
        <path
          d="M10.7207 2.21124C10.3719 2.29124 10.2727 2.42884 10.0743 2.60484C8.48394 4.19844 6.89354 5.78884 5.29994 7.38244C5.05034 7.63204 4.94474 7.92324 5.06634 8.26564C5.11114 8.38724 5.19114 8.50884 5.28394 8.60164C6.91594 10.2432 8.55754 11.8848 10.1959 13.5232C10.4455 13.7728 10.7431 13.856 11.0759 13.7312C11.3895 13.616 11.5655 13.376 11.5975 13.0432C11.6231 12.7744 11.5175 12.5536 11.3287 12.3648C10.9511 11.9872 10.5735 11.6096 10.1959 11.232C9.15274 10.1888 8.10314 9.13924 7.05994 8.09604C7.03114 8.06724 6.99594 8.04484 6.94474 7.97444C6.94154 7.97124 6.94474 7.96804 6.94474 7.96804C6.98314 7.94564 7.02794 7.93284 7.05674 7.90404C8.47754 6.48644 9.90154 5.07204 11.3191 3.65444C11.5623 3.41124 11.6647 3.12964 11.5623 2.79364C11.4791 2.52804 11.2935 2.35204 11.0247 2.26564C10.9959 2.25604 10.9671 2.24644 10.9351 2.23684C10.8231 2.21124 10.8359 2.21124 10.7207 2.21124Z" />
      </svg>
    </li>

    <!-- Numbered pages + dots -->
    <li
      v-for="(p, idx) in buildPages(current_page, total_pages, window)"
      :key="idx + '-' + p"
      :class="{ active: p === current_page, paginate__dots: p === 'dots' }"
      :aria-current="p === current_page ? 'page' : undefined">
      <template v-if="p === 'dots'">
        <span aria-hidden="true">…</span>
      </template>
      <template v-else>
        <a href="#" @click.prevent="goTo(p)">{{ p }}</a>
      </template>
    </li>

    <!-- Next -->
    <li
      class="paginate__next paginate__arrow"
      :class="{ disabled: current_page === total_pages }"
      @click="goNext"
      aria-label="Next page">
      <!-- your same SVG (right) -->
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="17"
        height="16"
        viewBox="0 0 17 16"
        fill="none">
        <path
          d="M6.27901 2.21124C6.62781 2.29124 6.72701 2.42884 6.92541 2.60484C8.51581 4.19844 10.1062 5.78884 11.6998 7.38244C11.9494 7.63204 12.055 7.92324 11.9334 8.26564C11.8886 8.38724 11.8086 8.50884 11.7158 8.60164C10.0838 10.2432 8.44221 11.8848 6.80381 13.5232C6.55421 13.7728 6.25661 13.856 5.92381 13.7312C5.61021 13.616 5.43421 13.376 5.40221 13.0432C5.37661 12.7744 5.48221 12.5536 5.67101 12.3648C6.04861 11.9872 6.42621 11.6096 6.80381 11.232C7.84701 10.1888 8.89661 9.13924 9.93981 8.09604C9.96861 8.06724 10.0038 8.04484 10.055 7.97444C10.0582 7.97124 10.055 7.96804 10.055 7.96804C10.0166 7.94564 9.97181 7.93284 9.94301 7.90404C8.52221 6.48644 7.09821 5.07204 5.68061 3.65444C5.43741 3.41124 5.33501 3.12964 5.43741 2.79364C5.52061 2.52804 5.70621 2.35204 5.97501 2.26564C6.00381 2.25604 6.03261 2.24644 6.06461 2.23684C6.17661 2.21124 6.16381 2.21124 6.27901 2.21124Z" />
      </svg>
    </li>
  </ul>
</template>
<style>
.paginate {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  margin: 6rem auto 0;
  max-width: 900px;

  @media (max-width: 950px) {
    margin: 4rem auto 0;
  }

  li {
    flex: 0 0 4rem;
    margin: 0 0.2rem;
    height: 4rem;
    border: 2px solid transparent;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.4s;

    @media screen and (max-width: 768px) {
      margin-bottom: 4rem;
    }

    @media screen and (max-width: 576px) {
      flex: 0 0 3rem;
      height: 3rem;
    }

    &:hover,
    &.active {
      background: #203864;
      border-color: #203864;

      a {
        color: white;
      }
    }
  }

  li.paginate__arrow {
    display: flex;
    justify-content: center;
    align-items: center;
    border: 2px solid #203864;
    border-radius: 50%;

    &:hover {
      svg {
        fill: white;
      }
    }

    svg {
      fill: #203864;
      transition: all 0.4s;
    }
  }

  li.paginate__prev {
    margin-right: 4.4rem;

    @media screen and (max-width: 768px) {
      margin-right: 2.4rem;
    }
  }

  li.paginate__next {
    margin-left: 4.4rem;

    @media screen and (max-width: 768px) {
      margin-left: 2.4rem;
    }
  }
  li.paginate__dots {
    &:hover {
      background: transparent;
      border-color: transparent;
    }
  }

  a {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    transition: all 0.4s;
    color: #203864;
    font-size: 1.8rem;
    font-weight: 600;
    /* 30.6px */

    &:hover {
    }

    &.disabled {
      cursor: not-allowed !important;
      opacity: 0.6 !important;
    }
  }
}
</style>
