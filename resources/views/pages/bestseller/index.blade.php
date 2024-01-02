@extends('layouts.main')
@section('title')
@section('css')
  <link rel="stylesheet" href="/assets/css/home.css">
  <link rel="stylesheet" href="/assets/css/bestseller.css">
@endsection
@section('content')
<?php
  function generateDiscountHeader($text) {
          echo '
      <div class="container-fluid" id="borderHr">
          <div class="row d-flex text-center">
                  <div class="col ml-2"><hr id="hr"></div>
                  <div class="col">
                      <h2>' . $text . '</h2>
                  </div>
                  <div class="col mr-2"><hr id="hr"></div>
                </div>
      </div>
      ';
      }
      function generateProductCard($id,$name,$size,$price,$description,$category,$image,$discount) {
        echo '
                <div class="card mr-3 mb-3">
                    <div class="circle-container1">
                        <span>50 % OFF</span>
                    </div>
                    <img class="img"
                        src="' . $image . '"
                        alt="a">
                    <div class="title">' . $name . '</div>
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
                        <div class="col">
                        </div>
                    </div>
                    <div class="size_product">
                        <b>Size: </b>
                        <select name="product_size" id="product_size">
                            <option value="'. $size .'">'.$size .'ml</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn mb-3" id="buynowBtn" onclick="redirectToDetail(' . $id . ')">Buy Now</button>
                        </div>
                    </div>
                </div>
            ';
    } 
    
    
    function CardBestller($id,$name,$size,$price,$description,$category,$image,$discount) {
        echo '
                <div class="card mr-3 mb-3">
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
                        <label class="user-label">First Name</label>
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
   </script>

    <h2>Đây là BestSeller</h2>
    <?php   
    CardBestller("hahahaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa","hahaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",1,1,1,1,'https://is1-ssl.mzstatic.com/image/thumb/Music112/v4/2c/58/35/2c583588-177a-0f1f-21a7-91f9789d3cf2/8809603547668_Cover.jpg/1200x1200bf-60.jpg','1')
    ?>
    <?php generateDiscountHeader("ABOUT US") ?>
@endsection