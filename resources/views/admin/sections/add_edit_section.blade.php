@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            <a href="{{ url('admin/section') }}" class="mdi mdi-arrow-left" onclick="goBack()">
                            </a>
                            Settings Section
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        <form class="forms-sample" @if(!empty($section['id']))
                            action="{{ url('admin/add-edit-section') }}" @else
                            action="{{ url('admin/add-edit-section/'.$sections['id']) }}" @endif method="POST"
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
                                <label for="nama">Name</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    @if(!empty($sections['nama'])) value="{{ $sections['nama'] }}" @else
                                    value="{{ old('nama') }}" @endif placeholder="Masukkan nama section anda" required>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
                            <li>Masukkan atau perbarui nama bagian di kolom "Name".</li>
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