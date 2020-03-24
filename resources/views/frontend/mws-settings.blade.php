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
                            @{{ marketplace.marketplace_name }}
                        </td>
                        <td>
                            @{{ marketplace.domain }}
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
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Seller ID</label>
                        <div class="col-md-6"><input type="text" name="name" class="form-control"> <span
                                class="invalid-feedback" style="display: none;">
                            </span></div>
                    </div> <!---->

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Marketplace</label>
                        <div class="col-md-6">
                            <select name="marketplace_id"  id="marketplace-dropdown" class="form-control">
                                <option v-for="marketplace in marketplaces" :value="marketplace.id">
                                    @{{ marketplace.domain }}
                                </option>
                            </select>
                        </div>
                    </div> <!---->
                    <div class="form-group row mb-0">
                        <div class="offset-md-4 col-md-6">
                            <button type="submit" class="btn btn-primary">

                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</mws-settings-form>
