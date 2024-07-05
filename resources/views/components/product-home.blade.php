<div>
    <section class="sanpham">
        <div class="container">
            <div>
                    <a class="H21" style="text-decoration: none; color:black" href="{{ route('slug.index', ['slug' => $row_cat->slug]) }}">
                        <h3 class="text-center my-3 ten">{{ $row_cat->name }}</h3></a>
            </div>
            <div class="row carousel slide text-center " id="carouselExampleControls" data-bs-ride="carousel">
                @foreach ($product_list as $product)
                    @php
                        $product_image = $product->images;
                        $image = null;
                        if (count($product_image) > 0) {
                            $image = $product_image[0]['image'];
                        }
                    @endphp

                    <div class="col mx-3">
                        <a href="{{ route('slug.index', ['slug' => $product->slug]) }}"><img
                                src="{{ asset('images/product/' . $image) }}" class="img-fluid "
                                alt="{{ $image }}"></a>
                        <div class="col-12">
                            <span class="ten">{{ $product->name }}</span>
                        </div>
                        <div class="col-12 gia">
                            <p> <strong>{{ $product->price }}đ</strong></p>
                        </div>
                        <form action="{{ route('site.addcart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                        </form>
                        
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    
</div>
