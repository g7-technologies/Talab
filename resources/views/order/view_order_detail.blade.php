@extends('layouts.admin_master')
@section('content')
<div class="container-fluid">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">View All Orders</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-3">Order Status</h4>
                    <form class="form-horizontal auth-form my-4" method="post" action="{{url('/admin_change_order_status')}}"  enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" value="{{$order->id}}" name="order_id"/>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Select Order Status</label>
                            </div>
                            <div class="col-md-12">
                                <select class="form-control" name="order_status">
                                    <option value="">Select Order Status</option>
                                    @if($order->status == 0)
                                    <option value="" selected>Pending</option>
                                    @else
                                    <option value="0">Pending</option>
                                    @endif
                                    @if($order->status == 1)
                                    <option value="" selected>Approved</option>
                                    @else
                                    <option value="1">Approved</option>
                                    @endif
                                    @if($order->status == 2)
                                    <option value="" selected>Cancelled</option>
                                    @else
                                    <option value="2">Cancelled</option>
                                    @endif
                                    @if($order->status == 3)
                                    <option value="" selected>Shipped</option>
                                    @else
                                    <option value="3">Shipped</option>
                                    @endif
                                    @if($order->status == 4)
                                    <option value="" selected>Delivered</option>
                                    @else
                                    <option value="4">Delivered</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-gradient-primary px-5 py-2">Update Status</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-3">Order Summary</h4>
                    <div class="table-responsive shopping-cart">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>                                                        
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->order_details as $data)
                                <tr>
                                    <td>
                                        <a href="{{url('product_detail/'.$data->products->id)}}">
                                        <img src="{{ asset('public/product_images/'.$data->products->image) }}" alt="" height="52">
                                        <p class="d-inline-block align-middle mb-0 product-name">{{$data->products->name}}</p>
                                        </a>
                                    </td>
                                    <td>
                                        {{$data->quantity}}
                                    </td>
                                    <td>SAR {{$data->price}}</td>                                                        
                                </tr>
                                @endforeach                                                    
                            </tbody>
                        </table>
                    </div>
                    <div class="total-payment">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td class="payment-title">Subtotal</td>
                                    <td>SAR {{$order->sub_total}}</td>
                                </tr>
                                <tr>
                                    <td class="payment-title">Shipping Charges</td>
                                    <td>
                                        SAR {{$order->shipping_cost}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="payment-title">Total</td>
                                    <td class="text-dark"><strong>SAR {{$order->grand_total}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-3">Delivery Address</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name <small class="text-danger font-13">*</small></label>
                                <input type="text" class="form-control" id="firstname" disabled value="{{$order->first_name}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name <small class="text-danger font-13">*</small></label>
                                <input type="email" class="form-control" id="lastname" disabled value="{{$order->last_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">                            
                            <div class="form-group">
                                <label>Delivery Address <small class="text-danger font-13">*</small></label>
                                <input type="text" class="form-control" disabled value="{{$order->address}}">
                            </div>
                        </div>
                        <div class="col-md-6">                            
                            <div class="form-group">
                                <label>Address <small class="text-danger font-13">*</small></label>
                                <input type="text" class="form-control" disabled value="{{$order->address}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>City <small class="text-danger font-13">*</small></label>
                                <input type="text" class="form-control" id="city" disabled value="{{$order->city}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">                            
                            <div class="form-group">
                                <label>Email Address <small class="text-danger font-13">*</small></label>
                                <input type="email" class="form-control" disabled value="{{$order->email}}">
                            </div>
                        </div>
                        <div class="col-md-6">                            
                            <div class="form-group">
                                <label>Mobile No <small class="text-danger font-13">*</small></label>
                                <input type="text" class="form-control" disabled value="{{$order->phone}}">
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