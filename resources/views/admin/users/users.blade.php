@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Users</h4>
                        @if(Session::has('succses_message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Succses: </strong> {{ Session::get('succses_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="penyewas" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Kecamatam</th>
                                        <th>Kota</th>
                                        <th>Provinsi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    @foreach ($users as $u)
                                    <tr>
                                        <td>
                                            {{ $no }}
                                        </td>
                                        <td>
                                            {{ $u['name'] }}
                                        </td>
                                        <td>{{ $u['email'] }}</td>
                                        <td>{{ $u['alamat'] }}</td>
                                        <td>{{ $u['kecamatan'] }}</td>
                                        <td>{{ $u['kota'] }}</td>
                                        <td>{{ $u['provinsi'] }}</td>
                                        <td>
                                            @if($u['status']==1)
                                            <a title="Status aktif" class="updatePenyewaStatus"
                                                id="penyewa-{{ $u['id'] }}" penyewa_id="{{ $u['id'] }}"
                                                href="javascript:void(0)">
                                                <i style="font-size:30px;" class="mdi mdi-bookmark-check"
                                                    status="Active"></i>
                                            </a>
                                            @else
                                            <a title="Status nonaktif" class="updatePenyewaStatus"
                                                id="penyewa-{{ $u['id'] }}" penyewa_id="{{ $u['id'] }}"
                                                href="javascript:void(0)">
                                                <i style="font-size:30px;" class="mdi mdi-bookmark-outline"
                                                    status="Inactive"></i>
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