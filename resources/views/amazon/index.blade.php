@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <!-- Terms of Service -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-default">
                    <div class="card-header">{{__('Orders')}}</div>

                    <div class="card-body terms-of-service">
                        <div class="row ">
                            <div class="col-md-12">
                                <a class="btn btn-primary float-right">Export</a>
                            </div>

                        </div>
                        <div class="row">
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
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
