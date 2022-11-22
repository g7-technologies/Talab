@extends('layouts.admin_master')
@section('content')
<div class="container-fluid">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Metrica</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">View All Orders</li>
                    </ol>
                </div>
                <h4 class="page-title">View All Clients</h4>
            </div>
        </div>
    </div>
    <div class="row">
        
        @foreach($customers as $data)
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body dash-info-carousel mb-0">
                    <!-- <span class="text-success mb-2 d-block">Today Available</span> -->
                    <div class="row">    
                        <div class="col-12 align-self-center">
                            <div class="media">
                                <img src="{{asset('public/customer_images/'.$data->image)}}" alt="" height="120"  class="rounded-circle">                                   
                                <div class="media-body align-self-center ml-3">
                                    <h2 class="mt-0 dr-title">{{$data->first_name}} {{$data->last_name}}</h2>
                                </div>
                            </div>
                            <hr class="hr-dashed"> 
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-center">
                                        <i data-feather="phone" class="align-self-center icon-lg icon-dual-info d-block mx-auto mb-2"></i>                                 
                                        <h5 class="mt-0 mb-1">Phone No</h5>
                                        <p>{{$data->number}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <i data-feather="globe" class="align-self-center icon-lg icon-dual-info d-block mx-auto mb-2"></i>                                 
                                        <h5 class="mt-0 mb-1">Email</h5>
                                        <p>{{$data->email}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 bg-light">                                                           
                                <div class="media">
                                   <h3 class="font-30">{{count($data->orders)}}</h3>                           
                                    <div class="media-body align-self-center ml-3">
                                        <p class="mb-0 font-weight-semibold text-uppercase text-dark-alt">Orders</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-dashed"> 
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-center">
                                        <a href="{{ url('/client_detail/'.$data->id) }}" class="btn btn-block btn-gradient-secondary">View Details</a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        @if($data->status == 1)
                                        <a href="{{url('/block_client/'.$data->id)}}" class="btn btn-block btn-gradient-danger">Block</a>
                                        @else
                                        <a href="{{url('/activate_client/'.$data->id)}}" class="btn btn-block btn-gradient-success">Activate</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection