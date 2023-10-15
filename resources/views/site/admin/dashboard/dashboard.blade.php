@extends('site.admin.layouts.app')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">


            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0"><a style="font-size: 120%" href="{{ route('admin.dashboard.users.info') }}">{{$usersCount}}</a></h3>
                                    <p class="text-success ml-2 mb-0 font-weight-medium">Customers</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal"> <a style="font-size: 120%" href="{{ route('admin.dashboard.users.info') }}">Total Customers</a></h6>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0"><a style="font-size: 120%" href="{{route('admin.dashboard.products.info')}}">{{$productsCount}}</a></h3>
                                    <p class="text-success ml-2 mb-0 font-weight-medium">Products</p>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal"><a style="font-size: 120%" href="{{route('admin.dashboard.products.info')}}">Total Products Number</a></h6>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0"><a style="font-size: 120%" href="{{ route('admin.dashboard.orders.info') }}">{{ $ordersCount }}</a></h3>
                                    <p class="text-success ml-2 mb-0 font-weight-medium">Orders</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal"><a style="font-size: 120%" href="{{ route('admin.dashboard.orders.info') }}">Total Orders</a></h6>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0"><a style="font-size: 120%"  href="{{route('admin.dashboard.processing_orders.info')}}">{{ $processingOrdersCount }}</a></h3>
                                    <p class="text-success ml-2 mb-0 font-weight-medium">Processing Orders</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal"><a style="font-size: 120%" href="{{route('admin.dashboard.processing_orders.info')}}">Total Processing Orders</a></h6>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0"><a style="font-size: 120%" href="{{route('admin.dashboard.delivered_orders.info')}}">{{ $deliveredOrdersCount }}</a> </h3>
                                    <p class="text-success ml-2 mb-0 font-weight-medium">Delivered Orders</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal"><a style="font-size: 120%" href="{{route('admin.dashboard.delivered_orders.info')}}">Total Delivered Orders</a></h6>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $totalRevenue }}</h3>
                                    <p class="text-success ml-2 mb-0 font-weight-medium" style="font-size: 140%">$</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Revenue From Orders</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->

@endsection
@section('title')
    {{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}} Dashboard
@endsection
