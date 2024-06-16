// month/date/year
export const useFormatDate = (date: string, lang = 'en') => {
    const sections = date.split(' ');
    const date_arr = sections[0].split('/');
    const months_it = {
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
    const months_en = {
        '01': 'January',
        '02': 'February',
        '03': 'March',
        '04': 'April',
        '05': 'May',
        '06': 'June',
        '07': 'July',
        '08': 'August',
        '09': 'September',
        '10': 'October',
        '11': 'November',
        '12': 'December',
    };
    const months_ro = {
        '01': 'Ianuarie',
        '02': 'Februarie',
        '03': 'Martie',
        '04': 'Aprilie',
        '05': 'Mai',
        '06': 'Iunie',
        '07': 'Iulie',
        '08': 'August',
        '09': 'Septembrie',
        '10': 'Octombrie',
        '11': 'Noiembrie',
        '12': 'Decembrie',
    }
    const months = lang === 'it' ? months_it : lang === 'en' ? months_en : months_ro;
    const gsDayNames = [
        'Domenica',
        'Lunedì',
        'Martedì',
        'Mercoledì',
        'Giovedì',
        'Venerdì',
        'Sabato',
    ];
    const time = sections[1];
    const date_number = date_arr[1];
    const month_number = date_arr[0];
    const month_word = months[date_arr[0]];
    const year = date_arr[2];
    const param_for_date = date_arr[2] + '-' + date_arr[1] + '-' + date_arr[0];
    const date_default = new Date(param_for_date);
    const week_word = gsDayNames[date_default.getDay()];
    return {
        date_number,
        week_word,
        month_number,
        month_word,
        year,
        time
    }
}
