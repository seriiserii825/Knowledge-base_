    cookieStore.getAll().then(cookies => {
        cookies.forEach(item => {
            const name = item.name;
            let scope = "";
            let type = "";
            let part = "";
            let expires = "";

            const expiresYear = new Date(item.expires).getFullYear();
            const currentYear = new Date().getFullYear();
            const remainsYear = expiresYear - currentYear;
            switch (name) {
                case "wpglobus-language":
                case "wpglobus-language-old":
                    scope = "Registra in modo anonimo la scelta dell'utente in merito alla lingua di visualizzazione del sito";
                    type = "HTTP Cookie - Tecnico";
                    part = "Prima parte";
                    expires =  remainsYear === 1 ? "1 anno" : remainsYear;
                    switch (remainsYear) {
                        case 1:
                            expires = "1 anno";
                            break;
                        case 2:
                            expires = "2 anni";
                            break;
                        default:
                            expires = "1 anno";
                            break;
                    }
                    break;
                case "cookie_notice_accepted":
                    scope = "Registra se l'utente ha o meno visualizzato il coookie banner in modo da non mostrarlo nuovamente ad ogni visualizzazione di pagina";
                    type = "HTTP Cookie - Tecnico";
                    part = "Prima parte";
                    expires =  remainsYear === 1 ? "1 anno" : remainsYear;
                    switch (remainsYear) {
                        case 1:
                            expires = "1 anno";
                            break;
                        case 2:
                            expires = "2 anni";
                            break;
                        case remainsYear > 2:
                            expires = "Persistente";
                            break;
                        default:
                            expires = "Persistente";
                            break;
                    }
                    break;
                default:
                    break;
            }
            let table = document.querySelector('#privacy-table tbody');
            table.insertAdjacentHTML('afterbegin', `
               <tr>
                    <td>${name}</td>
                    <td>${scope}</td>
                    <td>${expires}</td>
                    <td>${type}</td>
                    <td>${part}</td>
                </tr>
            `);
        })
    })
    // cookieStore.get('NAME_OF_THE_COOKIE').then(cookies => console.log(cookies))
