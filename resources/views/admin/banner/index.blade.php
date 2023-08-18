@extends('admin.layouts.layout')
@section('content')
<style>
    .banner-info {
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .banner-description {
        font-size: 18px;
        margin-bottom: 15px;
    }

    .banner-instructions {
        font-size: 16px;
    }

    .banner-highlight {
        font-weight: bold;
        color: #007bff;
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-info">
                        <p class="banner-description">
                            <strong>Selamat datang di halaman pengelolaan banner!</strong><br>
                            Banner adalah elemen visual yang digunakan untuk menampilkan pesan promosi, informasi
                            penting, atau konten visual menarik di situs web Anda. Di sini, Anda memiliki kendali penuh
                            atas tampilan banner di halaman depan situs.
                        </p>
                        <p class="banner-instructions">
                            <span class="banner-highlight">Bagaimana cara mengelola banner?</span><br>
                            Anda dapat dengan mudah menambah, mengedit, menghapus, dan mengatur status banner di sini.
                            Gunakan tombol "Tambah Banner" di sudut kanan atas untuk membuat banner baru. Anda juga bisa mengoperasikan edit banner untuk mengedit informasi banner atau hapus banner untuk menghapusnya.
                        </p>
                    </div>
                </div>
            </div>
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
                                            Type
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
                                        <td>{{ $banner['type'] }}</td>
                                        <td>{{ $banner['link'] }}</td>
                                        <td>{{ $banner['title'] }}</td>
                                        <td>{{ $banner['alt'] }}</td>
                                        <td>
                                            @if($banner['status']==1)
                                            <a title="Status aktif" class="updatebannerstatus"
                                                id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}"
                                                href="javascript:void(0)">
                                                <i style="font-size:30px;" class="mdi mdi-bookmark-check"
                                                    status="Active"></i>
                                            </a>
                                            @else
                                            <a title="Status nonaktif" class="updatebannerstatus"
                                                id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}"
                                                href="javascript:void(0)">
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