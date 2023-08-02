@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            Welcome, {{ Auth::guard('admin')->user()->nama }}
                        </h3>
                        <h6 class="font-weight-normal mb-0">
                            All systems are running smoothly!
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin transparent">
                <div class="row">
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">
                                    Number of Users
                                </p>
                                <p class="fs-30 mb-2">{{ $totalUsers }}</p>
                                <p>Penyewa Users</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">
                                    Number of Penyedia
                                </p>
                                <p class="fs-30 mb-2">{{ $penyediaCount }}</p>
                                <p>Penyedia Users</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">
                                    Number of orders
                                </p>
                                <p class="fs-30 mb-2">{{ $orderCount }}</p>
                                <p>Users Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin\layouts\footer')
    <!-- partial -->
</div>
@endsection