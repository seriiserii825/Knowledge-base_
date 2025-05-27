//sort array o objects by field
compareValues(key, order = 'asc') {
    return function innerSort(a, b) {
        if (!a.hasOwnProperty(key) || !b.hasOwnProperty(key)) {
            // property doesn't exist on either object
            return 0;
        }

        const varA = (typeof a[key] === 'string') ?
            a[key].toUpperCase() : a[key];
        const varB = (typeof b[key] === 'string') ?
            b[key].toUpperCase() : b[key];

        let comparison = 0;
        if (varA > varB) {
            comparison = 1;
        } else if (varA < varB) {
            comparison = -1;
        }
        return (
            (order === 'desc') ? (comparison * -1) : comparison
        );
    };
}

// array is sorted by band, in ascending order by default
singers.sort(compareValues('band'));

// array is sorted by band in descending order
singers.sort(compareValues('band', 'desc'));

// array is sorted by name in ascending order
singers.sort(compareValues('name'));

// array is sorted by date if birth in descending order
singers.sort(compareValues('born', 'desc'));

const filials = [
  {
    id: 829,
    terms: [{ id: 153, name: "Norvegia", slug: "norvegia" }],
    title: "JWK AUDIO",
  },
  {
    id: 828,
    terms: [{ id: 152, name: "Irlanda|Regno Unito", slug: "irlandaregno-unito" }],
    title: "Karma AV",
  }
];

export default function useSortArray(arr: any) {
  const sortedArray = [...arr].sort((a, b) => {
    const nameA = a.terms[0]?.name?.toUpperCase() || "";
    const nameB = b.terms[0]?.name?.toUpperCase() || "";
    return nameA.localeCompare(nameB);
  });
  return sortedArray;
}
