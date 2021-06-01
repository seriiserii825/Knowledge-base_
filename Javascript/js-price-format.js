document.querySelectorAll('.price').forEach(item => {
  item.textContent = new Intl.NumberFormat('ru-Ru', {
    currency: 'rub',
    style: 'currency'
  }).format(item.textContent);
});
