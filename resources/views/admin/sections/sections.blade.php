@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Section</h4>
                        <a style="max-width: 150px; float:right; display:inline-block" href="{{ url('admin/add-edit-section') }}" class="btn btn-block btn-primary">Add Section</a>
                        @if(Session::has('succses_message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Succses: </strong> {{ Session::get('succses_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="sections" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            status
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    @foreach ($sections as $section)
                                    <tr>
                                        <td>
                                            {{ $no }}
                                        </td>
                                        <td>
                                            {{ $section['nama'] }}
                                        </td>
                                        <td>
                                            @if($section['status']==1)
                                            <a title="Status aktif" class="updateSectionStatus" id="section-{{ $section['id'] }}"
                                                section_id="{{ $section['id'] }}" href="javascript:void(0)">
                                                <i style="font-size:30px;" class="mdi mdi-bookmark-check"
                                                    status="Active"></i>
                                            </a>
                                            @else
                                            <a title="Status nonaktif" class="updateSectionStatus" id="section-{{ $section['id'] }}"
                                                section_id="{{ $section['id'] }}" href="javascript:void(0)">
                                                <i style="font-size:30px;" class="mdi mdi-bookmark-outline"
                                                    status="Inactive"></i>
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a title="Edit section" href="{{ url('admin/add-edit-section/'.$section['id']) }}">
                                                <i style="font-size:30px;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <?php
                                            /*
                                            <a title="section" class="confirmDelete" href="{{ url('admin/delete-section/'.$section['id']) }}">
                                                <i style="font-size:30px;" class="mdi mdi-delete"></i>
                                            </a>
                                            */
                                            ?>
                                            <a title="Hapus section" href="javascript:void(0)" class="confirmDelete" module="section"
                                                moduleid="{{ $section['id'] }}">
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