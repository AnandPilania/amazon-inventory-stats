@extends('spark::layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Terms of Service -->
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">{{__('Orders')}}</div>

                    <div class="card-body terms-of-service">
                        <div class="col-md-12 mt-4">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Marketplace</label>

                                    <select class="form-control" name="marketplace_id">
                                        @foreach($marketplaces as $marketplace)
                                            <option
                                                {{request('marketplace_id') == $marketplace->id ?'selected':''}} value="{{$marketplace->id}}"> {{ $marketplace->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Order Status</label>
                                    <select class="form-control" name="order_status">
                                        <option value=""> All</option>
                                        @foreach(config('mws.order_statuses') as $key => $status)
                                            <option
                                                {{request('order_status') == $status ?'selected':''}} value="{{ $status}}"> {{ $status }}</option>
                                        @endforeach
                                    </select>
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
                                <a href="{{route('amazon.export', request()->all() )}}" class="btn btn-success"
                                   style="float: right">Export</a>

                                <div class="form-group">


                                </div>
                            </form>

                        </div>
                        <div class="row mt-5">
                            <div class="table-responsive">
                                <table class="table table-hover table-active">
                                    <tr>
                                        @foreach($htmlHeaders as $header)
                                            <th>{{$header}}</th>
                                        @endforeach
                                    </tr>
                                    @foreach( $orders as $order)
                                        <tr>
                                            @foreach($order as $line)
                                                <td>{{ $line}}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
