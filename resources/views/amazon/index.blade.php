@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <!-- Terms of Service -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-default">
                    <div class="card-header">{{__('Orders')}}</div>

                    <div class="card-body terms-of-service">
                        <div class="col-md-12 mt-4">
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Marketplace</label>

                                    <select class="form-control" name="marketplace_id">
                                        @foreach($marketplaces as $marketplace)
                                            <option {{request('marketplace_id') == $marketplace->id ?'selected':''}} value="{{$marketplace->id}}"> {{ $marketplace->name }}</option>
                                        @endforeach
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted">Select the Marketplace.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Start Date</label>
                                    <input type="text" name="start_date" id="start_date" class="form-control"
                                           value="{{request('start_date')}}"

                                           placeholder="Start Date">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">End Date</label>
                                    <input type="text" class="form-control"
                                           id="end_date"
                                           value="{{request('end_date')}}"
                                           name="end_date"
                                           placeholder="End Date">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('amazon.export', request()->all() )}}" class="btn btn-success" style="float: right">Export</a>

                                <div class="form-group">



                                </div>
                            </form>

                        </div>
                        <div class="row mt-5">
                            <div class="table-responsive">
                                <table class="table table-hover table-active">
                                    <tr>
                                        <th>Marketplace Id</th>
                                        <th> SKU</th>
                                        <th>Date</th>
                                        <th>Sold</th>
                                    </tr>
                                    @foreach( $orders as $order)
                                        <tr>
                                            <td>{{ $order->marketplace_id }}</td>
                                            <td> {{ $order->sku }}</td>
                                            <td>{{ $order->purchase_date }}</td>
                                            <td>{{ $order->sold }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{ $orders->appends(request()->query())->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
