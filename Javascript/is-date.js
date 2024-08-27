
export function useIsDate(str: string) {
    let [yyyy, mm, dd] = str.split(/[\.\-\/]/); // change to suit your locale
    dd = +dd;     // cast to number
    yyyy = +yyyy; // cast to number
    let mm0 = mm - 1, // js months are 0 based
        date = new Date(yyyy, mm0, dd, 15, 0, 0, 0); // normalise
    return mm0 === date.getMonth() && dd === date.getDate() && yyyy === date.getFullYear();
}
