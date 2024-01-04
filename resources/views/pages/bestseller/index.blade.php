@extends('layouts.main')
@section('title')
@section('css')
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/bestseller.css">
  <link rel="stylesheet" href="/assets/css/home.css">
@endsection
@section('content')
<?php
function favoritesProductCard($id, $name, $size, $price, $description, $category, $image)
{
    echo '
                <div class="card mr-3 mb-3">
                    <div class="circle-container">
                        <span>Bests Seller</span>
                    </div>
                    <img class="img"
                        src="' . $image . '"
                        alt="a">
                    <div class="title text-truncate">' . $name . '</div>
                    <div class="rating">
                        <input value="5" name="rate" id="star5" type="radio">
                        <label title="text" for="star5"></label>
                        <input value="4" name="rate" id="star4" type="radio">
                        <label title="text" for="star4"></label>
                        <input value="3" name="rate" id="star3" type="radio" checked="">
                        <label title="text" for="star3"></label>
                        <input value="2" name="rate" id="star2" type="radio">
                        <label title="text" for="star2"></label>
                        <input value="1" name="rate" id="star1" type="radio">
                        <label title="text" for="star1"></label>
                        <span class="ratingTotal">(' . 999 . ')</span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="oldPrice">
                                Price: $' . $price . '
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn mb-3" id="buynowBtn" onclick="redirectToDetail(' . $id . ')">Buy Now</button>
                        </div>
                    </div>
                </div>
            ';
}
  function generateDiscountHeader($text) {
          echo '
      <div class="container-fluid" id="borderHr">
          <div class="row d-flex text-center">
                  <div class="col ml-2"><hr id="hr"></div>         
                  <div class="col">
                      <h2 class="h2Title">' . $text . '</h2>
                  </div>
                  <div class="col mr-2"><hr id="hr"></div>
                </div>
      </div>
      ';
      }   
      function generateDiscountHeader2($text) {
          echo '
      <div class="container-fluid" id="borderHr">
          <div class="row d-flex text-center">
                  <div class="col ml-2"><hr id="hr"></div>
                  <div class="col-1">
                        <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1704266655/Web%20DDA%20COMECTIC/iconBestSeller_quuaqq.png" alt="icon">
                  </div>
                  <div class="col">
                      <h2>' . $text . '</h2>
                  </div>
                  <div class="col-1">
                    <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1704266655/Web%20DDA%20COMECTIC/iconBestSeller_quuaqq.png" alt="icon">
                  </div>
                  <div class="col mr-2"><hr id="hr"></div>
                </div>
      </div>
      ';
      }   
    function CardBestller($id,$name,$size,$price,$description,$category,$image,$discount) {
        echo '
                <div class="card" style="border:0px">
                    <div class="love-container">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <img class="img"
                        src="' . $image . '"
                        alt="a">
                    <div class="title text-truncate">' . $name . '</div>
                    <div class="rating">
                        <input value="5" name="rate" id="star5" type="radio">
                        <label title="text" for="star5"></label>
                        <input value="4" name="rate" id="star4" type="radio">
                        <label title="text" for="star4"></label>
                        <input value="3" name="rate" id="star3" type="radio" checked="">
                        <label title="text" for="star3"></label>
                        <input value="2" name="rate" id="star2" type="radio">
                        <label title="text" for="star2"></label>
                        <input value="1" name="rate" id="star1" type="radio">
                        <label title="text" for="star1"></label>
                        <span class="ratingTotal">(' . 999 . ')</span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="oldPrice">
                                $' . $price . '
                                <hr class="removePrice">
                            </div>
                        </div>
                        <div class="col"></div>
                        <div class="col ">
                            <span class="newPrice">$' . $price- ($price * ($discount/100)) . '</span>
                        </div>
                        
                    </div>
                    <div class="size_product">
                        <select name="product_size" id="product_size">
                            <option value="'.$size.'">'.$size .'ml</option>
                        </select>
                        <button class="user-label">Select the size</button>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn mb-3" id="buynowBtn" onclick="redirectToDetail(' . $id . ')">Buy Now</button>
                        </div>
                    </div>
                </div>
            ';
    }
    function discountBanner($n){
        echo '
            '.$n.'%
        ';
    }
    function ButtonBuyNow(){
    echo '<button class="btn mr-5" id="buynowBtn">Buy Now</button>';
    }
    function ButtonSignUp(){
        echo '<a href="register"><button id="buttonSignUp" type="button">REGISTER</button></a>';
    }
    function ButtonSignIn(){
        echo '<a href="login"><button id="buttonSignIn" type="button">SIGN IN</button></a>';
    }
  ?>
  <script>
        function redirectToDetail(productId) {
            window.location.href = '/detailproduct?id=' + productId;
        }
        document.addEventListener('DOMContentLoaded', function() {
        var profileNavbar = document.getElementById('ProfileNavbar');
   
        profileNavbar.addEventListener('click', function() {
            // Chuyển đổi lớp 'showText' khi click vào icon
            this.classList.toggle('showText');
        });
        profileNavbar.addEventListener('click', function() {
            // Chuyển đổi lớp 'logout' khi click vào icon
            this.classList.toggle('logout');
        });
    });
