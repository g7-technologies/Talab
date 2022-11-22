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
                <h4 class="page-title">Create Promotion</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">        
                    <h4 class="mt-0 header-title">Create New Promotion</h4>
                    <p class="text-muted mb-3">All fields with <code class="highlighter-rouge">(*)</code> are mandatory.</p>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            @if(session('success_msg'))
                                <p class="alert alert-success">{{session('success_msg')}}</p> 
                            @endif
                            @if(session('error_msg'))
                                <p class="alert alert-danger">{{session('error_msg')}}</p> 
                            @endif
                            <form class="form-horizontal auth-form my-4" method="post" action="{{url('/create_promotion_submit')}}">
                            @csrf
                                
                                <div class="form-group row">
                                    <label for="code" class="col-sm-2 col-form-label text-left">Coupon Code <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="code" name="code" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="discount" class="col-sm-2 col-form-label text-left">Discount (%)<code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" id="discount" name="discount" required min="1" max="100">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="valid_till" class="col-sm-2 col-form-label text-left">Valid Till <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" id="valid_till" name="valid_till" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-2 col-form-label text-left">
                                        <label>Select Promotion Type</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="promotion_type" required>
                                            <option value="">Select Promotion Type</option>
                                            <option value="1">Shop</option>
                                            <option value="2">Delivery</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-gradient-primary px-5 py-2">Create Coupon Code</button>
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