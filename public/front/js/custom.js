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
                    $(".getAttributeharga").html("<div class='price'><h4>Rp."+resp['final_harga']+"</h4></div><div class='original-price'><span>Rp."+resp['harga']+"</span></div>");
                } else {
                    $(".getAttributeharga").html("<div class='price'><h4>Rp."+resp['final_harga']+"</h4></div>");
                } 
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
