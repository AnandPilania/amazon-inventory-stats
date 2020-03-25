const axios = require('axios');

Vue.component('mws-settings-form', {
    mounted() {
        axios.get('/amazon/marketplaces')
            .then(response => {
                this.marketplaces = response.data;
                console.log(response.data)
            });
    },
    data() {
        return {
            marketplaces: [],
            seller_id: '',
            amazon_marketplace_id: '',
            mws_auth_token: '',
            errorMessage: '',
            successMessage:''
        };
    },
    methods: {

        createMarketplace() {
            const that = this;

            axios.post('/amazon/marketplaces', {
                seller_id: this.seller_id,
                amazon_marketplace_id: this.amazon_marketplace_id,
                mws_auth_token: this.mws_auth_token
            })
                .then(response => {

                    that.marketplaces = [];
                    response.data.marketplaces.forEach((item) => {
                        that.marketplaces.push(item)
                    });
                    that.errorMessage = '';
                    that.amazon_marketplace_id = '';
                    that.mws_auth_token = '';
                    that.successMessage = response.data.message;


                })
                .catch(function (error) {

                    console.log(error.response.data.error);
                    that.errorMessage = error.response.data.error
                });
        },
    }
})
;
