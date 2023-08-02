$(document).ready(function () {
    $("#getPaket").change(function () {
        var paket = $(this).val();
        var product_id = $(this).attr("product-id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/get-product-harga',
            data: {
                paket: paket,
                product_id: product_id
            },
            type: 'POST',
            success: function (resp) {
                // alert(resp['final_harga']);
                if (resp['diskon'] > 0) {
                    $(".getAttributeharga").html("<div class='price'><h4>Rp." + resp['final_harga'] + "</h4></div><div class='original-price'><span>Rp." + resp['harga'] + "</span></div>");
                } else {
                    $(".getAttributeharga").html("<div class='price'><h4>Rp." + resp['final_harga'] + "</h4></div>");
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });

    $(document).on('click', '.updateCartItem', function () {
        if ($(this).hasClass('plus-a')) {
            var quantity = $(this).data('qty');
            new_qty = parseInt(quantity) + 1;
        }
        if ($(this).hasClass('minus-a')) {
            var quantity = $(this).data('qty');
            if (quantity <= 1) {
                alert("Item quantity must be 1 or greater!");
                return false;
            }
            new_qty = parseInt(quantity) - 1;
        }
        var cartid = $(this).data('cartid');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                cartid: cartid,
                qty: new_qty
            },
            url: '/update-cart',
            type: 'POST',
            success: function (resp) {
                $(".totalCartItem").html(resp.totalCartItem);
                $("#appendCartItem").html(resp.cartmini);
                if (resp.status == false) {
                    alert(resp.message);
                }
                $('.appendCartHarga').html(resp.view);
            },
            error: function () {
                alert("Error");
            }
        });
    });

    $(document).on('click', '.deleteCartItem', function () {
        var result = confirm("are you sure to delete this cart item?");
        var cartid = $(this).data('cartid');
        // alert(cartid);
        if (result) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    cartid: cartid
                },
                url: '/delete-cart',
                type: 'POST',
                success: function (resp) {
                    $(".totalCartItem").html(resp.totalCartItem);
                    $('.appendCartHarga').html(resp.view);
                },
                error: function () {
                    alert("Error");
                }
            });
        }
    });

    $("#registerForm").submit(function () {
        // event.preventDefault(); // Prevent the default form submission
        var formdata = $(this).serialize();
        $.ajax({
            url: '/penyewa/register',
            type: 'POST',
            data: formdata,
            success: function (resp) {
                if (resp.type == 'error') {
                    // Handle validation errors
                    $.each(resp.errors, function (i, error) {
                        $("#register-" + i).attr('style', 'color:red');
                        $("#register-" + i).html(error);
                        setTimeout(function () {
                            $("#register-" + i).css({
                                'display': 'none'
                            });
                        }, 2000);
                    });
                } else if (resp.type == 'success') {
                    // Redirect to the success URL
                    alert(resp.message);
                    // window.location.href = resp.url;
                }
            },
            error: function () {
                alert("Error occurred during registration. Please try again later.");
            }
        });
    });

    $("#loginForm").submit(function (event) {
        // event.preventDefault(); // Prevent the default form submission
        var formdata = $(this).serialize();
        $.ajax({
            url: '/penyewa/login',
            type: 'POST',
            data: formdata,
            success: function (resp) {
                if (resp.type == 'error') {
                    // Handle validation errors
                    $.each(resp.errors, function (i, error) {
                        $("#login-" + i).attr('style', 'color:red');
                        $("#login-" + i).html(error);
                        setTimeout(function () {
                            $("#login-" + i).css({
                                'display': 'none'
                            });
                        }, 2000);
                    });
                } else if (resp.type == 'incorrect') {
                    // alert(resp.message);
                    $("#login-error").attr('style', 'color:red');
                    $("#login-error").html(resp.message);
                    setTimeout(function () {
                        $("#login-error-").css({
                            'display': 'none'
                        });
                    }, 2000);
                } else if (resp.type == 'inactive') {
                    // alert(resp.message);
                    $("#login-error").attr('style', 'color:red');
                    $("#login-error").html(resp.message);
                    setTimeout(function () {
                        $("#login-error-").css({
                            'display': 'none'
                        });
                    }, 2000);
                } else {
                    // Redirect to the success URL
                    window.location.href = resp.url;
                }
            },
            error: function () {
                alert("Error occurred during registration. Please try again later.");
            }
        });
    });

    $("#forgotForm").submit(function () {
        var formdata = $(this).serialize();
        $.ajax({
            url: 'lupa-password',
            type: 'POST',
            data: formdata,
            success: function (resp) {
                if (resp.type == 'error') {
                    // Handle validation errors
                    $.each(resp.errors, function (i, error) {
                        $("#forgot-" + i).attr('style', 'color:red');
                        $("#forgot-" + i).html(error);
                        setTimeout(function () {
                            $("#forgot-" + i).css({
                                'display': 'none'
                            });
                        }, 2000);
                    });
                } else if (resp.type == 'success') {
                    // Redirect to the success URL
                    alert(resp.message);
                    // window.location.href = resp.url;
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });

    $("#accountForm").submit(function () {
        var formdata = $(this).serialize();
        $.ajax({
            url: 'setting-account',
            type: 'POST',
            data: formdata,
            success: function (resp) {
                if (resp.type == 'error') {
                    // Handle validation errors
                    $.each(resp.errors, function (i, error) {
                        $("#account-" + i).attr('style', 'color:red');
                        $("#account-" + i).html(error);
                        setTimeout(function () {
                            $("#account-" + i).css({
                                'display': 'none'
                            });
                        }, 2000);
                    });
                } else if (resp.type == 'success') {
                    // Redirect to the success URL
                    alert(resp.message);
                    // window.location.href = resp.url;
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });

    $("#passwordForm").submit(function () {
        var formdata = $(this).serialize();
        $.ajax({
            url: 'update-password',
            type: 'POST',
            data: formdata,
            success: function (resp) {
                if (resp.type == 'error') {
                    // Handle validation errors
                    $.each(resp.errors, function (i, error) {
                        $("#password-" + i).attr('style', 'color:red');
                        $("#password-" + i).html(error);
                        setTimeout(function () {
                            $("#password-" + i).css({
                                'display': 'none'
                            });
                        }, 2000);
                    });
                } else if (resp.type == 'incorrect') {
                    // alert(resp.message);
                    $("#password-error").attr('style', 'color:red');
                    $("#password-error").html(resp.message);
                    setTimeout(function () {
                        $("#password-error").css({
                            'display': 'none'
                        });
                    }, 10000);
                } else if (resp.type == 'success') {
                    // Redirect to the success URL
                    alert(resp.message);
                    location.reload();
                    // window.location.href = resp.url;
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });

    $(document).on('click', '.editAddress', function () {
        var addressid = $(this).data('addressid');
        alert(addressid);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                addressid: addressid
            },
            url: '/get-delivery-address',
            type: 'POST',
            success: function (resp) {
                $("#showdifferent").removeClass("collapse");
                $(".newAddress").hide();
                $("#deliveryText").text("Edit Delivery Address");
                $('[name=delivery_id]').val(resp.delivery['id']);
                $('[name=delivery_nama]').val(resp.delivery['nama']);
                $('[name=delivery_no_hp]').val(resp.delivery['no_hp']);
                $('[name=delivery_alamat]').val(resp.delivery['alamat']);
                $('[name=delivery_kecamatan]').val(resp.delivery['kecamatan']);
                $('[name=delivery_kota]').val(resp.delivery['kota']);
                $('[name=delivery_provinsi]').val(resp.delivery['provinsi']);
                $('[name=delivery_kode_pos]').val(resp.delivery['kode_pos']);
            },
            else: function () {
                alert("Error");
            }
        });
    });

    $(document).on('click', '.removeAddress', function () {
        if (confirm("are you sure to delete this?")) {
            var addressid = $(this).data('addressid');
        }
        alert(addressid);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                addressid: addressid
            },
            url: '/delete-delivery-address',
            type: 'POST',
            success: function (data) {
                $("#deliveryAddress").html(data.view);
                window.location.href = "checkout";
            },
            else: function () {
                alert("Error");
            }
        });
    });

    $(document).on('submit', "#addressEditForm", function () {
        var formdata = $("#addressEditForm").serialize();
        $.ajax({
            url: '/save-delivery-address',
            type: 'POST',
            data: formdata,
            success: function (resp) {
                if (resp.type == 'error') {
                    // Handle validation errors
                    $.each(resp.errors, function (i, error) {
                        $("#delivery-" + i).attr('style', 'color:red');
                        $("#delivery-" + i).html(error);
                        setTimeout(function () {
                            $("#delivery-" + i).css({
                                'display': 'none'
                            });
                        }, 2000);
                    });
                } else {
                    $("#deliveryAddress").html(data.view);
                    window.location.href = "checkout";
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });
});

function get_filter(class_name) {
    var filter = [];
    $('.' + class_name + ':checked').each(function () {
        filter.push($(this).val());
    });
    return filter;
}
