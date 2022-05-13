watch: {
        '$store.state': {
            deep: true,
            handler(newVal) {
                console.log(newVal, 'newVal');
                window.localStorage.setItem("state", JSON.stringify(this.$store.state));
                const lStorage = window.localStorage.getItem("state");
                console.log(JSON.parse(lStorage), 'lStorage');
            }
        },
        '$store.state.areas': {
            deep: true,
            handler(newVal) {
                //console.log(newVal, 'newVal');
                let cacheState = JSON.parse(window.localStorage.getItem("state"));
                if (cacheState.settings && cacheState.settings.serial) {
                    let to_send = {};
                    to_send.areas = this.$store.state.areas;
                    axios.post('https://varid.oneair.it/api/update-areas/'+cacheState.settings.serial, to_send).then(response => {
                        if(!response.data.success){
                            this.$EventBus.$emit('logError',response.data.error.traceback);
                        }
                    }).catch(e => {
                        console.log(e);
                    })

                }
            }
        }
    },
