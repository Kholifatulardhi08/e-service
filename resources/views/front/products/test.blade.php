@extends('front.layouts.layout')

@section('content')
<!-- Search Page Wrapper -->
<div class="search-page-wrapper">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="product-list">
                    @foreach ($productDataList as $product)
                        <div class="product">
                            
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Search Page Wrapper /- -->
@endsection
