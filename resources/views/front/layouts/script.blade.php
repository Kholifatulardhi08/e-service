<?php 
use App\Models\ProductFilter;
$productfilter = ProductFilter::productFilters();
?>
<script>
    $(document).ready(function () {
        $("#sort").on('change', function () {
            // this.form.submit();
            var sort = $("#sort").val();
            var url = $("#url").val();
            var price = get_filter('price');
            var paket = get_filter('paket');
            @foreach ($productfilter as $filters)
            var {{ $filters['filter_column'] }} = get_filter('{{ $filters['filter_column'] }}');
            @endforeach
            // alert(url); return false;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: 'POST',
                data: {
                    sort: sort,
                    url: url,
                    price: price,
                    paket: paket,
                    @foreach ($productfilter as $filters)
                    {{ $filters['filter_column'] }}:{{ $filters['filter_column'] }},
                    @endforeach
                },
                success: function (data) {
                    $('.filter-product').html(data);
                },
                error: function () {
                    alert("Error");
                }
            })
        });

        $(".paket").on('change', function () {
            // this.form.submit();
            var price = get_filter('price');
            var paket = get_filter('paket');
            var sort = $("#sort").val();
            var url = $("#url").val();
            @foreach ($productfilter as $filters)
            var {{ $filters['filter_column'] }} = get_filter('{{ $filters['filter_column'] }}');
            @endforeach
            // alert(url); return false;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: 'POST',
                data: {
                    @foreach ($productfilter as $filters)
                    {{ $filters['filter_column'] }}:{{ $filters['filter_column'] }},
                    @endforeach
                    sort: sort,
                    url: url,
                    paket: paket,
                    price: price,
                },
                success: function (data) {
                    $('.filter-product').html(data);
                },
                error: function () {
                    alert("Error");
                }
            })
        });

        $(".price").on('change', function () {
            // this.form.submit();
            var price = get_filter('price');
            var paket = get_filter('paket');
            var sort = $("#sort").val();
            var url = $("#url").val();
            @foreach ($productfilter as $filters)
            var {{ $filters['filter_column'] }} = get_filter('{{ $filters['filter_column'] }}');
            @endforeach
            // alert(url); return false;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: 'POST',
                data: {
                    @foreach ($productfilter as $filters)
                    {{ $filters['filter_column'] }}:{{ $filters['filter_column'] }},
                    @endforeach
                    sort: sort,
                    url: url,
                    price: price,
                    paket: paket,
                },
                success: function (data) {
                    $('.filter-product').html(data);
                },
                error: function () {
                    alert("Error");
                }
            })
        });

        {{--  dynamic filter  --}}
        @foreach ($productfilter as $filter)
        $('.{{ $filter['filter_column'] }}').on('click', function () {
            var sort = $("#sort option:selected").text();
            var url = $("#url").val();
            @foreach ($productfilter as $filters)
            var {{ $filters['filter_column'] }} = get_filter('{{ $filters['filter_column'] }}');
            @endforeach
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "POST",
                data: {
                    @foreach ($productfilter as $filters)
                    {{ $filters['filter_column'] }}:{{ $filters['filter_column'] }},
                    @endforeach
                    url: url,
                    sort: sort,
                },
                success: function (data) {
                    $('.filter-product').html(data);
                },
                error: function () {
                    alert("Error");
                }
            });
        });
        @endforeach
    }); 
</script>