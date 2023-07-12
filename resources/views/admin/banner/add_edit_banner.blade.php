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
                    </div>
                    <div class="mb-0 col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="bg-white btn btn-sm btn-light dropdown-toggle" type="button"
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
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin\layouts\footer')
    <!-- partial -->
</div>
@endsection