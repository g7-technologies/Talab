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
                <h4 class="page-title">View All Deactive Shops</h4>
            </div>
        </div>
    </div>
    @if(session('success_msg'))
        <p class="alert alert-success">{{session('success_msg')}}</p> 
    @endif
    @if(session('error_msg'))
        <p class="alert alert-danger">{{session('error_msg')}}</p> 
    @endif
    <div class="row">
        @foreach($shops as $data)
        <div class="col-lg-3">
            <div class="card client-card">
                <div class="card-body text-center">
                    <img src="{{ asset('public/shop_logo/'.$data->logo) }}" alt="user" class="rounded-circle thumb-xl">
                    <h5 class=" client-name">{{$data->name}}</h5>
                    <span class="text-muted mr-3"><i class="dripicons-location mr-2 text-info"></i>{{$data->city}}</span>
                    <span  class="text-muted"><i class="dripicons-phone mr-2 text-info"></i>{{$data->number}}</span></br></br>
                    <span class="text-muted mr-3"><i class="dripicons-user mr-2 text-info"></i>{{$data->trader_name}}</span></br></br>
                    <a href="{{ url('/shop_detail/'.$data->id) }}" class="btn btn-sm btn-gradient-secondary">View Details</a>
                    <a href="{{ url('/activate_shop/'.$data->id) }}" class="btn btn-sm btn-gradient-success">Activate</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>  
</div>

@endsection