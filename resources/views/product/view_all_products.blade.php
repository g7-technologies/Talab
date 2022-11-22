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
                <!--        <li class="breadcrumb-item active">View All Products</li>-->
                <!--    </ol>-->
                <!--</div>-->
                <h4 class="page-title">View All Products</h4>
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
        <div class="col-md-12 col-lg-12">
            <div class="card bg-transparent">
                <div class="card-body">

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><i class="mdi mdi-format-list-checkbox"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><i class="mdi mdi-border-all"></i></a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active p-3" id="home" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                        
                                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Category</th>
                                                    <th>Quantity</th>
                                                    <th>Min Quantity</th>
                                                    <th>Price</th>
                                                    <th>Discount</th>
                                                    <th>Discounted Price</th>
                                                    <th>Status</th>
                                                    <th>Shop</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
            
            
                                                <tbody>
                                                    @foreach($shops as $data)
                                                    @if($data->verified == 1 && $data->status == 1 && $data->is_deleted == 0)
                                                    @foreach($data->category as $category)
                                                    @if($category->verified == 1 && $category->status == 1 && $category->is_deleted == 0)
                                                    @foreach($category->products as $product)
                                                    @if($product->status == 1 && $product->is_deleted == 0)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ asset('public/product_images/'.$product->image) }}" alt="product_image" height="52">
                                                            <p class="d-inline-block align-middle mb-0">
                                                                <a href="{{ url('/product_detail/'.$product->id) }}" class="d-inline-block align-middle mb-0 product-name">{{$product->name}}</a> 
                                                                <br>
                                                                <span class="text-muted font-13">{{$product->description}}</span> 
                                                            </p>
                                                        </td>
                                                        <td>{{$category->name}}</td>
                                                        <td>{{$product->stock}}</td>
                                                        <td>{{$product->minimum_quantity}}</td>
                                                        <td>SAR {{$product->price}}</td>
                                                        <td>{{$product->discount_percentage}}%</td>
                                                        <td>
                                                            @if($product->discount_percentage != 0.00)
                                                            SAR {{($product->price*(100-$product->discount_percentage))/100}}
                                                            @else
                                                            SAR {{$product->price}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($product->stock < $product->minimum_quantity && $product->stock != 0)
                                                            <span class="badge badge-soft-warning">Low Inventory</span>
                                                            @elseif($product->stock > $product->minimum_quantity)
                                                            <span class="badge badge-soft-success">In Stock</span>
                                                            @elseif($product->stock == 0)
                                                            <span class="badge badge-soft-danger">Out of Stock</span>
                                                            @endif
                                                        </td>
                                                        <td><a href="{{ url('/shop_detail/'.$data->id) }}">{{$data->name}}</a></td>
                                                        <td>
                                                            <!-- <a href=""><i class="far fa-edit text-info mr-1"></i></a> -->
                                                            <a href="{{ url('/admin_deactivate_product/'.$product->id) }}"><i class="far fa-trash-alt text-danger"></i></a>
                                                            <a href="{{ url('/product_detail/'.$product->id) }}"><i class="fas fa-info ml-2 text-primary"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane p-3" id="profile" role="tabpanel">
                            <div class="row mt-4">
                                @foreach($shops as $data)
                                @if($data->verified == 1 && $data->status == 1 && $data->is_deleted == 0)
                                @foreach($data->category as $category)
                                @if($category->verified == 1 && $category->status == 1 && $category->is_deleted == 0)
                                @foreach($category->products as $product)
                                @if($product->status == 1 && $product->is_deleted == 0)
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            @if($product->discount_percentage != 0.00)
                                            <div class="ribbon1 rib1-secondary">
                                                <span class="text-white text-center rib1-secondary">{{$product->discount_percentage}}% off</span>
                                            </div>
                                            @endif
                                            <img src="{{ asset('public/product_images/'.$product->image) }}" alt="product_images" class="d-block mx-auto my-4" height="170">
                                            <div class="d-flex justify-content-between align-items-center my-4">
                                                <div>
                                                    <p class="text-muted mb-2"><a href="{{ url('/shop_detail/'.$data->id) }}">{{$data->name}}</a></p>
                                                    <a href="{{ url('/product_detail/'.$product->id) }}" class="header-title">{{$product->name}}</a>
                                                </div>
                                                <div>
                                                    @if($product->discount_percentage != 0.00)
                                                    <h4 class="text-dark mt-0 mb-2">SAR {{($product->price*(100-$product->discount_percentage))/100}}<small class="text-muted font-14"><del>SAR {{$product->price}}</del></small></h4>
                                                    @else
                                                    <h4 class="text-dark mt-0 mb-2">SAR {{$product->price}}</h4>
                                                    @endif
                                                </div>      
                                            </div> 
                                            <a href="{{ url('/product_detail/'.$product->id) }}" class="btn btn-soft-primary btn-block">View Details</a>
                                            <a href="{{ url('/deactivate_product/'.$product->id) }}" class="btn btn-soft-danger btn-block">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endif
                                @endforeach
                                @endif
                                @endforeach

                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')

<script>
    $('#datatable').DataTable();
</script>

@endpush