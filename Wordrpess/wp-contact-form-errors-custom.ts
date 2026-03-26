const fieldMessages: Record<string, string> = {
  "your-name": "Compila il campo Nome e Cognome",
  "your-phone": "Compila il campo Telefono",
  "your-email": "Compila il campo E-mail",
  "your-message": "Compila il campo Messaggio",
};

export default function cf7Messages(): void {
  const observer = new MutationObserver((mutations) => {
    for (const mutation of mutations) {
      for (const node of mutation.addedNodes) {
        if (!(node instanceof HTMLElement)) continue;
        if (!node.classList.contains("wpcf7-not-valid-tip")) continue;

        const wrap = node.closest<HTMLElement>("[data-name]");
        if (!wrap) continue;

        const fieldName = wrap.getAttribute("data-name");
        if (fieldName && fieldMessages[fieldName]) {
          node.textContent = fieldMessages[fieldName];
        }
      }
    }
  });

  observer.observe(document.body, { childList: true, subtree: true });
}
