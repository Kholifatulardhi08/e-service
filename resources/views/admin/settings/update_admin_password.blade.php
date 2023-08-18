@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            Settings Admin
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Password form</h4>
                        <form class="forms-sample" action="{{ url('admin/update_admin_password') }}" method="POST">
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
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{ $admin['email'] }}" readonly="" placeholder="Masukkan email anda"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text" class="form-control" id="type" name="type"
                                    value="{{ $admin['type'] }}" readonly="" placeholder="Masukkan type anda" required>
                            </div>
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" name="current_password" class="form-control"
                                    id="current_password" placeholder="Masukkan password anda yang lama" required="">
                                <span id="check_password"></span>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" class="form-control" id="new_password"
                                    placeholder="Masukkan pasword anda yang baru" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control"
                                    id="confirm_password" placeholder="Konfirmasi password" required>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $("#current_password").keyup(function() {
        var current_password = $("#current_password").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/check_current_password',
            data: { current_password: current_password },
            success: function(resp) {
                if (resp == "false") {
                    $("#check_password").html("<font color='red'> Current Password is Incorrect! </font>");
                } else if (resp == "true") {
                    $("#check_password").html("<font color='green'> Current Password is Correct! </font>");
                }
            },
            error: function() {
                alert('Error');
            }
        });
    });
});
</script>
@endsection