@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            <a href="{{ url('admin/filterValue') }}" class="mdi mdi-arrow-left" onclick="goBack()">
                            </a>
                            Filter Value
                        </h3>
                    </div>
                    <div class="col-12 col-xl-4 mb-0">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                    id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i>
                                    Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        @if(Session::has('error_message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Error: </strong> {{ Session::get('error_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if(Session::has('succses_message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Succses: </strong> {{ Session::get('succses_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form class="forms-sample" @if(!empty($filterValue['id']))
                            action="{{ url('admin/add-edit-filtervalue') }}" @else
                            action="{{ url('admin/add-edit-filtervalue/'.$filterValue['id']) }}" @endif method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="product_filter_id">Select filter</label>
                                <select class="form-control" name="product_filter_id" id="product_filter_id">
                                    <option value="">Select filter</option>
                                    @foreach ($filter as $filters)
                                    <option value="{{ $filters['id'] }}">{{ $filters['filter_nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="filter_value">Filter Value</label>
                                <input type="text" class="form-control" id="filter_value" name="filter_value"
                                    @if(!empty($filterValue['filter_value'])) value="{{ $filterValue['filter_value'] }}"
                                    @else value="{{ old('filter_value') }}" @endif placeholder="Masukkan Filter Value"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
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