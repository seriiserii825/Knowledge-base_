import AirDatepicker from "air-datepicker";
import "air-datepicker/air-datepicker.css";
import localeEn from "air-datepicker/locale/en";
import localeIt from "air-datepicker/locale/it";

export default function prenotaForm() {
  const startPicker = new AirDatepicker("#startDate", {
    locale: getLang(),
    onSelect({ date }) {
      if (date && endPicker.selectedDates[0] && date > endPicker.selectedDates[0]) {
        endPicker.clear();
      }
      endPicker.update({
        minDate: date || null,
      });
    },
  });

  const endPicker = new AirDatepicker("#endDate", {
    locale: getLang(),
    onSelect({ date }) {
      if (date && startPicker.selectedDates[0] && date < startPicker.selectedDates[0]) {
        startPicker.clear();
      }
      startPicker.update({
        maxDate: date || null,
      });
    },
  });
}

function getLang(): typeof localeEn | typeof localeIt {
  const html_lang = document.querySelector("html")?.getAttribute("lang");
  if (html_lang === "it-IT") {
    return localeIt;
  } else {
    return localeEn;
  }
}
