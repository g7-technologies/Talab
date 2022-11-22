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
                <!--        <li class="breadcrumb-item active">Dashboard</li>-->
                <!--    </ol>-->
                <!--</div>-->
                <h4 class="page-title">Product Details</h4>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <img src="{{ url('public/product_images/'.$product->image) }}" alt="product_images" class=" mx-auto  d-block" height="400" width="400">
                                    </div>
                                    <div class="col-lg-6 align-self-center">
                                        <div class="single-pro-detail">
                                            <a href="{{url('/shop_detail/'.$shop->id)}}" class="mb-1">{{$shop->name}}</a>
                                            <div class="custom-border mb-3"></div>
                                            <h3 class="pro-title">{{$product->name}}</h3>
                                            <p class="text-muted mb-0">{{$product->description}}</p>
                                            @if($product->discount_percentage != 0.00)
                                            <h2 class="pro-price">SAR {{($product->price*(100-$product->discount_percentage))/100}} <span><del>SAR {{$product->price}}</del></span><span class="text-danger font-weight-bold ml-2">{{$product->discount_percentage}}% Off</span></h2>
                                            @else
                                            <h2 class="pro-price">SAR {{$product->price}}</h2>
                                            @endif                                             
                                            <h6 class="text-muted font-13">Description :</h6> 
                                            <ul class="list-unstyled pro-features border-0">
                                                <li>Category : {{$category->name}}</li>
                                                <li>Min Quantity : {{$product->minimum_quantity}}</li>
                                                <li>Stock : {{$product->stock}}</li>
                                            </ul>
                                                                                           
                                            <div class="quantity mt-3 ">
                                                @if($product->status == 0 && $product->is_deleted == 1)
                                                <a href="{{url('/admin_activate_product/'.$product->id)}}" class="btn btn-gradient-success text-white px-4 d-inline-block"><i class="far fa-trash-alt text-white mr-2"></i>Activate</a>
                                                @elseif($product->status == 1 && $product->is_deleted == 0)
                                                <a href="{{url('/admin_deactivate_product/'.$product->id)}}" class="btn btn-gradient-danger text-white px-4 d-inline-block"><i class="far fa-trash-alt text-white mr-2"></i>Delete</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row container-grid nf-col-3  projects-wrapper">
                                    
                                    <div class="col-lg-4 col-md-6 p-0 nf-item branding design coffee spacing">
                                        <div class="item-box">
                                            <a class="cbox-gallary1 mfp-image" href="{{ url('public/product_images/'.$product->image) }}" title="{{$product->name}}">
                                                <img class="item-container " src="{{ asset('public/product_images/'.$product->image) }}" alt="7" />
                                                <div class="item-mask">
                                                    <div class="item-caption">
                                                        <h5 class="text-white">{{$product->name}}</h5>
                                                        <p class="text-white">{{$product->description}}</p>
                                                    </div>
                                                </div>
                                            </a>
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

</div>
@endsection