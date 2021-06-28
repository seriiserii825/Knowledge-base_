export default {
    async fetch({ store }) {
        try {
            let promises = [];
            if (store.getters['home/home'].length === 0) {
                promises.push(store.dispatch('home/fetchHome'));
            }
            if (store.getters['solutions/getSolutions'].length === 0) {
                promises.push(store.dispatch('solutions/fetchSolutions'));
            }
            if (store.getters['tipo/getTipo'].length === 0) {
                promises.push(store.dispatch('tipo/fetchTipo'));
            }
            if (store.getters['portfolio/getPortfolio'].length === 0) {
                promises.push(store.dispatch('portfolio/fetchPortfolio'));
            }
            if(store.getters['options/getOptions'].length === 0) {
                promises.push(store.dispatch('options/fetchOptions'));
            }
            let data = await Promise.all(promises);
            console.log(data);
        } catch (e) {
            console.log(e);
        }
    },
    components: { HomeContacts, PortofolioSlider, Clients, ChiSiamo, Solutions, HomeIntro }
}
