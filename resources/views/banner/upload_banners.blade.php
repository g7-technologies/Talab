@extends('layouts.admin_master')
@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <!--<div class="float-right">-->
                <!--    <ol class="breadcrumb">-->
                <!--        <li class="breadcrumb-item"><a href="javascript:void(0);">Metrica</a></li>-->
                <!--        <li class="breadcrumb-item"><a href="javascript:void(0);">UI Kit</a></li>-->
                <!--        <li class="breadcrumb-item active">Form Elements</li>-->
                <!--    </ol>-->
                <!--</div>-->
                <h4 class="page-title">Upload Banner</h4>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">        
                    <h4 class="mt-0 header-title">Add Banner Image</h4>
                    <p class="text-muted mb-3">Banner Size Should Be <code class="highlighter-rouge">1920 x 450</code></p>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            
                            @if(session('error_msg'))
                                <p class="alert alert-danger">{{session('error_msg')}}</p> 
                            @endif
                            @if(session('success_msg'))
                                <p class="alert alert-success">{{session('success_msg')}}</p> 
                            @endif

                            <form class="form-horizontal auth-form my-4" method="post" action="{{url('/upload_banners_submit')}}"  enctype="multipart/form-data">
                            @csrf

                                <div class="form-group row">
                                    
                                    <div class="col-md-12">
                                        <input type="file" id="img" name="img" class="dropify" required/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-gradient-primary px-5 py-2">Upload Banner</button>
                                    </div>
                                </div>
                            
                            </form>

                        </div>
                    </div>                                                                      
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')

@endpush