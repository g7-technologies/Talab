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
                <h4 class="page-title">View All Promotions</h4>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session('error_msg'))
                        <p class="alert alert-danger">{{session('error_msg')}}</p> 
                    @endif
                    @if(session('success_msg'))
                        <p class="alert alert-success">{{session('success_msg')}}</p> 
                    @endif

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Coupon Code</th>
                            <th>Discount</th>
                            <th>Promotion Type</th>
                            <th>Created On</th>
                            <th>Valid Till</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($promotions as $data)
                            <tr>
                                <td>{{$data->code}}</td>
                                <td>{{$data->discount}}%</td>
                                <td>
                                    @if($data->promotion_type == 1)
                                    Shop Promotion
                                    @else
                                    Delivery Promotion
                                    @endif
                                </td>
                                <td><?php echo date_format($data->created_at,"Y-m-d"); ?></td>
                                <td>{{$data->valid_till}}</td>
                                <td>
                                    <a href="{{url('/delete_promotion/'.$data->id)}}"><i class="far fa-trash-alt text-danger"></i></a>
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