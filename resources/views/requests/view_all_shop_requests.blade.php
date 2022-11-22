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
                <!--        <li class="breadcrumb-item active">View All Shop Requests</li>-->
                <!--    </ol>-->
                <!--</div>-->
                <h4 class="page-title">View All Shops Product Increment Requests</h4>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Shop Name</th>
                            <th>Trader Name</th>
                            <th>Email</th>
                            <th>Number</th>
                            <th>Products Allowed</th>
                            <th>Requested Products</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($requests as $data)
                            <tr>
                                <td>
                                    <p class="d-inline-block align-middle mb-0">
                                        <a href="{{url('/shop_detail/'.$data->shop_id)}}" class="d-inline-block align-middle mb-0 product-name">{{$data->shop->name}}</a> 
                                        <br>
                                        <p class="text-muted font-13">
                                            @if($data->shop->albalad == 0)
                                            <span class="badge badge-soft-warning">Other Store</span>
                                            @else
                                            <span class="badge badge-soft-success">Albalad Store</span>
                                            @endif
                                        </p> 
                                    </p>
                                </td>
                                <td>{{$data->shop->trader_name}}</td>
                                <td>{{$data->shop->email}}</td>
                                <td>{{$data->shop->number}}</td>
                                <td>{{$data->shop->no_of_product}}</td>
                                <td>{{$data->no_of_product}}</td>
                                <td>
                                    @if($data->status == 0)
                                    <a href="{{url('/accept_product_request/'.$data->id)}}"><i class="far fa-check-circle text-success mr-1"></i></a>
                                    <a href="{{url('/delete_product_request/'.$data->id)}}"><i class="far fa-trash-alt text-danger"></i></a>
                                    @elseif($data->status == 1)
                                    <span class="badge badge-soft-success">Request Accepted</span>
                                    @else
                                    <span class="badge badge-soft-danger">Request Rejected</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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