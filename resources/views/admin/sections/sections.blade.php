@extends('admin.layouts.layout')
@section('content')
<style>
    .section-info {
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .section-description {
        font-size: 18px;
        margin-bottom: 15px;
    }

    .section-instructions {
        font-size: 16px;
    }

    .section-highlight {
        font-weight: bold;
        color: #007bff;
    }

    .table-responsive {
        margin-top: 20px;
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-info">
                    <p class="section-description">
                        <strong>Selamat datang di halaman pengelolaan section!</strong><br>
                        Section adalah bagian-bagian pada situs web Anda yang memuat konten khusus atau informasi
                        tertentu. Di sini, Anda memiliki kemampuan untuk mengelola dan mengatur tampilan berbagai
                        section di halaman depan situs Anda.
                    </p>
                    <p class="section-instructions">
                        <span class="section-highlight">Bagaimana cara mengelola section?</span><br>
                        Anda dapat dengan mudah menambah, mengedit, dan menghapus section di halaman ini. Gunakan tombol
                        "Tambah Section" di sudut kanan atas untuk membuat section baru. Selain itu, Anda dapat mengatur
                        status aktif atau nonaktif untuk setiap section yang ada.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pengelolaan Section</h4>
                        <a style="max-width: 150px; float:right; display:inline-block"
                            href="{{ url('admin/add-edit-section') }}" class="btn btn-block btn-primary">Tambah
                            Section</a>
                        @if(Session::has('succses_message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Sukses: </strong> {{ Session::get('succses_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="sections" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    @foreach ($sections as $section)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $section['nama'] }}</td>
                                        <td>
                                            @if($section['status']==1)
                                            <a title="Status aktif" class="updateSectionStatus"
                                                id="section-{{ $section['id'] }}" section_id="{{ $section['id'] }}"
                                                href="javascript:void(0)">
                                                <i style="font-size:20px;" class="mdi mdi-bookmark-check"
                                                    status="Aktif"></i>
                                            </a>
                                            @else
                                            <a title="Status nonaktif" class="updateSectionStatus"
                                                id="section-{{ $section['id'] }}" section_id="{{ $section['id'] }}"
                                                href="javascript:void(0)">
                                                <i style="font-size:20px;" class="mdi mdi-bookmark-outline"
                                                    status="Nonaktif"></i>
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a title="Edit section"
                                                href="{{ url('admin/add-edit-section/'.$section['id']) }}">
                                                <i style="font-size:20px;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <a title="Hapus section" href="javascript:void(0)" class="confirmDelete"
                                                module="section" moduleid="{{ $section['id'] }}">
                                                <i style="font-size:20px;" class="mdi mdi-delete"></i>
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