<div class="services__item">
  <div class="services__img">
    <img src="<?php echo $image['url']; ?>" class="services__image" alt="<?php echo $image['alt']; ?>" />
  </div>
  <div class="services__content">
    <h3 class="services__subtitle"><?php echo $subtitle; ?></h3>
    <div class="services__text text">
      <div class="wrapper">
        <div class="inner">
          <?php echo $text; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .wrapper {
    display: grid;
    grid-template-rows: 0fr;
    transition: grid-template-rows 0.5s ease-out;
  }

  .wrapper.is-open {
    grid-template-rows: 1fr;
  }

  .inner {
    overflow: hidden;
  }
</style>
<script>
  export default function servicesText() {
    const items = document.querySelectorAll(".services__item");
    items.forEach((item) => {
      item.addEventListener("mouseenter", (e) => {
        const wrapper = item.querySelector(".wrapper");
        if (!wrapper) return;
        if (wrapper.classList.contains("is-open")) return;
        wrapper.classList.add("is-open");
      });
    });
  }

// toggleAll
export default function whyUsAccordion() {
  const headers = document.querySelectorAll(".why-us__header");

  headers.forEach((header, index) => {
    header.addEventListener("click", (e) => {
			headers.forEach((elem, inner_index) => {
				if (index === inner_index) return;
				const item = elem.closest(".why-us__item");
				const wrapper = item.querySelector(".why-us__body");
				if (!wrapper) return;
				wrapper.classList.remove("is-open");
			});
			const item =  e.currentTarget.closest(".why-us__item");
      const wrapper = item.querySelector(".why-us__body");
      if (!wrapper) return;
			if (wrapper.classList.contains("is-open")) {
				wrapper.classList.remove("is-open");
				return;
			}
      wrapper.classList.add("is-open");
    });
  });
}

</script>
