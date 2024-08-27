export const useClearPrice = (price) => {
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
      "$&" + (s || ","),
    );
  };

  const myString = Number(price.replace(/\D/g, ""));

  return myString.format(-3, 3, ".", ","); // "12.345.678,90"
};
