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
                <h4 class="page-title">View All Categories</h4>
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
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title"><a href="{{url('/shop_detail/'.$data->id)}}">{{$data->name}}</a></h4>
                    <p class="text-muted mb-4">All Categroies of {{$data->name}}.</p>
                    <div class="custom-dd dd" id="nestable_list_1">
                        <ol class="dd-list">
                            @foreach($data->category as $shop_category)
                            <li class="dd-item" data-id="{{$shop_category->id}}">
                                <div class="dd-handle">
                                    {{$shop_category->name}}
                                </div>
                                <div>
                                    @if($shop_category->verified == 0)
                                    <a href="{{url('/verify_category/'.$shop_category->id)}}" class="badge badge-success">Verify</a>
                                    @else
                                    @if($shop_category->status == 1 && $shop_category->is_deleted == 0)
                                    <a href="{{url('/admin_deactivate_category/'.$shop_category->id)}}" class="badge badge-danger">Delete</a>
                                    @elseif($shop_category->status == 0 && $shop_category->is_deleted == 1)
                                    <a href="{{url('/admin_activate_category/'.$shop_category->id)}}" class="badge badge-success">Activate</a>
                                    @endif
                                    @endif
                                </div>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
</div>

@endsection