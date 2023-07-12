@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">banners</h4>
                        <a style="max-width: 150px; float:right; display:inline-block"
                            href="{{ url('admin/add-edit-banner') }}" class="btn btn-block btn-primary">Add banners</a>
                        @if(Session::has('succses_message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Succses: </strong> {{ Session::get('succses_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="pt-3 table-responsive">
                            <table id="banners" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Gambar
                                        </th>
                                        <th>
                                            Link
                                        </th>
                                        <th>
                                            Title
                                        </th>
                                        <th>
                                            alt
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
                                    @foreach ($banners as $banner)
                                    <tr>
                                        <td>
                                            {{ $no }}
                                        </td>
                                        <td>
                                            <img style="width: 180px;"
                                                src="{{ asset('front/images/main-slider/'.$banner['gambar']) }}"
                                                alt="gambar">
                                        </td>
                                        <td>{{ $banner['link'] }}</td>
                                        <td>{{ $banner['title'] }}</td>
                                        <td>{{ $banner['alt'] }}</td>
                                        <td>
                                            @if($banner['status']==1)
                                            <a title="Ubah Status" class="updatebannerstatus"
                                                id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}"
                                                href="javascript:void(0)">
                                                <i style="font-size:30px;" class="mdi mdi-bookmark-check"
                                                    status="Active"></i>
                                            </a>
                                            @else
                                            <a class="updatebannerstatus" id="banner-{{ $banner['id'] }}"
                                                banner_id="{{ $banner['id'] }}" href="javascript:void(0)">
                                                <i style="font-size:30px;" class="mdi mdi-bookmark-outline"
                                                    status="Inactive"></i>
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a title="Edit banner"
                                                href="{{ url('admin/add-edit-banner/'.$banner['id']) }}">
                                                <i style="font-size:30px;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <?php
                                            /*
                                            <a title="section" class="confirmDelete" href="{{ url('admin/delete-section/'.$section['id']) }}">
                                                <i style="font-size:30px;" class="mdi mdi-delete"></i>
                                            </a>
                                            */
                                            ?>
                                            <a title="Hapus banner" href="javascript:void(0)" class="confirmDelete"
                                                module="banner" moduleid="{{ $banner['id'] }}">
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