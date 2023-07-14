@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            Images
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
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tentang Product</h4>
                        <div class="row">
                            <div class="col-6">
                                <form class="forms-sample" action="{{ url('admin/add-image/'.$product['id']) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
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
                                    <h4>Name : {{ $product['nama'] }}</h4>
                                    <div class="form-group">
                                        @if(!empty($product['gambar']))
                                        <img style="width: 120px;"
                                            src="{{ asset('template/images/Photo/Product/Medium/'.$product['gambar']) }}"
                                            alt="Gambar">
                                        @else
                                        <img style="width: 120px;"
                                            src="{{ asset('template/images/Photo/Product/Small/no_image.jpg') }}"
                                            alt="No Image">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <input type="file" id="image" name="image[]" multiple="">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                            <div class="col-6">
                                <h4 class="card-title">All Image</h4>
                                <div class="table-responsive pt-3">
                                    <form method="POST" action="{{ url('admin/edit-atribute/'.$product['id']) }}">
                                        @csrf
                                        <table id="products" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        No
                                                    </th>
                                                    <th>
                                                        Gambar
                                                    </th>
                                                    <th>
                                                        status
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1;?>
                                                @foreach ($product['image'] as $images)
                                                <tr>
                                                    <td>{{ $no }}</td>
                                                    <td><img src="{{ url('template/images/Photo/Product/Small/'.$images['nama']) }}"
                                                            alt=""></td>
                                                    <td>
                                                        @if($images['status']==1)
                                                        <a class="updateimagesStatus" id="image-{{ $images['id'] }}"
                                                            image_id="{{ $images['id'] }}" href="javascript:void(0)">
                                                            <i style="font-size:30px;" class="mdi mdi-bookmark-check"
                                                                status="Active"></i>
                                                        </a>
                                                        @else
                                                        <a class="updateimagesStatus" id="image-{{ $images['id'] }}"
                                                            image_id="{{ $images['id'] }}" href="javascript:void(0)">
                                                            <i style="font-size:30px;" class="mdi mdi-bookmark-outline"
                                                                status="Inactive"></i>
                                                        </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <?php
                                                        /*
                                                        <a title="section" class="confirmDelete" href="{{ url('admin/delete-section/'.$section['id']) }}">
                                                            <i style="font-size:30px;" class="mdi mdi-delete"></i>
                                                        </a>
                                                        */
                                                        ?>
                                                        <a href="javascript:void(0)" class="confirmDelete"
                                                            module="images" moduleid="{{ $images['id'] }}">
                                                            <i style="font-size:30px;" class="mdi mdi-delete"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $no++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button type="reset" class="btn btn-primary">Cancel</button>
                                    </form>
                                </div>
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