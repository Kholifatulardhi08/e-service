@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            Add Category
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
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
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
                        <form class="forms-sample" @if(!empty($category['id']))
                            action="{{ url('admin/add-edit-category') }}" @else
                            action="{{ url('admin/add-edit-category/'.$category['id']) }}" @endif method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Name</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    @if(!empty($category['nama'])) value="{{ $category['nama'] }}" @else
                                    value="{{ old('nama') }}" @endif placeholder="Masukkan nama category anda" required>
                            </div>
                            <div class="form-group">
                                <label for="section_id">Section</label>
                                <select class="form-control" name="section_id" id="section_id">
                                    <option value="">Pilih section</option>
                                    @foreach($getSections as $gs )
                                    <option selected="" value="{{ $gs['id'] }}">{{ $gs['nama'] }}
                                        @if(!empty($category['section_id']) && $category['section_id']==$gs['id'])
                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="appendCategoryLevel">
                                @include('admin.category.appendCategoryLevel')
                            </div>
                            <div class="form-group">
                                <label for="diskon">Category Discount</label>
                                <input type="text" class="form-control" id="diskon" name="diskon"
                                    @if(!empty($category['diskon'])) value="{{ $category['diskon'] }}" @else
                                    value="{{ old('diskon') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" cols="3"
                                    rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="url">Url Category</label>
                                <input type="text" class="form-control" id="url" name="url"
                                    @if(!empty($category['url'])) value="{{ $category['url'] }}" @else
                                    value="{{ old('url') }}" @endif placeholder="Masukkan url category anda" required>
                            </div>
                            <div class="form-group">
                                <label for="meta_title">Title Category</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title"
                                    @if(!empty($category['meta_title'])) value="{{ $category['meta_title'] }}" @else
                                    value="{{ old('meta_title') }}" @endif placeholder="Masukkan title category anda"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Deskripsi Category</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description"
                                    @if(!empty($category['meta_description']))
                                    value="{{ $category['meta_description'] }}" @else
                                    value="{{ old('meta_description') }}" @endif
                                    placeholder="Masukkan meta deskripsi category anda" required>
                            </div>
                            <div class="form-group">
                                <label for="meta_keyword">Keyword Category</label>
                                <input type="text" class="form-control" id="meta_keyword" name="meta_keyword"
                                    @if(!empty($category['meta_keyword'])) value="{{ $category['meta_keyword'] }}" @else
                                    value="{{ old('meta_keyword') }}" @endif
                                    placeholder="Masukkan keyword category anda" required>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
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