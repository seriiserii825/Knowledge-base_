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
        'Domenica',
        'Lunedì',
        'Martedì',
        'Mercoledì',
        'Giovedì',
        'Venerdì',
        'Sabato',
    ];
    const time = sections[1];
    const date_number = date_arr[0];
    const month_number = date_arr[1];
    const month_word = months[date_arr[1]];
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
