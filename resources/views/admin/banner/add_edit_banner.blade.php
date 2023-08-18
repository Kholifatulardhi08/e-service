@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="mb-4 col-12 col-xl-8 mb-xl-0">
                        <h3 class="font-weight-bold">
                            Tambah Banner
                        </h3>
                        <h6 class="font-weight-normal mb-0">
                            <a href="{{ url('admin/banners') }}">
                                back
                            </a>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        <form class="forms-sample" @if(!empty($banner['id']))
                            action="{{ url('admin/add-edit-banner') }}" @else
                            action="{{ url('admin/add-edit-banner/'.$banner['id']) }}" @endif method="POST"
                            enctype="multipart/form-data">
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
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="">select</option>
                                    <option @if(!empty($banner['type']) && $banner['type']=="Slider" ) selected=""
                                        @endif value="Slider">Slider</option>
                                    <option @if(!empty($banner['type']) && $banner['type']=="Fix" ) selected="" @endif
                                        value="Fix">Fix</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Banner gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar">
                                @if(!empty($banner['gambar']))
                                <a target="_blank" href="{{ url('front/images/main-slider/'.$banner['gambar']) }}">
                                    View gambar
                                </a>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" class="form-control" id="link" name="link"
                                    @if(!empty($banner['link'])) value="{{ $banner['link'] }}" @else
                                    value="{{ old('link') }}" @endif placeholder="Masukkan link category anda" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    @if(!empty($banner['title'])) value="{{ $banner['title'] }}" @else
                                    value="{{ old('title') }}" @endif placeholder="Masukkan title category anda"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="alt">Alt</label>
                                <input type="text" class="form-control" id="alt" name="alt" @if(!empty($banner['alt']))
                                    value="{{ $banner['alt'] }}" @else value="{{ old('alt') }}" @endif
                                    placeholder="Masukkan alt banner anda" required>
                            </div>
                            <button type="submit" class="mr-2 btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Cara Mengisi Formulir</h4>
                        <p>Ikuti langkah-langkah berikut untuk mengisi formulir dengan benar:</p>
                        <ol>
                            <li>Pilih jenis <strong>type</strong> banner dari menu dropdown.</li>
                            <li>Unggah gambar banner menggunakan tombol <strong>Banner gambar</strong>.</li>
                            <li>Isi tautan banner pada kolom <strong>Link</strong>.</li>
                            <li>Isi judul banner pada kolom <strong>Title</strong>.</li>
                            <li>Isi teks alternatif banner pada kolom <strong>Alt</strong>.</li>
                            <li>Klik tombol <strong>Submit</strong> untuk menyimpan perubahan.</li>
                            <li>Jika ingin menghapus inputan yang telah dimasukkan, klik tombol <strong>Cancel</strong>.
                            </li>
                        </ol>
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