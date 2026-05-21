const container_ref = ref<HTMLElement | null>(null);

function scrollTabToCenter(index: number) {
  const container = container_ref.value;
  if (!container) return;
  const tabElement = container.querySelectorAll(".typology-checkbox-select__item")[
    index
  ] as HTMLElement;
  if (!tabElement) return;
  const scrollPosition =
    tabElement.offsetLeft - container.offsetWidth / 2 + tabElement.offsetWidth / 2;
  container.scrollTo({ left: scrollPosition, behavior: "smooth" });
}
