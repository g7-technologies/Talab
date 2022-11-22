@extends('layouts.admin_master')
@section('content')
<div class="container-fluid">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">View All Banners</h4>
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
                            <th>Image</th>
                            <th>Uploaded On</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($banners as $data)
                            <tr>
                                <td>
                                    <img src="{{asset('public/banner_images/'.$data->name)}}" width="100%" height="100%"/>
                                </td>
                                <td><?php echo date_format($data->created_at,"Y-m-d"); ?></td>
                                <td>
                                    <a href="{{url('/delete_banner/'.$data->id)}}"><i class="far fa-trash-alt text-danger"></i></a>
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