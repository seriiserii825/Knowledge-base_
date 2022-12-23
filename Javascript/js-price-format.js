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


export const clearPrice = (price) => {
   /**
    * Number.prototype.format(n, x, s, c)
    *
    * @param integer n: length of decimal
    * @param integer x: length of whole part
    * @param mixed   s: sections delimiter
    * @param mixed   c: decimal delimiter
    */
   Number.prototype.format = function (n, x, s, c) {
      let re = "\\d(?=(\\d{" + (x || 3) + "})+" + (n > 0 ? "\\D" : "$") + ")",
         num = this.toFixed(Math.max(0, ~~n));

      return (c ? num.replace(".", c) : num).replace(
         new RegExp(re, "g"),
         "$&" + (s || ",")
      );
   };

   const myString = Number(price.replace(/\D/g, ""));

   return myString.format(-3, 3, ".", ","); // "12.345.678,90"
};
