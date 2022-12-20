document.querySelectorAll('.price').forEach(item => {
  item.textContent = new Intl.NumberFormat('ru-Ru', {
    currency: 'rub',
    style: 'currency'
  }).format(item.textContent);
});

//vue
formatted_price() {
  let price = this.add.price;
  price = price.replace(/\.00$/g, '');
  price = price.replace(/[^0-9]/g, '');
  let nf = new Intl.NumberFormat('it-IT', {
    currency: 'EUR',
    style: 'currency',
    trailingZeroDisplay: 'stripIfInteger',
  });
  price = nf.format(price);
  this.current_price = price;
}
