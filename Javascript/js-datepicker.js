// https://www.npmjs.com/package/js-datepicker#basic-usage
import datepicker from "js-datepicker";

export default function datePicker() {
  const date_from = ".date-from";
  const date_to = ".date-to";

  const lang = document.querySelector("html")?.getAttribute("lang");
  let days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  let months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  if (lang === "it-IT") {
    days = ["Dom", "Lun", "Mar", "Mer", "Gio", "Ven", "Sab"];
    months = [
      "Gennaio",
      "Febbraio",
      "Marzo",
      "Aprile",
      "Maggio",
      "Giugno",
      "Luglio",
      "Agosto",
      "Settembre",
      "Ottobre",
      "Novembre",
      "Dicembre",
    ];
  }

  const picker_from = datepicker(date_from, {
    customDays: days,
    customMonths: months,
    dateSelected: new Date(),
    startDay: 1,
    minDate: new Date(),
    formatter: (input, date, instance) => {
      const day = date.getDate();
      const month_name = months[date.getMonth()];
      const year = date.getFullYear();
      let from = "From";
      if (lang === "it-IT") {
        from = "Dal";
      }
      input.value = `${from} ${day} ${month_name}, ${year}`;
    },
  });
  picker_from.calendarContainer.style.setProperty("font-size", "1.7rem");

  const now = new Date();
  const after_2_days = new Date(now); // Create a copy of the current date
  after_2_days.setDate(now.getDate() + 2); // Add 2 days
  const picker_to = datepicker(date_to, {
    customDays: days,
    customMonths: months,
    dateSelected: after_2_days,
    startDay: 1,
    minDate: new Date(),
    formatter: (input, date, instance) => {
      const day = date.getDate();
      const month_name = months[date.getMonth()];
      const year = date.getFullYear();
      let to = "To";
      if (lang === "it-IT") {
        to = "Al";
      }
      input.value = `${to} ${day} ${month_name}, ${year}`;
    },
  });
  picker_to.calendarContainer.style.setProperty("font-size", "1.7rem");
}
