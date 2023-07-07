@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">products</h4>
                        <a style="max-width: 150px; float:right; display:inline-block"
                            href="{{ url('admin/add-edit-product') }}" class="btn btn-block btn-primary">Add Product</a>
                        @if(Session::has('succses_message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Succses: </strong> {{ Session::get('succses_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="products" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Harga
                                        </th>
                                        <th>
                                            Category
                                        </th>
                                        <th>
                                            Section
                                        </th>
                                        <th>
                                            Pembuat
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
                                    @foreach ($product as $products)
                                    <tr>
                                        <td>
                                            {{ $no }}
                                        </td>
                                        <td>
                                            {{ $products['nama'] }}
                                        </td>
                                        <td>{{ $products['harga'] }}</td>
                                        <td>{{ $products['category']['nama'] }}</td>
                                        <td>{{ $products['section']['nama'] }}</td>
                                        <td>
                                            @if($products['type']=="penyedia")
                                            <a target="_blank"
                                                href="{{ url('admin/view_penyedia_details/'.$products['admin_id']) }}">{{
                                                ucfirst($products['type']) }}</a>
                                            @else
                                            {{ ucfirst($products['type']) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($products['gambar']))
                                            <center>
                                                <img style="width: 120px; height: 120px;" src="{{ asset('template/images/Photo/Product/Small/'.$products['gambar']) }}"
                                                    alt="Gambar">
                                            </center>
                                            @else
                                            <center>
                                                <img style="width: 120px; height: 120px;" src="{{ asset('template/images/Photo/Product/Small/no_image.jpg') }}"
                                                    alt="No Image">
                                            </center>
                                            @endif
                                        </td>
                                        <td>
                                            @if($products['status']==1)
                                            <a class="updateproductStatus" id="product-{{ $products['id'] }}"
                                                product_id="{{ $products['id'] }}" href="javascript:void(0)">
                                                <i style="font-size:30px;" class="mdi mdi-bookmark-check"
                                                    status="Active"></i>
                                            </a>
                                            @else
                                            <a class="updateproductStatus" id="product-{{ $products['id'] }}"
                                                product_id="{{ $products['id'] }}" href="javascript:void(0)">
                                                <i style="font-size:30px;" class="mdi mdi-bookmark-outline"
                                                    status="Inactive"></i>
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/add-edit-product/'.$products['id']) }}">
                                                <i style="font-size:30px;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <?php
                                            /*
                                            <a title="section" class="confirmDelete" href="{{ url('admin/delete-section/'.$section['id']) }}">
                                                <i style="font-size:30px;" class="mdi mdi-delete"></i>
                                            </a>
                                            */
                                            ?>
                                            <a href="javascript:void(0)" class="confirmDelete" module="product"
                                                moduleid="{{ $products['id'] }}">
                                                <i style="font-size:30px;" class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $no++; ?>
                                    @endforeach
                                </tbody>
                            </table>
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