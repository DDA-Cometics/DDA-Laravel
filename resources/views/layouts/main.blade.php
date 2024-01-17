<!doctype html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('css')
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/navbar.js') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Monomaniac+One&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap">
    @yield('libary')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        #headAboutUs {
            color: #000;
            text-align: center;
            font-family: Noto Serif;
            font-size: 32px;
            font-style: normal;
            font-weight: 700;
            line-height: 98.7%;
            text-transform: capitalize;
        }
        #bodyAboutUs {
            color: #000;
            text-align: center;
            font-family: Noto Serif;
            font-size: 28px;
            font-style: normal;
            font-weight: 400;
            line-height: 98.7%;
            letter-spacing: 2.24px;
        }
    </style>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var profileNavbar = document.getElementById('ProfileNavbar');
            profileNavbar.addEventListener('click', function() {
                this.classList.toggle('showText');
            });
            profileNavbar.addEventListener('click', function() {
                this.classList.toggle('logout');
            });
        });
    </script>
    <?php
        function ButtonNavbar($text, $link, $width)
        {
            echo '
                <a href="' . $link . '">
                <button class="custom-button" id="ButtonNavbar" style="width: ' . $width . 'px;">
                    <b> <span id="text1">' . $text . '</span> </b>
                    </button>
                </a>';
        }
        function SearchNavbar()
        {
            return '
            <form class="form-inline" id="SearchNavbar">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Tìm kiếm">
                <i id="iconSearch" class="fa-solid fa-magnifying-glass"></i>
            </form>
        ';
        }
        function CartNavbar()
        {
            echo '
            <form class="form-inline" id="CartNavbar">
                <a href="cart" id="cartLink">
                    <i class="fa-solid fa-cart-shopping" id="cartIcon"></i>
                    <label id="iconCart" style="">
                        My Bag
                    </label>
                </a>
            </form>
        ';
        }
        function ProfileNavbar()
        {
            return '
            <form class="form-inline" id="ProfileNavbar">
                <i class="fa-solid fa-user" id="profileIcon">
                </i>
                <i id="triangleIcon" class="fa-solid fa-caret-down"></i>
                <a href="/profile" id="iconProfile" class="iconText">Profile</a>
                <a href="/logout" id="textBelowIcon" class="iconText">Logout</a>    
            </form>
        ';
        }
        function ProfileNavbarLogin()
        {
            return '
            <form class="form-inline" id="ProfileNavbar">
                <a href="login"> <i id="iconSignin" class="fa-solid fa-right-to-bracket"></i></a>
                <a href="login" id="textBelowIcon" class="iconText2">LOG IN</a>    
            </form>
            ';
        }
    ?>
{{-- Navbar --}}
    <div id="main-container" class="container-fluid">
        <div class="row">
            <div class="col">
                <nav class="navbar p-0">
                    <span id="brand" class="h1">
                        <b>DDA-Comectic</b>
                    </span>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-7">
                <?php echo ButtonNavbar("H O M E", "/", 90) ?>
                <?php echo ButtonNavbar("BEST SELLERS", "best-seller", 120) ?>
                <?php echo ButtonNavbar("NEW", "new-products", 120) ?>
                <?php echo ButtonNavbar("HISTORY", "history", 120) ?>
            </div>
            <div class="col-5 ">
                <div class="row">
                    <div class="col-5">
                        <form action="/search" method="get" class="form-inline" id="SearchNavbar">
                            <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Tìm kiếm">
                            <i id="iconSearch" class="fa-solid fa-magnifying-glass"></i>
                            <button type="submit" class="d-none"></button>
                        </form>
                    </div>
                    <div class="col-3">
                        <?php echo CartNavbar() ?>
                    </div>
                    @if(session()->has('user_data'))
                        <div class="col-4">
                            <?php echo ProfileNavbar() ?>
                        </div>
                    @else
                        <div class="col-4">
                            <?php echo ProfileNavbarLogin() ?>
                        </div>
                    @endif
                </div>
            </div>
        </div><br>
    </div>
{{-- Yield Body --}}
    <div class="container-fluid">
        @yield('content')
    </div>
{{-- About US --}}
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 id="headAboutUs">
                    DDA-comestic Since 1851: Skincare for All Skin Types. 100% Paraben-Free.
                </h2>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col">
                <p id="bodyAboutUs">The website for DDA-Comestic, created by Phạm Thị Lan Anh, Huỳnh Đức, and Đinh Thị Hồng Duyên in English, allows customers to browse and purchase skincare products from DDA-Comestic. The website features new, paraben-free skincare products developed with innovative technology and contains many new ingredients. The company has also implemented sustainable practices during production and contributes to environmental sustainability. In addition to product information, the website helps customers choose the right product for their needs. However, non-English speaking customers may encounter difficulties during the purchasing process.</p>
            </div>
        </div>
    </div>
{{-- footer --}}
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="c1">
                        <h4 id="headF">HOME</h4>
                        <p><a id="content1" href="#">Log in/Logout</a></p>
                        <p><a id="content1" href="#">Best sellers</a></p>
                        <p><a id="content1" href="#">New products</a></p>
                        <p><a id="content1" href="#">Gifts & Sets</a></p>
                    </div>
                </div>
                <div class="col">
                    <div class="c2">
                        <h4 id="headF">About Us</h4>
                        <p id="content2" class="text-left">The website for DDA-Comestic, created by Phạm Thị Lan Anh, Huỳnh
                            Đức, and Đinh Thị Hồng Duyên allows customers to browse and purchase skincare products from
                            DDA-Comestic.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="c3">
                        <h4 id="headF">ACCOUNT</h4>
                        <p id="content2" class="text-left">DINH THI HONG DUYEN</p>
                        <p id="content2" class="text-left">BANK: Vietcombank</p>
                        <p id="content2" class="text-left">Card number: 10163208773</p>
                    </div>
                </div>
                <div class="col">
                    <div class="c4">
                        <h4 id="headF">CONTACT</h4>
                        <div class="text-left">
                            <a href=""><i id="content3" class="fa-solid fa-phone"></i> <label id="icontent">0858776464</label></a><br>
                            <a href=""><i id="content3" class="fa-solid fa-envelope"></i> <label id="icontent">dda@gmail.com</label></a><br>
                            <a href=""><i id="content3" class="fa-solid fa-location"></i> <label id="icontent">99-Tô Hiến
                                    Thành</label></a><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col d-flex justify-content-center">
                    <div>
                        <div id="follow" class="d-flex justify-content-center">
                            <h4>Follow us</h4>
                        </div>
                        <div id="icon" class="d-flex justify-content-center">
                            <a href="https://www.facebook.com"><i id="icon" class="fa-brands fa-facebook"></i></a>
                            <a href="https://www.twitter.com"><i id="icon" class="fa-brands fa-twitter"></i></a>
                            <a href="https://www.instagram.com"><i id="icon" class="fa-brands fa-square-instagram"></i></a>
                            <a href="https://www.youtube.com"><i id="icon" class="fa-brands fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <div class="row">
                <div class="col text-center text-light">
                    <strong><i class="fas fa-check-circle icon-circle mr-5"></i></strong><span>2023|</span> Phạm Thị Lan Anh - Huỳnh Đức - Đinh Thị Hồng Duyên
                </div>
            </div>
        </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    @yield('Javascript')
</body>
</html>