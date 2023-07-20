$(document).ready(function () {
    $("#sort").on('change', function () {
        // this.form.submit();
        var sort = $("#sort").val();
        var url = $("#url").val();
        // alert(url); return false;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: 'POST',
            data: {
                sort: sort,
                url: url
            },
            success: function (data) {
                $('.filter-product').html(data);
            },
            error: function () {
                alert("Error");
            }
        })
    });
});

$('.EO').on('click', function () {
    var sort = $("#sort option:selected").text();
    var url = $("#url").val();
    var EO = get_filter('EO');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        method: "POST",
        data: {
            url: url,
            sort: sort,
            EO: EO
        },
        success: function (data) {
            $('.filter-product').html(data);
        },
        error: function () {
            alert("Error");
        }
    });
});

function get_filter(class_name) {
    var filter = [];
    $('.' + class_name + ':checked').each(function () {
        filter.push($(this).val());
    });
    return filter;
}
