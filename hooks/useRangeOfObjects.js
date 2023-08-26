export const useRangeOfObjects = ({from = 0, to, step = 1, length = Math.ceil((to - from) / step)}) => {
    return Array.from({length}, (_, i) => {
        return {id: from + i * step, title: from + i * step};
    });
}
