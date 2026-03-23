<div class="accordion" id="accordion">
  <div class="accordion__item">
    <button class="accordion__header">
      Заголовок
      <svg class="accordion__icon" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5">
        <line x1="9" y1="3" x2="9" y2="15" />
        <line x1="3" y1="9" x2="15" y2="9" />
      </svg>
    </button>
    <div class="accordion__body">
      <div class="accordion__inner">
        <div class="accordion__content">
          Контент...
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .accordion__item {
    border-bottom: 0.5px solid #e0e0e0;
  }

  .accordion__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 0;
    cursor: pointer;
    user-select: none;
    font-size: 15px;
    font-weight: 500;
    background: none;
    border: none;
    width: 100%;
    text-align: left;
  }

  .accordion__icon {
    width: 18px;
    height: 18px;
    flex-shrink: 0;
    transition: transform 0.35s ease;
  }

  .accordion__item.is-open .accordion__icon {
    transform: rotate(45deg);
  }

  .accordion__body {
    display: grid;
    grid-template-rows: 0fr;
    transition: grid-template-rows 0.4s ease;
  }

  .accordion__item.is-open .accordion__body {
    grid-template-rows: 1fr;
  }

  .accordion__inner {
    overflow: hidden;
  }

  .accordion__content {
    padding: 0 0 16px;
  }
</style>
<script>
  function initAccordion(selector, {
    exclusive = false
  } = {}) {
    const accordion = document.querySelector(selector);
    if (!accordion) return;

    const items = accordion.querySelectorAll(".accordion__item");

    items.forEach((item) => {
      const header = item.querySelector(".accordion__header");
      if (!header) return;

      header.addEventListener("click", () => {
        const isOpen = item.classList.contains("is-open");

        if (exclusive) {
          items.forEach((i) => i.classList.remove("is-open"));
        }

        item.classList.toggle("is-open", !isOpen);
      });
    });
  }

  // initAccordion("#my-accordion", { exclusive: true }) // закрывает остальные
  // initAccordion("#my-accordion", { exclusive: false }) // все независимы
  // использование
  initAccordion("#accordion", {
    exclusive: true
  });
</script>
