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
                <h4 class="page-title">View All Deactive Clients</h4>
            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body dash-info-carousel mb-0">
                    <!--<span class="text-success mb-2 d-block">Today Available</span>-->
                    <div class="row">    
                        <div class="col-12 align-self-center">
                            <!--<h4 class="mt-0 header-title text-left">Apollo Hospital</h4>-->
                            <div class="media">
                                <img src="../assets/images/users/dr-1.jpg" alt="" height="120"  class="rounded-circle">                                   
                                <div class="media-body align-self-center ml-3">
                                    <h2 class="mb-1 mt-0 dr-title">Dr.Helen White</h2>
                                    <p class="text-muted font-13 mb-2"><span class="mr-2 text-secondary">MS Cardiology</span> 11:00am to 03:00pm</p>
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item m-0"><i class="mdi mdi-star text-warning font-20"></i></li>
                                        <li class="list-inline-item m-0"><i class="mdi mdi-star text-warning font-20"></i></li>
                                        <li class="list-inline-item m-0 m-0"><i class="mdi mdi-star text-warning font-20"></i></li>
                                        <li class="list-inline-item m-0"><i class="mdi mdi-star text-warning font-20"></i></li>
                                        <li class="list-inline-item m-0"><i class="mdi mdi-star-half text-warning font-20"></i></li>
                                        <li class="list-inline-item m-0"><small class="text-muted">4.91/5 (1021 reviews)</small></li>
                                    </ul> 
                                </div>
                            </div>
                            <hr class="hr-dashed"> 
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-center">
                                        <i data-feather="phone" class="align-self-center icon-lg icon-dual-info d-block mx-auto mb-2"></i>                                 
                                        <h5 class="mt-0 mb-1">Phone No</h5>
                                        <p>+01 1234567890</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <i data-feather="globe" class="align-self-center icon-lg icon-dual-info d-block mx-auto mb-2"></i>                                 
                                        <h5 class="mt-0 mb-1">Website</h5>
                                        <a href="#" class="text-primary mb-0 font-14">www.example123.com</a>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 bg-light">                                                           
                                <div class="media">
                                   <h3 class="font-30">68</h3>                                     
                                    <div class="media-body align-self-center ml-3">
                                        <p class="mb-0 font-weight-semibold text-uppercase text-dark-alt">Appointments</p>
                                        <p class="mb-0 text-muted">Last Saturday 52 Appointments</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-dashed"> 
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-center">
                                        <a href="{{ url('/client_detail') }}" class="btn btn-block btn-gradient-secondary">View Details</a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <button type="button" class="btn btn-block btn-gradient-success">Active</button>
                                    </div>
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