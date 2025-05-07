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

this.current_price = this.price.replace(/\.00$/g, "");
this.current_price = clearPrice(this.current_price);
this.current_price = `${this.current_price},00`;


function clearPrice(price) {
  Number.prototype.format = function (n, x, s, c) {
    let re = "\\d(?=(\\d{" + (x || 3) + "})+" + (n > 0 ? "\\D" : "$") + ")",
      num = this.toFixed(Math.max(0, ~~n));
    return (c ? num.replace(".", c) : num).replace(new RegExp(re, "g"), "$&" + (s || ","));
  };

  const myString = Number(price.replace(/\D/g, ""));
  return "€ " + myString.format(-3, 3, ".", ","); // "12.345.678,90"
}
