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
                <h4 class="page-title">View All Complains</h4>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card">
                <div class="card-body">
                    <div class="task-box">
                        <div class="task-priority-icon"><i class="fas fa-circle text-danger"></i></div>
                        <p class="text-muted float-right">
                            <span class="badge badge-danger mr-2">Stop</span>
                            <span class="text-muted">01:33</span> /
                            <span class="text-muted">9:30</span>
                            <span class="mx-1">·</span>
                            <span><i class="far fa-fw fa-clock"></i> June 18</span>
                        </p>
                        <h5 class="mt-0">Body Care</h5>
                        <p class="text-muted mb-1">There are many variations of passages of Lorem Ipsum available,
                            but the majority have suffered alteration in some form.
                        </p>
                        <div class="d-flex justify-content-between">
                            <div class="img-group">
                                <a class="user-avatar user-avatar-group" href="#">
                                    <img src="{{ asset('public/assets/images/users/user-3.jpg') }}" alt="user" class="rounded-circle thumb-xs">
                                </a>
                                <a class="user-avatar user-avatar-group" href="#">
                                    <img src="{{ asset('public/assets/images/users/user-5.jpg') }}" alt="user" class="rounded-circle thumb-xs">
                                </a>
                                <a class="user-avatar user-avatar-group" href="#">
                                    <img src="{{ asset('public/assets/images/users/user-7.jpg') }}" alt="user" class="rounded-circle thumb-xs">
                                </a>
                            </div>
                            <ul class="list-inline mb-0 align-self-center">
                                <li class="list-item d-inline-block">
                                    <button class="btn btn-link ml-4 shadow-none" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                       <i class="mdi mdi-comment-outline text-primary font-15"></i>
                                    </button>
                                </li>
                                <li class="list-item d-inline-block">
                                    <button class="btn btn-link ml-4 shadow-none" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                       <i class="mdi mdi-pencil-outline text-muted font-18"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="accordion" id="accordionExample-faq">
                        <div class="card shadow-none border mb-1">
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample-faq">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection