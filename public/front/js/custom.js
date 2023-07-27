$(document).ready(function(){
    $("#getPaket").change(function(){
        var paket = $(this).val();
        var product_id = $(this).attr("product-id");
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/get-product-harga',
            data: {paket:paket, product_id:product_id},
            type: 'POST',
            success:function(resp){
                // alert(resp['final_harga']);
                if (resp['diskon']>0) {
                    $(".getAttributeharga").html("<div class='price'><h4>Rp."+ resp['final_harga']+"</h4></div><div class='original-price'><span>Rp."+ resp['harga']+"</span></div>");
                } else {
                    $(".getAttributeharga").html("<div class='price'><h4>Rp."+resp['final_harga']+"</h4></div>");
                } 
            }, error:function(){
                alert("Error");
            }
        });
    });

    $(document).on('click', '.updateCartItem', function(){
        if($(this).hasClass('plus-a')){
            var quantity = $(this).data('qty');
            new_qty = parseInt(quantity) + 1;
        }
        if($(this).hasClass('minus-a')){
            var quantity = $(this).data('qty');
            if(quantity<=1){
                alert("Item quantity must be 1 or greater!");
                return false;
            }
            new_qty = parseInt(quantity) - 1;
        }
        var cartid = $(this).data('cartid');
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {cartid:cartid, qty:new_qty},
            url: '/update-cart',
            type: 'POST',
            success:function(resp){
                if(resp.status==false){
                    alert(resp.message);
                }
                $('.appendCartHarga').html(resp.view);
            }, error:function(){
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
