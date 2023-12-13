@extends('layouts.app')
@section('title', 'DashBoard')
@section('styles')

@endsection

@section('content')

    @section('content')

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Dashboard</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <div class="row">
            <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-2 fw-semibold">{{$totalCategories}}</h3>
                                <p class="text-muted fs-13 mb-0">Total Categories</p>
                                <p class="text-muted mb-0 mt-2 fs-12">
                                                        <span class="icn-box text-success fw-semibold fs-13 me-1">
                                                            <i class="fa fa-long-arrow-up"></i>
                                                            {{$totalCategoriesToday}}</span>
                                    Today
                                </p>
                            </div>
                            <div class="col col-auto top-icn dash">
                                <div class="counter-icon custom-background-icon-categories ms-auto box-shadow-primary">
                                    <i class="fe fe-layers" data-bs-toggle="tooltip" title="" data-bs-original-title="fe fe-layers" aria-label="fe fe-layers"></i>                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-2 fw-semibold">{{$totalAudios}}</h3>
                                <p class="text-muted fs-13 mb-0">Total Audios</p>
                                <p class="text-muted mb-0 mt-2 fs-12">
                                                           <span class="icn-box text-success fw-semibold fs-13 me-1">
                                                            <i class="fa fa-long-arrow-up"></i>
                                                            {{$totalAudiosToday}}</span>
                                    Today
                                </p>
                            </div>
                            <div class="col col-auto top-icn dash">
                                <div class="counter-icon custom-background-icon-audio  ms-auto box-shadow-secondary">
                                    <i class="fe fe-speaker" data-bs-toggle="tooltip" title="" data-bs-original-title="fe fe-speaker" aria-label="fe fe-speaker"></i>                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-2 fw-semibold">{{$totalUsers}}</h3>
                                <p class="text-muted fs-13 mb-0">Total Users</p>
                                <p class="text-muted mb-0 mt-2 fs-12">
                                                        <span class="icn-box text-success fw-semibold fs-13 me-1">
                                                            <i class="fa fa-long-arrow-up"></i>
                                                            {{$totalUsersToday}}</span>
                                    Today
                                </p>
                            </div>
                            <div class="col col-auto top-icn dash">
                                <div class="counter-icon custom-background-icon-user  ms-auto box-shadow-info">
                                    <i class="fe fe-user" data-bs-toggle="tooltip" title="" data-bs-original-title="fe fe-user" aria-label="fe fe-user"></i>                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-2 fw-semibold">{{$totalRoles}}</h3>
                                <p class="text-muted fs-13 mb-0">Total Roles</p>
                                <p class="text-muted mb-0 mt-2 fs-12">
                                                        <span class="icn-box text-success fw-semibold fs-13 me-1">
                                                            <i class="fa fa-long-arrow-up"></i>
                                                           {{$totalRolesToday}}</span>
                                    Today
                                </p>
                            </div>
                            <div class="col col-auto top-icn dash">
                                <div class="counter-icon custom-background-icon-role ms-auto box-shadow-warning">
                                    <i class="fe fe-check-circle  " data-bs-toggle="tooltip" title="" data-bs-original-title="fe fe-check-circle" aria-label="fe fe-check-circle"></i>                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection

@endsection



@section('scripts')


@endsection
