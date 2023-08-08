@extends('admin.layouts.layout')
@section('content')
<?php
use App\Models\Product;
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ratings</h4>
                        @if(Session::has('succses_message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Succses: </strong> {{ Session::get('succses_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="ratings" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Product ID
                                        </th>
                                        <th>
                                            User
                                        </th>
                                        <th>
                                            Review
                                        </th>
                                        <th>
                                            Rating
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    @foreach ($ratings as $rating)
                                    @if($rating['rating'])
                                    <tr>
                                        <td>
                                            {{ $no }}
                                        </td>
                                        <td>
                                            {{ $rating['product']['nama'] }}
                                        </td>
                                        <td>
                                            {{ $rating['user']['name'] }}
                                        </td>
                                        <td>
                                            {{ $rating['review'] }}
                                        </td>
                                        <td>
                                            @if($rating['status']==1)
                                            <a title="Status aktif" class="updateRatingStatus"
                                                id="rating-{{ $rating['id'] }}" rating_id="{{ $rating['id'] }}"
                                                href="javascript:void(0)">
                                                <i style="font-size:30px;" class="mdi mdi-bookmark-check"
                                                    status="Active"></i>
                                            </a>
                                            @else
                                            <a title="Status nonaktif" class="updateRatingStatus"
                                                id="rating-{{ $rating['id'] }}" rating_id="{{ $rating['id'] }}"
                                                href="javascript:void(0)">
                                                <i style="font-size:30px;" class="mdi mdi-bookmark-outline"
                                                    status="Inactive"></i>
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $rating['rating'] }}
                                        </td>
                                        <td>
                                            <a title="Hapus brand"  href="javascript:void(0)" class="confirmDelete" module="ratings"
                                                moduleid="{{ $rating['id'] }}">
                                                <i style="font-size:30px;" class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
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
    @include('admin.layouts.footer')
    <!-- partial -->
</div>
@endsection