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
                <h4 class="page-title">Shop Invitation Link</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">        
                    <h4 class="mt-0 header-title">Send Invitation Link To Shop</h4>
                    <p class="text-muted mb-3">All fields with <code class="highlighter-rouge">(*)</code> are mandatory.</p>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            @if(session('success_msg'))
                                <p class="alert alert-success">{{session('success_msg')}}</p> 
                            @endif
                            @if(session('error_msg'))
                                <p class="alert alert-danger">{{session('error_msg')}}</p> 
                            @endif
                            <form class="form-horizontal auth-form my-4" method="post" action="{{url('/shop_invitation_link_submit')}}">
                            @csrf
                                
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label text-left">Email <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email" id="email" name="email" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-gradient-primary px-5 py-2">Send Invitation Link</button>
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