https://nosir.github.io/cleave.js/
  const input_date = document.querySelector("input.input-date");
  if (input_date) {
    const input_date_all = document.querySelectorAll("input.input-date");
    input_date_all.forEach(function (input) {
      const input_id = input.getAttribute("id");

      const cleaveInput = new Cleave(`#${input_id}`, {
        date: true,
        delimiter: "/",
        datePattern: ["d", "m", "Y"],
      });
    });
  }
