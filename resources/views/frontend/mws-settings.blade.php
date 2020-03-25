<mws-settings-form inline-template>
    <div>
        <div class="card card-default">
            <div class="card-header">
                Your Marketplaces
            </div>

            <div class="card-body">
                <table class="table table-responsive">
                    <tr>
                        <th>Name</th>
                        <th>Domain</th>
                    </tr>
                    <tr v-for="marketplace in marketplaces" :key="marketplace.id">
                        <td>
                            @{{ marketplace.name }}
                        </td>
                        <td>
                            @{{ marketplace.code }}
                        </td>

                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-header">
                Add new Your Marketplace
            </div>

            <div class="card-body">
                <form role="form">

                    <div v-if="errorMessage">
                        <div class="alert alert-danger" role="alert">
                            @{{ errorMessage }}
                        </div>
                    </div>
                    <div v-if="successMessage">
                        <div class="alert alert-success" role="alert">
                            @{{ successMessage }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Seller ID</label>
                        <div class="col-md-6">
                            <input type="text" v-model="seller_id" name="name" class="form-control"> <span
                                class="invalid-feedback" style="display: none;">
                            </span></div>
                    </div> <!---->

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">MWS auth Token</label>
                        <div class="col-md-6">
                            <input type="text" v-model="mws_auth_token" name="mws_auth_token" class="form-control"> <span
                                class="invalid-feedback" style="display: none;">
                            </span>
                        </div>
                    </div> <!---->

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Marketplace</label>
                        <div class="col-md-6">
                            <select v-model="amazon_marketplace_id" name="amazon_marketplace_id"
                                    id="marketplace-dropdown" class="form-control">
                                <option v-for="marketplace in marketplaces" :value="marketplace.id">
                                    @{{ marketplace.name }}
                                </option>
                            </select>
                        </div>
                    </div> <!---->
                    <div class="form-group row mb-0">
                        <div class="offset-md-4 col-md-6">
                            <button type="button" @click="createMarketplace" class="btn btn-primary">

                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</mws-settings-form>
