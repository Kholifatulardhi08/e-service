@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Type
                                        </th>
                                        <th>
                                            Handphone
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Gambar
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
                                    @foreach ($admins as $admin)
                                    <tr>
                                        <td>
                                            {{ $no }}
                                        </td>
                                        <td>
                                            {{ $admin['nama'] }}
                                        </td>
                                        <td>
                                            {{ $admin['type'] }}
                                        </td>
                                        <td>
                                            {{ $admin['no_hp'] }}
                                        </td>
                                        <td>
                                            {{ $admin['email'] }}
                                        </td>
                                        <td>
                                            <img src="{{ asset('template/images/Photo/'.$admin['image']) }}" alt="">
                                        </td>
                                        <td>
                                            @if($admin['status']==1)
                                            <i style="font-size:30px;" class="mdi mdi-bookmark-check"></i>
                                            @else
                                            <i style="font-size:30px;" class="mdi mdi-bookmark-online"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if($admin['type']=="penyedia")
                                            <a href="{{ url('admin/view_penyedia_details/'.$admin['id']) }}">
                                                <i style="font-size:30px;" class="mdi mdi-file-document"></i>
                                            </a>
                                            @endif
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