</script>
    <?php generateDiscountHeader2("SKINCARE TOP SELLER") ?>

    <div class="row mx-4">
        <div class="col-3 bg-light" id="formFillter">
            <form action="/fillter" method="get" id="formFillters">
                <center class="mt-5"> <b class="fillter mt-5" id="fillter">FILLTER BY</b></center>
                <select class="form-control mt-4 bg-light" id="selectFilter"  name="category">
                    <option value="" >CATEGORY</option>
                    @php
                        $uniqueCategories = $productt->unique('category');
                    @endphp
                    @foreach ($uniqueCategories as $product)
                        <option value="{{ $product->category }}">{{ $product->category }}</option>
                    @endforeach
                    <!-- Thêm các tùy chọn danh mục -->
                </select>
                
                <select class="form-control mt-4 bg-light" id="selectFilter"  name="skin_concerns">
                    <option value="" >SKIN CONCERNS</option>
                    <!-- Thêm các tùy chọn về Skin Concerns -->
                    @php
                        $uniqueSkinConcerns = $productt->unique('skin_concerns');
                    @endphp
                    @foreach ($uniqueSkinConcerns as $product)
                        <option value="{{ $product-> skin_concerns}}">{{ $product->skin_concerns }}</option>
                    @endforeach
                </select>
                
                <select class="form-control mt-4 bg-light" id="selectFilter" name="skin_type">
                    <option value="" >SKIN TYPE</option>
                    <!-- Thêm các tùy chọn về Skin Type -->
                    @php
                        $uniqueSkinType = $productt->unique('skin_type');
                    @endphp
                    @foreach ($uniqueSkinType as $product)
                        <option value="{{ $product-> skin_type}}">{{ $product->skin_type }}</option>
                    @endforeach
                </select>
                
                <select class="form-control mt-4 bg-light" id="selectFilter" name="ingredient">
                    <option value="" >INGREDIENT</option>
                    <!-- Thêm các tùy chọn về Ingredient -->
                    @php
                        $uniqueIngredient = $productt->unique('ingredient');
                    @endphp
                    @foreach ($uniqueIngredient as $product)
                        <option value="{{ $product-> ingredient}}">{{ $product->ingredient }}</option>
                    @endforeach
                </select>
                <center class=""> <button type="submit" class=" btn fillter mt-2" id="fillterSearch">SEARCH</button></center>
            </form>
        </div>
        <div class="col-9">
            <div class="row">
                
                @if(count($products) > 0)
    {{-- Hiển thị danh sách sản phẩm --}}
    <div class="row">
      @foreach ($products as $product)
        <div class="col ml-2 mt-4">
          @php 
            // Gọi hàm để hiển thị sản phẩm
            CardBestller(
              $product->id,
              $product->product_name,
              $product->size,
              $product->price,
              $product->description,
              $product->category,
              $product->image,
              50
            );
          @endphp
        </div>
        @if ($loop->iteration % 4 == 0)
          </div><div class="row">
        @endif
      @endforeach
    </div>
  @else
    <center class="col message">
        I apologize, but no matching products were found. 
    </center>
    <div class="row text-center " style="width:100vw">
        <div class="col-5"></div>
        <form action="/fillter" method="get">
            <center class=""> 
                <button type="submit" class=" btn fillter mt-2" id="fillterSearch">GET ALL</button>
            </center> 
        </form>
  </div>
  
  @endif
            </div>
        </div>        
    </div>
    <?php generateDiscountHeader("YOU MAY ALSO LIKE") ?>
    <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
    
          @php
              $totalItems = count($productt);
              $slides = ceil($totalItems / 4);
          @endphp
        
          @for ($i = 0; $i < $slides; $i++)
              <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                  <div class="card-wrapper container-sm d-flex justify-content-around">
    
    
                    @for ($j = $i * 4; $j < min(($i + 1) * 4, $totalItems); $j++) <div class="col-md-3">
                        @php
                        favoritesProductCard(
                        $productt[$j]->id,
                        $productt[$j]->product_name,
                        $productt[$j]->size,
                        $productt[$j]->price,
                        $productt[$j]->description,
                        $productt[$j]->category,
                        $productt[$j]->image,
                        ); @endphp
                </div>
                @endfor
    
        </div>
    </div>
    @endfor
    
    </div>
    
    <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    
    <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
    <?php generateDiscountHeader("ABOUT US") ?>
@endsection