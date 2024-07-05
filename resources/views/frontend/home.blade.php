@extends('layouts.site')
@section('title', 'Trang chủ')
@section('content')


    <x-main-menu />
    <x-slider-show />
    <x-product-sale />
    
    @foreach ($list_category as $row_category)
        <x-product-home :rowcat="$row_category" />
    @endforeach

    
    

    <!--- tr-footer-->
    <br>
    <section class="giaohang">
        <div class="container">
            <div class="row text-center">
                <div class="col text-center">
                    <div>
                        <img src="images/truck.svg" alt="" class="car">
                    </div>
                    <div>
                        <h4 class="my-0 float-start px-2">GIAO HÀNG 24H</h4>
                        <p class="my-0 float-start px-2">Với đơn hàng trên 500.000 đ</p>
                    </div>
                </div>
                <div class="col text-center">
                    <div>
                        <img src="images/truck.svg" alt="" class="car">
                    </div>
                    <div>
                        <h4 class="my-0 float-start px-2">CHẤT LƯỢNG</h4>
                        <p class="my-0 float-start px-2">Bảo đảm chất lượng</p>
                    </div>
                </div>
                <div class="col text-center">
                    <div>
                        <img src="images/truck.svg" alt="" class="car">
                    </div>
                    <div>
                        <h4 class="my-0 float-start px-2">NGUỒN GỐC</h4>
                        <p class="my-0 float-start px-2">Nhập khẩu chính hãng</p>
                    </div>
                </div>
                <div class="col text-center">
                    <div>
                        <img src="images/truck.svg" alt="" class="car ">
                    </div>
                    <div>
                        <h4 class="my-0 float-start px-2">BẢO HÀNH</h4>
                        <p class="my-0 float-start px-2">Hiệu quả - Chất lượng</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
