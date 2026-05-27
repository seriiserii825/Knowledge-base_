const contacts_ref = ref<HTMLDivElement | null>(null);
async function emitScrollToContacts() {
  await nextTick();
  requestAnimationFrame(() => {
    // ← ждём layout
    contacts_ref.value?.scrollIntoView({ behavior: "smooth", block: "start" }); // ← явный block
  });
}
