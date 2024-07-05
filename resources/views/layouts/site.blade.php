<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layer.css') }}">
    @yield('header')
    <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">

    <!-- jQuery -->
    <script src="js/jquery-2.0.0.min.js" type="text/javascript"></script>

    <!-- Bootstrap4 files-->
    <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- Font awesome 5 -->
    <link href="fonts/fontawesome/css/all.min.css" type="text/css" rel="stylesheet">

    <!-- custom style -->
    <link href="css/ui.css" rel="stylesheet" type="text/css" />
    <link href="css/responsive.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <section class="header-main border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-3 col-md-12">
                    <a href="http://bootstrap-ecommerce.com" class="brand-wrap">
                        <img class="logo" src="images/logo.png">
                    </a> <!-- brand-wrap.// -->
                </div>
                <div class="col-xl-6 col-lg-5 col-md-6">
                    <form action="#" class="search-header">
                        <div class="input-group w-100">
                            <select class="custom-select border-right" name="category_name">
                                <option value="">All type</option>
                                <option value="codex">Special</option>
                                <option value="comments">Only best</option>
                                <option value="content">Latest</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Search">

                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form> <!-- search-wrap .end// -->
                </div> <!-- col.// -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="widgets-wrap float-md-right">
                        <div class="widget-header mr-3">
                            <a href="#" class="widget-view">
                                <div class="icon-area">
                                    <i class="fa fa-user"></i>
                                    <span class="notify">3</span>
                                </div>
                                <small class="text"> My profile </small>
                            </a>
                        </div>
                        <div class="widget-header mr-3">
                            <a href="#" class="widget-view">
                                <div class="icon-area">
                                    <i class="fa fa-comment-dots"></i>
                                    <span class="notify">1</span>
                                </div>
                                <small class="text"> Message </small>
                            </a>
                        </div>
                        <div class="widget-header mr-3">
                            <a href="#" class="widget-view">
                                <div class="icon-area">
                                    <i class="fa fa-store"></i>
                                </div>
                                <small class="text"> Orders </small>
                            </a>
                        </div>
                        <div class="widget-header">
                            <a href="#" class="widget-view">
                                <div class="icon-area">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <small class="text"> Cart </small>
                            </a>
                        </div>
                    </div> <!-- widgets-wrap.// -->
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- container.// -->
    </section>
    @yield('content')
    <!----sanpham--------------------------------------------------------------------------------->

    <!------------------------------------------------------------------->
    <div>
        <section class="tr-copyright bg-dark">
            <div class="day bg-warning"></div>
            <div>
                <div class="container mt-2">
                    <div class="row">
                        <div class="col">
                            <img src="images/logo.png" alt="LOGO" class="m-1 logo1 ms-0">
                            <p class="text-white-50">Vmusical chuyên kinh doanh sản phẩm âm nhạc thời thượng đẳng cấp.
                                Với
                                tiêu chi CHẤT LƯỢNG cho từng khách hàng, chúng tôi đang nỗ lực để ngày một hoàn
                                thiện,cảm ơn
                                quý khách hàng đã luôn đồng hành hỗ trợ.</p>
                        </div>
                        <div class="col">
                            <p></p>
                            <h3 class="text-white-50 lienhe">Liên hệ</h3>
                            <p class="text-white-50">
                                A12, Đinh Tiên Hoàng, Q. Hoàn Kiếm, Hà Nội <br>
                                Điện thoại: <span class="sdt">0123456789 </span><br>
                                Website: <a href="https://vmusical.exdomain.net/"
                                    class="link">https://vmusical.exdomain.net/</a> <br>
                                Email: <a href="contact@yourdomain.com" class="mail">contact@yourdomain.com</a>
                            </p>
                        </div>
                        <div class="col">
                            <ul>
                                <p></p>
                                <h3 class="text-white-50">Thông tin</h3>
                                <li class="text-white-50 ms-3">Về chúng tôi</li>
                                <li class="text-white-50 ms-3">Chính sách bảo mật</li>
                                <li class="text-white-50 ms-3">Quy định sử dụng</li>
                                <li class="text-white-50 ms-3">Thông tin giao hàng</li>
                                <li class="text-white-50 ms-3">Liên hệ</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--- tr-copyright-->
    @yield('footer')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
