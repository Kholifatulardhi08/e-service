@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            Products
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
                        <form class="forms-sample" @if(!empty($product['id']))
                            action="{{ url('admin/add-edit-product') }}" @else
                            action="{{ url('admin/add-edit-product/'.$product['id']) }}" @endif method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    @foreach ($category as $section)
                                    <optgroup label="{{ $section['nama'] }}"></optgroup>
                                    @foreach ($section['category'] as $categories)
                                    <option @if(!empty($product['category_id']==$categories['id'])) @endif selected=""
                                        value="{{ $categories['id'] }}">---&nbsp;{{
                                        $categories['nama'] }}</option>
                                    @endforeach
                                    @foreach ($categories['subcategory'] as $subcategories)
                                    <option @if(!empty($product['category_id']==$categories['id'])) @endif selected=""
                                        value="{{ $subcategories['id'] }}">&nbsp;&nbsp;&nbsp;---&nbsp;{{
                                        $subcategories['nama'] }}</option>
                                    @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand_id">Brand</label>
                                <select class="form-control" name="brand_id" id="brand_id">
                                    @foreach ($brand as $brands)
                                    <option @if(!empty($product['brand_id']==$brands['id'])) selected="" @endif
                                        value="{{ $brands['id'] }}">{{ $brands['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="loadfilters">
                                @include('admin.filter.category_filter')
                            </div>
                            <div class="form-group">
                                <label for="nama">Name</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    @if(!empty($product['nama'])) value="{{ $product['nama'] }}" @else
                                    value="{{ old('nama') }}" @endif placeholder="Masukkan nama product anda" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" cols="3"
                                    rows="5"> {{ $product['deskripsi'] }} </textarea>
                            </div>
                            <div class="form-group">
                                <label for="harga">Tanda Jadi</label>
                                <input type="text" class="form-control" id="harga" name="harga"
                                    @if(!empty($product['harga'])) value="{{ $product['harga'] }}" @else
                                    value="{{ old('harga') }}" @endif placeholder="Masukkan DP product anda" required>
                            </div>
                            <div class="form-group">
                                <label for="diskon">product Discount</label>
                                <input type="text" class="form-control" id="diskon" name="diskon"
                                    @if(!empty($product['diskon'])) value="{{ $product['diskon'] }}" @else
                                    value="{{ old('diskon') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Product gambar(Recomended size 1000x1000)</label>
                                <input type="file" class="form-control" id="gambar" name="gambar">
                                @if(!empty($product['gambar']))
                                <a target="_blank"
                                    href="{{ url('template/images/Photo/Product/Large/'.$product['gambar']) }}">
                                    View image
                                </a> &nbsp;|&nbsp;
                                <a href="javascript:void(0)" class="confirmDelete" module="product-gambar"
                                    moduleid="{{ $product['id'] }}">
                                    Delete image
                                </a>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="video">Product video (Recomended size less 10Mb)</label>
                                <input type="file" class="form-control" id="video" name="video">
                                @if(!empty($product['video']))
                                <a target="_blank" href="{{ url('template/images/Photo/Video/'.$product['video']) }}">
                                    View image
                                </a> &nbsp;|&nbsp;
                                <a href="javascript:void(0)" class="confirmDelete" module="product-video"
                                    moduleid="{{ $product['id'] }}">
                                    Delete image
                                </a>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="meta_title">Title product</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title"
                                    @if(!empty($product['meta_title'])) value="{{ $product['meta_title'] }}" @else
                                    value="{{ old('meta_title') }}" @endif placeholder="Masukkan title product anda"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Deskripsi product</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description"
                                    @if(!empty($product['meta_description'])) value="{{ $product['meta_description'] }}"
                                    @else value="{{ old('meta_description') }}" @endif
                                    placeholder="Masukkan meta deskripsi product anda" required>
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">Keyword product</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                    @if(!empty($product['meta_keywords'])) value="{{ $product['meta_keywords'] }}" @else
                                    value="{{ old('meta_keywords') }}" @endif
                                    placeholder="Masukkan keyword product anda" required>
                            </div>
                            <div class="form-group">
                                <label for="is_featured">Is Featured</label>
                                <input type="checkbox" id="is_featured" name="is_featured" value="Yes"
                                    @if(!empty($product['is_featured']) && $product['is_featured']=="Yes" ) checked=""
                                    @endif>
                            </div>
                            <div class="form-group">
                                <label for="is_bestseller">Best Seller</label>
                                <input type="checkbox" id="is_bestseller" name="is_bestseller" value="Yes"
                                    @if(!empty($product['is_bestseller']) && $product['is_bestseller']=="Yes" )
                                    checked="" @endif>
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