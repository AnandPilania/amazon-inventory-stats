const axios = require('axios');

Vue.component('mws-settings-form', {
    props: ['team'],
    mounted() {
        console.log('Hello testing', this.marketplaces);

        axios.get('/amazon/marketplaces')
            .then(response => {
                this.marketplaces = response.data;
                console.log(response.data)
            });
    },
    data() {
        return {
            marketplaces: [],
        };
    }
});
