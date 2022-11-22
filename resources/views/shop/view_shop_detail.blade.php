@extends('layouts.admin_master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Shop Details</h4>
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
                                        <img src="{{ asset('public/shop_logo/'.$shop->logo) }}" alt="" class="rounded-circle" width="120px"/>
                                    </div>
                                    <div class="met-profile_user-detail">
                                        <h5 class="met-user-name">{{$shop->name}}</h5>                                                        
                                        <p class="mb-0 met-user-name-post">{{$shop->trader_name}}</p>
                                    </div>
                                </div>                                                
                            </div>
                            <div class="col-lg-4 ml-auto">
                                <ul class="list-unstyled personal-detail">
                                    <li class=""><i class="dripicons-phone mr-2 text-info font-18"></i> <b> phone </b> : {{$shop->number}}</li>
                                    <li class="mt-2"><i class="dripicons-mail text-info font-18 mt-2 mr-2"></i> <b> Email </b> : {{$shop->email}}</li>
                                    <li class="mt-2"><i class="dripicons-location text-info font-18 mt-2 mr-2"></i> <b>Location</b> : {{$shop->city}}</li>
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
                            <a class="nav-link" id="settings_detail_tab" data-toggle="pill" href="#settings_detail">Profile</a>
                        </li>
                    </ul>        
                </div>
            </div>
        </div>
    </div>
    @if(session('error_msg'))
     <p class="alert alert-danger">{{session('error_msg')}}</p> 
    @endif
    @if(session('success_msg'))
     <p class="alert alert-success">{{session('success_msg')}}</p> 
    @endif
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
                                        <div class="align-self-center">
                                            <h2 class="mt-0 mb-2 font-weight-semibold text-center">SAR 955</h2>
                                            <h4 class="title-text mb-0">This Month Revenue</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between bg-light p-3 mt-3 rounded">
                                        <div>
                                            <h4 class="mb-1 font-weight-semibold text-center">SAR 10255</h4>
                                            <p class="mb-0">Orders Revenue</p>
                                        </div>
                                        <div>
                                            <h4 class=" mb-1 font-weight-semibold text-center">25</h4>
                                            <p class="mb-0">Orders Completed</p>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card dash-data-card text-center">
                                        <div class="card-body"> 
                                            <div class="icon-info mb-3">
                                                <i class="fas fa-ticket-alt bg-soft-warning"></i>
                                            </div>
                                            <h3 class="text-dark">184</h3>
                                            <h6 class="font-14 text-dark">Products</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card dash-data-card text-center">
                                        <div class="card-body"> 
                                            <div class="icon-info mb-3">
                                                <i class="fab fa-codepen bg-soft-pink"></i>
                                            </div>
                                            <h3 class="text-dark">101</h3>
                                            <h6 class="font-14 text-dark">Orders</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card dash-data-card text-center">
                                        <div class="card-body"> 
                                            <div class="icon-info mb-3">
                                                <i class="fas fa-hands bg-soft-success"></i>
                                            </div>
                                            <h3 class="text-dark"><?php echo date_format($shop->created_at,"M d, Y"); ?></h3>
                                            <h6 class="font-14 text-dark">Member Since</h6>                  
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="settings_detail">
                    <div class="row">
                        <div class="col-lg-12 col-xl-9 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <form class="form-horizontal form-material mb-0" method="post" action="{{url('/update_shop_details_admin')}}">
                                        @csrf
                                        <input type="hidden" value="{{$shop->id}}" name="shop_id">
                                        <div class="form-group">
                                            <label>Profit</label>
                                            <input type="number" min="0.01" max="100000" step="0.01" class="form-control" value="{{$shop->profit}}" name="profit">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>VAT</label>
                                            <input type="number" max="100000" class="form-control" value="{{$shop->vat}}" name="vat">
                                        </div>

                                        <div class="form-group">
                                            <label>Minimum Cost To Delivery</label>
                                            <input type="number" min="0.01" max="100000" step="0.01" class="form-control" value="{{$shop->minimum_cost_to_delivery}}" name="minimum_cost_to_delivery">
                                        </div>

                                        <div class="form-group">
                                            <label>Number Of Products Allowed To Sell</label>
                                            <select class="form-control" name="no_of_product">
                                                @if($shop->no_of_product == 100)
                                                <option value="100">100</option>
                                                <option value="200">200</option>
                                                <option value="300">300</option>
                                                <option value="500">500</option>
                                                <option value="1000">1000</option>
                                                @elseif($shop->no_of_product == 200)
                                                <option value="100">100</option>
                                                <option value="200" selected>200</option>
                                                <option value="300">300</option>
                                                <option value="500">500</option>
                                                <option value="1000">1000</option>
                                                @elseif($shop->no_of_product == 300)
                                                <option value="100">100</option>
                                                <option value="200">200</option>
                                                <option value="300" selected>300</option>
                                                <option value="500">500</option>
                                                <option value="1000">1000</option>
                                                @elseif($shop->no_of_product == 500)
                                                <option value="100">100</option>
                                                <option value="200">200</option>
                                                <option value="300">300</option>
                                                <option value="500" selected>500</option>
                                                <option value="1000">1000</option>
                                                @elseif($shop->no_of_product == 1000)
                                                <option value="100">100</option>
                                                <option value="200">200</option>
                                                <option value="300">300</option>
                                                <option value="500">500</option>
                                                <option value="1000" selected>1000</option>
                                                @endif
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <button class="btn btn-gradient-primary btn-sm px-4 mt-3 float-right mb-0" type="submit">Update</button>
                                        </div>
                                    </form>
                                    
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