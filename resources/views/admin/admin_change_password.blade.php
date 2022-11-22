@extends('layouts.admin_master')
@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Change Password</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">        
                    <h4 class="mt-0 header-title">Change Password</h4>
                    <p class="text-muted mb-3">All fields with <code class="highlighter-rouge">(*)</code> are mandatory.</p>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            @if(session('success_msg'))
                                <p class="alert alert-success">{{session('success_msg')}}</p> 
                            @endif
                            @if(session('error_msg'))
                                <p class="alert alert-danger">{{session('error_msg')}}</p> 
                            @endif
                            <form class="form-horizontal auth-form my-4" method="post" action="{{url('/admin_change_password_submit')}}">
                            @csrf
                                
                                <div class="form-group row">
                                    <label for="old_password" class="col-sm-2 col-form-label text-left">Old Password <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" id="old_password" name="old_password" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="new_password" class="col-sm-2 col-form-label text-left">New Password <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" id="new_password" name="new_password" required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="confirm_password" class="col-sm-2 col-form-label text-left">Confirm Password <code class="highlighter-rouge">*</code></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" id="confirm_password" name="confirm_password" required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-gradient-primary px-5 py-2">Update</button>
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