@extends('layouts.admin_master')
@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <!--<div class="float-right">-->
                <!--    <ol class="breadcrumb">-->
                <!--        <li class="breadcrumb-item"><a href="javascript:void(0);">Metrica</a></li>-->
                <!--        <li class="breadcrumb-item"><a href="javascript:void(0);">UI Kit</a></li>-->
                <!--        <li class="breadcrumb-item active">Form Elements</li>-->
                <!--    </ol>-->
                <!--</div>-->
                <h4 class="page-title">Add New Shop</h4>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">        
                    <h4 class="mt-0 header-title">Add Shop Information</h4>
                    <p class="text-muted mb-3">All fields with <code class="highlighter-rouge">(*)</code> are mandatory.</p>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            
                            @if(session('error_msg'))
                                <p class="alert alert-danger">{{session('error_msg')}}</p> 
                            @endif

                            <form class="form-horizontal auth-form my-4" method="post" action="{{url('/add_new_shop_submit')}}"  enctype="multipart/form-data">
                            @csrf

                                <div class="form-group row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-2">
                                        <input type="file" id="img" name="img" class="dropify" required/>
                                    </div>
                                    <div class="col-md-5"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-2">
                                        <p class="text-muted mb-3 text-center">Shop Logo <code class="highlighter-rouge">*</code></p>
                                    </div>
                                    <div class="col-md-5"></div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label text-left">Shop Name <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" required type="text" id="name" name="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="registration_no" class="col-sm-2 col-form-label text-left">Registration No <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" required type="name" id="registration_no" name="registration_no" value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="trader_name" class="col-sm-2 col-form-label text-left">Trader Name <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" required type="name" id="trader_name" name="trader_name" value="{{ old('trader_name') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label text-left">Email <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" required type="email" id="email" name="email" value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label text-left">Password <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" required type="password" id="password" name="password">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="number" class="col-sm-2 col-form-label text-left">Phone Number <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" required type="tel" id="number" name="number" value="{{ old('number') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="city" class="col-sm-2 col-form-label text-left">City <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" required type="name" id="city" name="city" value="{{ old('city') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="iban" class="col-sm-2 col-form-label text-left">IBAN <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" required type="name" id="iban" name="iban" value="{{ old('iban') }}">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="vat" class="col-sm-2 col-form-label text-left">VAT </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" step="0.01" id="vat" name="vat" value="{{ old('vat') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="minimum_cost_to_delivery" class="col-sm-2 col-form-label text-left">Minimum Cost To Deliver <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" required type="number" min="0.01" max="1000000" step="0.01" id="minimum_cost_to_delivery" name="minimum_cost_to_delivery" value="{{ old('minimum_cost_to_delivery') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_of_product" class="col-sm-2 col-form-label text-left">No Of Products Allowed To Sell <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <select class="form-control" required id="no_of_product" name="no_of_product">
                                            <option value="">Select No Of Products</option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                            <option value="300">300</option>
                                            <option value="500">500</option>
                                            <option value="1000">1000</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mb-2 row">
                                    <label class="col-md-2 my-1 control-label">Delivery <code class="highlighter-rouge">*</code></label>
                                    <div class="col-md-10">
                                        <div class="form-check-inline my-1">
                                            <div class="custom-control custom-radio ml-4">
                                                <input type="radio" id="delivery" name="delivery" class="custom-control-input" value="1" checked>
                                                <label class="custom-control-label" for="delivery">delivery on Talab</label>
                                            </div>
                                        </div>
                                        <div class="form-check-inline my-1">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="delivery2" name="delivery" class="custom-control-input" value="0">
                                                <label class="custom-control-label" for="delivery2">delivery on them</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-2 row">
                                    <label class="col-md-2 my-1 control-label">Store Type <code class="highlighter-rouge">*</code></label>
                                    <div class="col-md-10">
                                        <div class="form-check-inline my-1">
                                            <div class="custom-control custom-radio ml-4">
                                                <input type="radio" id="albalad" name="albalad" class="custom-control-input" value="1" checked>
                                                <label class="custom-control-label" for="albalad">ALBalad Store</label>
                                            </div>
                                        </div>
                                        <div class="form-check-inline my-1">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="albalad2" name="albalad" class="custom-control-input" value="0">
                                                <label class="custom-control-label" for="albalad2">Other Store</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="always_open" class="col-sm-2 col-form-label text-left">Always Open (24/7) <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" class="control-input mt-2 ml-4" checked="true" value="1" id="always_open" name="always_open">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-gradient-primary px-5 py-2">Add Shop</button>
                                    </div>
                                </div>
                            
                            </form>

                        </div>
                    </div>                                                                      
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')

@endpush