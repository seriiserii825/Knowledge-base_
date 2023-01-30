export const useFormatDate = (date) => {
    const sections = date.split(' ');
    const date_arr = sections[0].split('/');
    const months = {
        '01': 'Gennaio',
        '02': 'Febbraio',
        '03': 'Marzo',
        '04': 'Aprile',
        '05': 'Maggio',
        '06': 'Giugno',
        '07': 'Luglio',
        '08': 'Agosto',
        '09': 'Settembre',
        '10': 'Ottobre',
        '11': 'Novembre',
        '12': 'Dicembre',
    };
    const gsDayNames = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
    ];
    const date_str = date_arr[0] + ' ' + months[date_arr[1]] + ' ' + date_arr[2];
    const time = sections[1];
    const date_number = date_arr[0];
    const week_word = gsDayNames[new Date(date_str).getDay()];
    const month_number = date_arr[1];
    const month_word = months[date_arr[1]];
    const year = date_arr[2];
    return {
        date_number,
        week_word,
        month_number,
        month_word,
        year,
        time
    }
}

formatDate(date) {
  console.log(date, "date");
  let options = {
    year: "numeric",
    month: "long",
    day: "numeric",
    hour: "numeric",
    minute: "numeric",
    second: "numeric",
    hour12: false
  };

  return new Intl.DateTimeFormat("ro", options).format(new Date(date));
}
