@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Brand</h4>
                        <a style="max-width: 150px; float:right; display:inline-block"
                            href="{{ url('admin/add-edit-brand') }}" class="btn btn-block btn-primary">Add Brand</a>
                        @if(Session::has('succses_message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Succses: </strong> {{ Session::get('succses_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="brands" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            status
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    @foreach ($brands as $brand)
                                    <tr>
                                        <td>
                                            {{ $no }}
                                        </td>
                                        <td>
                                            {{ $brand['nama'] }}
                                        </td>
                                        <td>
                                            @if($brand['status']==1)
                                            <a class="updatebrandStatus" id="brand-{{ $brand['id'] }}"
                                                brand_id="{{ $brand['id'] }}" href="javascript:void(0)">
                                                <i style="font-size:30px;" class="mdi mdi-bookmark-check"
                                                    status="Active"></i>
                                            </a>
                                            @else
                                            <a class="updatebrandStatus" id="brand-{{ $brand['id'] }}"
                                                brand_id="{{ $brand['id'] }}" href="javascript:void(0)">
                                                <i style="font-size:30px;" class="mdi mdi-bookmark-outline"
                                                    status="Inactive"></i>
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/add-edit-brand/'.$brand['id']) }}">
                                                <i style="font-size:30px;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <?php
                                            /*
                                            <a title="section" class="confirmDelete" href="{{ url('admin/delete-section/'.$section['id']) }}">
                                                <i style="font-size:30px;" class="mdi mdi-delete"></i>
                                            </a>
                                            */
                                            ?>
                                            <a href="javascript:void(0)" class="confirmDelete" module="brand"
                                                moduleid="{{ $brand['id'] }}">
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