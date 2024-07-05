<style>
        .evo-product-item {
            margin: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            width: 200px; /* Adjust the width as needed */
        }
        .product {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: red;
            color: white;
            padding: 5px;
            border-radius: 3px;
        }
        .thumb-evo img {
            width: 100%;
            height: auto;
        }
        .carousel-inner .carousel-item {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .carousel-inner .carousel-item .col-md-4 {
            flex: 1 0 21%; /* Adjust the flex basis to control the number of items per slide */
            max-width: 21%; /* Adjust the max-width to control the number of items per slide */
        }
    </style>
<div>
    <div>
        <section class="sanpham">
            <div class="container">
                <div>
                    <h3 class="text-center my-3 ten">
                        <span>Sản phẩm đang có khuyến mãi</span>
                    </h3>
                </div>
                <div class="row carousel slide text-center" id="carouselExampleControls" data-bs-ride="carousel">

                    @foreach ($productSale as $productDetail)
                        <div class="swiper-slide">

                            <div class="evo-product-item">
                                <div class="thumb-evo">
                                    @if ($productDetail['product']->sale && $productDetail['product']->sale->price_sale < $productDetail['product']->price)
                                        @php
                                            $originalPrice = $productDetail['product']->price; // Giá gốc
                                            $salePrice = $productDetail['product']->sale->price_sale; // Giá giảm
                                            // Kiểm tra để tránh chia cho 0
                                            if ($originalPrice > 0) {
                                                $discountPercentage =
                                                    (($originalPrice - $salePrice) / $originalPrice) * 100;
                                                $discountPercentage = round($discountPercentage, 0); // không làm tròn
                                                echo "<strong class='product' style='color:rgb(255, 255, 255)'>$discountPercentage%</strong>";
                                            } else {
                                                echo "<strong class='product'></strong>";
                                            }
                                        @endphp
                                    @endif

                                    <a href="{{ url($productDetail['product']->slug) }}"
                                        title="{{ $productDetail['product']->name }}">
                                        <img class="lazy"
                                            src="{{ asset('images/product/' . $productDetail['image']) }}"
                                            alt="{{ $productDetail['product']->name }}" /> </a>
                                </div>


                                <div class="col-12">
                                    <a style="text-decoration: none; color:black"
                                        href="{{ url($productDetail['product']->slug) }}"
                                        title="{{ $productDetail['product']->name }}" class="title ten">
                                        <span class="ten">{{ $productDetail['product']->name }}</span>
                                    </a>
                                </div>
                                <div class="flex-prices">
                                    <div class="block-prices">
                                        <strong
                                            class="product-price">{{ number_format($productDetail['price_sale']) }}₫</strong>
                                        <span class="product-old-price "
                                            style="text-decoration: line-through;">{{ number_format($productDetail['product']->price) }}₫</span>
                                    </div>
                                </div>

                            </div>
                    @endforeach
                </div>
            </div>

        </section>
    </div>
</div>
