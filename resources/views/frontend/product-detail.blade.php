@extends('layouts.site')
@section('title', $product->name)
@section('content')
<x-main-menu />
<section>
    <div class="container">
        <div>
            <a class="H21" style="text-decoration: none; color:black" href="{{ route('slug.index', ['slug' => $product->category->slug]) }}">
                <h2 class="text-center my-3 ten">{{ $product->category->name }}</h2></a>
            
        </div>
        <div class="row my-5">
            <div class="col-md-5 col-12">
                @if (count($product->images) > 0)
                    <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($product->images as $index => $product_image)
                                <div class="carousel-item{{ $index === 0 ? ' active' : '' }}">
                                    <a href="{{ route('slug.index', ['slug' => $product->slug]) }}">
                                        <img src="{{ asset('images/product/' . $product_image->image) }}"
                                            class="img-fluid" alt="{{ $product_image->image }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#product-carousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#product-carousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                    <!-- Hiển thị hình ảnh mặc định nếu không có ảnh -->
                    <a href="{{ route('slug.index', ['slug' => $product->slug]) }}">
                        <img src="{{ asset('path/to/default/image.jpg') }}" class="img-fluid"
                            alt="Default Image">
                    </a>
                @endif
            </div>
            <div class="col-md-4 col-12">
                <h3>{{ $product->name }}</h3>
                <ul>
                    <li>Tình trạng : <span>còn trong kho</span></li>
                </ul>
                <h3>
                    @if ($product->sale && $product->sale->price_sale < $product->price)
                        <span class="special-price">
                            <span class="price product-price">Giá khuyến mãi {{$product->sale->price_sale}}₫</span><br>
                        </span> <!-- Giá Khuyến mại -->
                        <span class="old-price">
                            <span class="price product-price-old">Giá thị trường: <span style="text-decoration: line-through;">{{$product->price}}₫</span></span><br>
                        </span> <!-- Giá gốc -->
                        <span class="save-price">
                            <span class="price product-price-save">Tiết kiệm: {{$product->price - $product->sale->price_sale}}₫</span>
                        </span> <!-- Tiết kiệm -->
                    @else
                        <span class="special-price">
                            <span class="price product-price">{{$product->price}}₫</span>
                        </span> <!-- Giá Khuyến mại -->
                    @endif
                </h3>
                <h4>Thông số sản phẩm :</h4>
                <ul>
                    
                    <li>
                        <div class="row">
                            <div class="col-4">
                                <b>Xuất xứ</b>
                            </div>
                            <div class="col">
                                <span>{{ $product->brand->name }}</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-4">
                                <b>Chi tiết</b>
                            </div>
                            <div class="col">
                                <span>{{ $product->detail }}</span>
                                
                            </div>
                        </div>
                    </li>
                    
                </ul>
            </div>
            <div class="col-md-3 col-12">
                <h4><b>Sản phẩm liên quan :</b></h4>
                <div class="row">
                    <div class="goiy">
                        <div class="col">
                            <div class="row mt-3">
                                <div class="col-3">
                                    <a href="trong1.html"><img src="images/image1.jpg" class="sizegoiy" alt=""></a>
                                </div>
                                <div class="col text-center">
                                    <span>TRỐNG CƠ STAGG TIM122BBK</span>
                                    <p>8,500,000đ</p> 
                                </div>
                            </div>
                        </div>
                            <hr>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    #product-carousel .carousel-control-prev,
    #product-carousel .carousel-control-next {
        color: #000; /* Đổi màu chữ thành màu đen */
    }

    #product-carousel .carousel-control-prev:hover,
    #product-carousel .carousel-control-next:hover {
        color: #fff; /* Đổi màu chữ khi di chuột qua thành màu trắng */
        background-color: #000; /* Đổi màu nền khi di chuột qua thành màu đen */
    }
    /* Thêm mã CSS tùy chỉnh vào tệp CSS của bạn hoặc trực tiếp trong thẻ <style> */
    #product-carousel .carousel-item img {
        height: 300px; /* Đặt chiều cao mong muốn cho hình ảnh */
        object-fit: cover; /* Đảm bảo hình ảnh không bị biến đổi tỷ lệ */
    }

</style>

@endsection