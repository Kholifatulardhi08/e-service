@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            Tambah Attribute
                        </h3>
                        <h6 class="font-weight-normal mb-0">
                            <a href="{{ url('admin/products') }}">
                                back
                            </a>
                        </h6>
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
                        <h4 class="card-title">Add/Edit Attribute</h4>
                        <div class="row">
                            <div class="col-6">
                                @if(Session::has('error_message'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Error: </strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                @if(Session::has('succses_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                                <form class="forms-sample" action="{{ url('admin/add-edit-atribute/'.$product['id']) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <h4>Name : {{ $product['nama'] }}</h4>
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div class="">
                                                <input type="text" name="paket[]" placeholder="Paket"
                                                    style="width: 120px;" required="" />
                                                <input type="text" name="harga[]" placeholder="Harga"
                                                    style="width: 120px;" required="" />
                                                <input type="text" name="keterangan[]" placeholder="Keterangan"
                                                    style="width: 150px;" required="" />
                                                <input type="text" name="stock[]" placeholder="jam/hari"
                                                    style="width: 100px;" required="" />
                                                <a href="javascript:void(0);" class="add_button" title="Add field">
                                                    Add
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset" class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                            <div class="col-6">
                                <h4 class="card-title">All Attribute</h4>
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
                                                        Paket
                                                    </th>
                                                    <th>
                                                        Harga
                                                    </th>
                                                    <th>
                                                        Stock
                                                    </th>
                                                    <th>
                                                        Keterangan
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
                                                @foreach ($product['attribute'] as $attribute)
                                                <input style="display: none;" name="id[]" id="id[]"
                                                    value="{{ $attribute['id'] }}">
                                                <tr>
                                                    <td>{{ $no }}</td>
                                                    <td>{{ $attribute['paket'] }}</td>
                                                    <td>
                                                        <input style="width: 70px;" type="number" name="harga[]"
                                                            value="{{ $attribute['harga'] }}" required>
                                                    </td>
                                                    <td>
                                                        <input style="width: 70px;" type="text" name="stock[]"
                                                            value="{{ $attribute['stock'] }}" required>
                                                    </td>
                                                    <td>
                                                        <input style="width: 250px;" type="text" name="keterangan[]"
                                                            value="{{ $attribute['keterangan'] }}" required>
                                                    </td>
                                                    <td>
                                                        @if($attribute['status']==1)
                                                        <a class="updateattributeStatus"
                                                            id="attribute-{{ $attribute['id'] }}"
                                                            attribute_id="{{ $attribute['id'] }}"
                                                            href="javascript:void(0)">
                                                            <i style="font-size:30px;" class="mdi mdi-bookmark-check"
                                                                status="Active"></i>
                                                        </a>
                                                        @else
                                                        <a class="updateattributeStatus"
                                                            id="attribute-{{ $attribute['id'] }}"
                                                            attribute_id="{{ $attribute['id'] }}"
                                                            href="javascript:void(0)">
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
                                                            module="atrribute" moduleid="{{ $attribute['id'] }}">
                                                            <i style="font-size:30px;" class="mdi mdi-delete"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $no++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-primary">Update</button>
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