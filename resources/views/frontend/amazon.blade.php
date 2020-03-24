@extends('spark::layouts.app')

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endpush

@section('content')
    <spark-settings :user="user" :teams="teams" inline-template>
        <div class="spark-screen container">
            <div class="row">
                <!-- Tabs -->
                <div class="col-md-3 spark-settings-tabs">
                    <aside>
                        <h3 class="nav-heading ">
                            {{__('Settings')}}
                        </h3>
                        <ul class="nav flex-column mb-4 ">
                            <li class="nav-item ">
                                <a class="nav-link" href="#profile" aria-controls="profile" role="tab"
                                   data-toggle="tab">
                                    <svg class="icon-20 " viewBox="0 0 20 20 " xmlns="http://www.w3.org/2000/svg ">
                                        <path d="M10 20C4.4772 20 0 15.5228 0 10S4.4772 0 10 0s10 4.4772 10 10-4.4772 10-10 10zm0-17C8.343 3 7
              4.343 7 6v2c0 1.657 1.343 3 3 3s3-1.343 3-3V6c0-1.657-1.343-3-3-3zM3.3472 14.4444C4.7822 16.5884 7.2262 18 10
              18c2.7737 0 5.2177-1.4116 6.6528-3.5556C14.6268 13.517 12.3738 13 10 13s-4.627.517-6.6528 1.4444z "></path>
                                    </svg>
                                    {{__('Profile')}}
                                </a>
                            </li>

                        </ul>
                    </aside>

                    <!-- Billing Tabs -->
                    @if (Spark::canBillCustomers())
                        <aside>
                            <h3 class="nav-heading ">
                                {{__('Billing')}}
                            </h3>
                            <ul class="nav flex-column mb-4 ">
                                @if (Spark::hasPaidPlans())
                                    <li class="nav-item ">
                                        <a class="nav-link" href="#subscription" aria-controls="subscription" role="tab"
                                           data-toggle="tab">
                                            <svg class="icon-20 " xmlns="http://www.w3.org/2000/svg "
                                                 viewBox="0 0 14 20 ">
                                                <path d="M7 3v2c-2.8 0-5 2.2-5 5 0 1.4.6 2.6 1.5 3.5L2 15c-1.2-1.3-2-3-2-5 0-4 3-7 7-7zm5 2c1.2 1.3 2 3
              2 5 0 4-3 7-7 7v-2c2.8 0 5-2.2 5-5 0-1.4-.6-2.6-1.5-3.5L12 5zM7 20l-4-4 4-4v8zM7 8V0l4 4-4 4z"></path>
                                            </svg>
                                            {{__('Subscription')}}
                                        </a>
                                    </li>
                                @endif

                                <li class="nav-item ">
                                    <a class="nav-link" href="#payment-method" aria-controls="payment-method" role="tab"
                                       data-toggle="tab">
                                        <svg class="icon-20 " xmlns="http://www.w3.org/2000/svg " viewBox="0 0 20 16 ">
                                            <path d="M18 4V2H2v2h16zm0 4H2v6h16V8zM0 2c0-1 1-2 2-2h16c1 0 2 1 2 2v12c0 1-1 2-2 2H2c-1 0-2-1-2-2V2zm4
              8h4v2H4v-2z"></path>
                                        </svg>
                                        {{__('Payment Method')}}
                                    </a>
                                </li>

                                <li class="nav-item ">
                                    <a class="nav-link" href="#invoices" aria-controls="invoices" role="tab"
                                       data-toggle="tab">
                                        <svg class="icon-20 " xmlns="http://www.w3.org/2000/svg " viewBox="0 0 20 20 ">
                                            <path d="M4 2h16l-3 9H4c-.6 0-1 .4-1 1s.5 1 1 1h13v2H4c-1.7 0-3-1.3-3-3s1.3-3 3-3h.3L3 5 2 2H0V0h3c.5 0
              1 .5 1 1v1zm1 18c-1 0-2-1-2-2s1-2 2-2 2 1 2 2-1 2-2 2zm10 0c-1 0-2-1-2-2s1-2 2-2 2 1 2 2-1 2-2 2z"></path>
                                        </svg>
                                        {{__('Invoices')}}
                                    </a>
                                </li>
                            </ul>
                        </aside>

                        <aside>
                            <h3 class="nav-heading ">
                                {{__('Amazon MWS')}}
                            </h3>
                            <ul class="nav flex-column mb-4 ">

                                <li class="nav-item ">
                                    <a class="nav-link" href="#subscription" aria-controls="subscription" role="tab"
                                       data-toggle="tab">
                                        <svg class="icon-20 " xmlns="http://www.w3.org/2000/svg " viewBox="0 0 14 20 ">
                                            <path d="M7 3v2c-2.8 0-5 2.2-5 5 0 1.4.6 2.6 1.5 3.5L2 15c-1.2-1.3-2-3-2-5 0-4 3-7 7-7zm5 2c1.2 1.3 2 3
              2 5 0 4-3 7-7 7v-2c2.8 0 5-2.2 5-5 0-1.4-.6-2.6-1.5-3.5L12 5zM7 20l-4-4 4-4v8zM7 8V0l4 4-4 4z"></path>
                                        </svg>
                                        {{__('Settings')}}
                                    </a>
                                </li>


                            </ul>
                        </aside>
                    @endif
                </div>

                <!-- Tab cards -->
                <div class="col-md-9">
                    <div class="tab-content">
                        <!-- Profile -->
                        <div role="tabcard" class="tab-pane active" id="profile">
                            @include('spark::settings.profile')
                        </div>

                        <!-- Teams -->
                        @if (Spark::usesTeams())
                            <div role="tabcard" class="tab-pane" id="{{Spark::teamsPrefix()}}">
                                @include('spark::settings.teams')
                            </div>
                        @endif

                    <!-- Security -->
                        <div role="tabcard" class="tab-pane" id="security">
                            @include('spark::settings.security')
                        </div>

                        <!-- API -->
                        @if (Spark::usesApi())
                            <div role="tabcard" class="tab-pane" id="api">
                                @include('spark::settings.api')
                            </div>
                        @endif

                    <!-- Billing Tab Panes -->
                        @if (Spark::canBillCustomers())
                            @if (Spark::hasPaidPlans())
                            <!-- Subscription -->
                                <div role="tabcard" class="tab-pane" id="subscription">
                                    <div v-if="user">
                                        @include('spark::settings.subscription')
                                    </div>
                                </div>
                            @endif

                        <!-- Payment Method -->
                            <div role="tabcard" class="tab-pane" id="payment-method">
                                <div v-if="user">
                                    @include('spark::settings.payment-method')
                                </div>
                            </div>

                            <!-- Invoices -->
                            <div role="tabcard" class="tab-pane" id="invoices">
                                @include('spark::settings.invoices')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </spark-settings>
@endsection
