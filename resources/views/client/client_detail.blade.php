@extends('layouts.admin_master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <!--<div class="float-right">-->
                <!--    <ol class="breadcrumb">-->
                <!--        <li class="breadcrumb-item"><a href="javascript:void(0);">Metrica</a></li>-->
                <!--        <li class="breadcrumb-item"><a href="javascript:void(0);">Ecommerce</a></li>-->
                <!--        <li class="breadcrumb-item active">View All Orders</li>-->
                <!--    </ol>-->
                <!--</div>-->
                <h4 class="page-title">Client Details</h4>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body  met-pro-bg">
                    <div class="met-profile">
                        <div class="row">
                            <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                <div class="met-profile-main">
                                    <div class="met-profile-main-pic">
                                        <img src="{{ asset('public/customer_images/'.$customer->image) }}" alt="" class="rounded-circle" width="120px">
                                    </div>
                                    <div class="met-profile_user-detail">
                                        <h5 class="met-user-name">{{$customer->first_name}} {{$customer->last_name}}</h5>
                                    </div>
                                </div>                                                
                            </div>
                            <div class="col-lg-4 ml-auto">
                                <ul class="list-unstyled personal-detail">
                                    <li class=""><i class="dripicons-phone mr-2 text-info font-18"></i> <b> phone </b> : {{$customer->number}}</li>
                                    <li class="mt-2"><i class="dripicons-mail text-info font-18 mt-2 mr-2"></i> <b> Email </b> : {{$customer->email}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="general_detail_tab" data-toggle="pill" href="#general_detail">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="activity_detail_tab" data-toggle="pill" href="#activity_detail">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="portfolio_detail_tab" data-toggle="pill" href="#portfolio_detail">Addresses</a>
                        </li>
                    </ul>        
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="tab-content detail-list" id="pills-tabContent">
                
                <div class="tab-pane fade show active" id="general_detail">
                    <div class="row">
                        <div class="col-xl-4"> 
                            
                            <div class="card">
                                <div class="card-body">
                                    <div class=" d-flex justify-content-between">
                                        <img src="{{ asset('public/assets/images/widgets/monthly-re.png') }}" alt="" height="75">
                                    </div>
                                    <div class="d-flex justify-content-between bg-light p-3 mt-3 rounded">
                                        <div class="align-self-center">
                                            <h4 class="mb-1 font-weight-semibold">
                                            <?php $total_orders_worth = 0; ?>
                                            @foreach($customer->orders as $data_o)
                                                <?php $total_orders_worth = $total_orders_worth + $data_o->grand_total;
                                                ?>
                                            @endforeach
                                            SAR <?php echo $total_orders_worth; ?>
                                            </h4>
                                            <p class="mb-0">All Orders Worth</p>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card dash-data-card text-center">
                                        <div class="card-body"> 
                                            <div class="icon-info mt-3 mb-3">
                                                <i class="fas fa-ticket-alt bg-soft-warning"></i>
                                            </div>
                                            <h3 class="text-dark mt-2">{{count($customer->orders)}}</h3>
                                            <h6 class="font-14 text-dark mt-2 mb-4">Total Orders</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card dash-data-card text-center">
                                        <div class="card-body"> 
                                            <div class="icon-info mt-3 mb-3">
                                                <i class="fas fa-hands bg-soft-success"></i>
                                            </div>
                                            <h3 class="text-dark mt-2"><?php echo date_format($customer->created_at,"M d, Y"); ?></h3>
                                            <h6 class="font-14 text-dark mt-2 mb-4">Member Since</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="activity_detail">
                    <div class="row">
                        
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body"> 
                                    <h4 class="header-title mt-0 mb-4">Orders</h4>
                                    <div class="slimscroll profile-activity-height">
                                        <div class="activity">
                                            
                                            @foreach($customer->orders as $data_orders)
                                            <div class="activity-info">
                                                <div class="icon-info-activity">
                                                    <i class="mdi mdi-checkbox-marked-circle-outline bg-soft-success"></i>
                                                </div>
                                                <div class="activity-info-text">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="text-muted mb-0 font-14 w-75 mt-2">
                                                            <a href="{{url('/order_detail/'.$data_orders->id)}}" class="text-dark font-14">Order# {{$data_orders->order_id}}</a> of worth <span class="text-dark font-14">SAR {{$data_orders->grand_total}}</span>
                                                        </p>
                                                        <span class="text-muted"><?php echo date_format($data_orders->created_at,"M d, Y"); ?></span>
                                                    </div>    
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane fade" id="portfolio_detail">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mt-0 mb-3">Addresses</h4>
                                    <ul class="list-unsyled m-0 pl-0 transaction-history">
                                        @foreach($customer->addresses as $data_address)
                                        <li class="align-items-center d-flex justify-content-between">
                                            <div class="media">
                                                <div class="transaction-icon">
                                                    <i class="dripicons-location"></i>
                                                </div>                                                
                                                <div class="media-body align-self-center"> 
                                                    <div class="transaction-data">
                                                        <h3 class="m-0">{{$data_address->address}}, {{$data_address->city}}</h3>
                                                        <p class="text-muted mb-0">Shipping Note: {{$data_address->shipping_note}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($data_address->status == 1)
                                            <span class="badge text-success">Active</span>
                                            @else
                                            <span class="badge text-danger">Deleted</span>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>                                       
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection