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
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Order Name</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Customer Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $data)
                            <tr>
                                <td>
                                    <p class="d-inline-block align-middle mb-0">
                                        <a href="{{url('/order_detail/'.$data->id)}}" class="d-inline-block align-middle mb-0 product-name">Order# {{$data->order_id}}</a> 
                                        <br>
                                        <a href="{{url('/client_detail/'.$data->customer_id)}}" class="text-muted font-13">{{$data->first_name}} {{$data->last_name}}</a> 
                                    </p>
                                </td>
                                <td>{{$data->created_at}}</td>
                                <td>SAR {{$data->grand_total}}</td>
                                <td>{{$data->phone}}</td>
                                <td>{{$data->address}}</td>
                                <td>{{$data->city}}</td>
                                <td>
                                   @if($data->status == 0)
                                   <span class="badge badge-soft-warning">Pending</span>
                                   @elseif($data->status == 1)
                                   <span class="badge badge-soft-primary">Approved</span>
                                   @elseif($data->status == 2)
                                   <span class="badge badge-soft-danger">Cancelled</span>
                                   @elseif($data->status == 3)
                                   <span class="badge badge-soft-success">Shipped</span>
                                   @elseif($data->status == 4)
                                   <span class="badge badge-soft-success">Delivered</span>
                                   @endif
                                    
                                </td>
                                <td>
                                    <a href="{{ url('/order_detail/'.$data->id) }}"><i class="fas fa-info ml-2 text-primary"></i></a>
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