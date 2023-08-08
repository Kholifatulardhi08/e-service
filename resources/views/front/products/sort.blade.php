<?php
use App\Models\Product;
?>
<!-- Row-of-Product-Container -->
<div class="row product-container list-style">
    @if(!isset($_REQUEST['search']))
    @foreach($categoryproduct as $catpro)
    <div class="product-item col-lg-4 col-md-6 col-sm-6">
        <div class="item">
            <div class="image-container">
                <a class="item-img-wrapper-link" href="{{ url('product/'.$catpro['id']) }}">
                    <?php
                        $products_imgPath = 'template/images/Photo/Product/Small/'.$catpro['gambar']
                    ?>
                    @if(!empty($catpro['gambar']) && file_exists($products_imgPath))
                    <img class="img-fluid" src="{{ asset($products_imgPath) }}" alt="Product">
                    @else
                    <img class="img-fluid" src="{{ asset('template/images/Photo/Product/Small/no_image.jpg') }}"
                        alt="Product">
                    @endif
                </a>
            </div>
            <div class="item-content">
                <div class="what-product-is">
                    <ul class="bread-crumb">
                        <li class="has-separator">
                            <a href="#">{{ $catpro['meta_title'] }}</a>
                        </li>
                        <li>
                            <a href="">{{ $catpro['type'] }}</a>
                        </li>
                    </ul>
                    <h6 class="item-title">
                        <a href="{{ url('product/'.$catpro['id']) }}">{{ $catpro['nama'] }}</a>
                    </h6>
                    <div class="item-description">
                        <p>{{ $catpro['deskripsi'] }}</p>
                    </div>
                    <div class="item-stars">
                        <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                            <span style='width:67px'></span>
                        </div>
                        <span>(23)</span>
                    </div>
                </div>
                <div class="price-template">
                    <?php 
                        $getdiskon = Product::getdiskonharga($catpro['id'])
                    ?>
                    <div class="item-new-price">
                        Rp {{ $getdiskon }}
                    </div>
                    <div class="item-old-price">
                        {{ $catpro['harga'] }}
                    </div>
                </div>
            </div>
            <?php $isproductnew = Product::isproductnew($catpro['id']); ?>
            @if($isproductnew=="Yes")
            <div class="tag new">
                <span>NEW</span>
            </div>
            @endif
        </div>
    </div>
    @endforeach
    @endif
</div>
<!-- Row-of-Product-Container /- -->