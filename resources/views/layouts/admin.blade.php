<!doctype html>
<html lang="en">
  <head>
    <title>@yield('title')</title> 
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('css')
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/navbar.js') }}">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Monomaniac+One&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap">  
    @yield('libary')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
      #headAboutUs {
      color: #000;
      text-align: center;
      font-family: Noto Serif;
      font-size: 32px;
      font-style: normal;
      font-weight: 700;
      line-height: 98.7%; /* 31.584px */
      text-transform: capitalize;
      }
      #bodyAboutUs{
          color: #000;
          text-align: center;
          font-family: Noto Serif;
          font-size: 28px;
          font-style: normal;
          font-weight: 400;
          line-height: 98.7%; /* 27.636px */
          letter-spacing: 2.24px;
      }
  </style>
  </head>
  <body>     
  <?php
    function ButtonNavbar($text, $link,$width) {
        echo '
            <a href="' . $link . '">
            <button class="custom-button" id="ButtonNavbar" style="width: ' . $width . 'px;">
                  <b> <span id="text1">'. $text .'</span> </b>
                </button>
            </a>';
    }
    function SearchNavbar() {
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
              <a href="?news" id="cartLink">
                <i class="fa-solid fa-bell ml-5" id="cartIcon"></i>
              </a>
              <span style="position: absolute; width:10px; height:10px; border-radius:50%; right:54px;top:1px; background-color:red;" > </span>
          </form>
      ';
    }
    function ProfileNavbar()
      {
          return '
          <form class="form-inline " id="ProfileNavbar">
              <i class="fa-solid fa-user" id="profileIcon">
              </i>
              <i id="triangleIcon" class="fa-solid fa-caret-down"></i>
              <a href="/profile" id="iconProfile" class="iconText">PROFILE</a>
              <a href="/logout" id="textBelowIcon" class="iconText">LOGOUT</a>
              
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
 <script>
    document.addEventListener('DOMContentLoaded', function () {
        var profileNavbar = document.getElementById('ProfileNavbar');

        profileNavbar.addEventListener('click', function () {
            // Chuyển đổi lớp 'showText' khi click vào icon
            this.classList.toggle('showText');
        });
        profileNavbar.addEventListener('click', function () {
            // Chuyển đổi lớp 'logout' khi click vào icon
            this.classList.toggle('logout');
        });
    });
</script>
    {{-- navbar --}}
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
              <?php echo ButtonNavbar("USER MANAGEMENT", "/user-management", 142) ?>
              <?php echo ButtonNavbar("PRODUCT MANAGEMENT", "/product-management", 160) ?>
              <?php echo ButtonNavbar("VOUCHERS MANAGEMENT", "/voucher-management", 152) ?>
              <?php echo ButtonNavbar("SHOW CHART", "/statistics", 100) ?>
          </div>
          <div class="col-5 ">
              <div class="row">
                  <div class="col-5">
                      <?php echo SearchNavbar() ?>
                  </div>
                  <div class="col-3">
                      <?php echo CartNavbar() ?>
                  </div>
                  <!-- Check Login để quyết định hiển thị -->
                  <div class="col-4">
                      <?php echo ProfileNavbar() ?>                      
                  </div> 
                  <!--<div class="col-4">
                      <?php echo ProfileNavbarLogin() ?>
                       
                  </div> -->
                  <!-- ..................... -->
              </div>
          </div>
      </div><br>
  </div>

  {{-- Phần Yield Body --}}
    <div class="container-fluid">
        @yield('content')
    </div>
  {{-- .......................... --}}

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    @yield('Javascript')
  </body>
</html>
  