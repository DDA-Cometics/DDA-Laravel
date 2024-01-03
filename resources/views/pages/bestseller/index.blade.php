@extends('layouts.main')
@section('title')
@section('css')
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
   </script>
    <?php generateDiscountHeader2("SKINCARE TOP SELLER") ?>
    <div class="row mx-4">
        <div class="col-3 bg-light" style="max-height:600px">
           <center> <button class="btn fillter mt-4" id="fillter">FILLTER BY</button></center>
        </div>
        <div class="col-9">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col ml-2 mt-4">
                        @php 
                            CardBestller(
                                $product->id,
                                $product->product_name,
                                $product->size,
                                $product->price,
                                $product->description,
                                $product->category,
                                $product->image,
                                50,
                            );
                        @endphp
                    </div>
                    @if ($loop->iteration % 4 == 0)
                        </div><div class="row">
                    @endif
                @endforeach
            </div>
        </div>        
    </div>
    <?php generateDiscountHeader("YOU MAY ALSO LIKE") ?>

    <?php generateDiscountHeader("ABOUT US") ?>
@endsection