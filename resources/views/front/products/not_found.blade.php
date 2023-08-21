@extends('front.layouts.layout')
@section('content')
<div class="search-page-wrapper">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 70vh;">
            <div class="col-md-6 text-center">
                <h2 class="mb-3">Oops! Product Not Found</h2>
                <p class="mb-4">{{ $error_message }}</p>
                <a href="/" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection