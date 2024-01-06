@extends('layouts.main')
@section('title', 'Home Page')

@section('css')
<link rel="stylesheet" href="/assets/css/home.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<?php
function generateDiscountHeader($text)
{
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
function generateProductCard($id, $name, $size, $price, $description, $category, $image, $discount)
{
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
                            <span class="newPrice">$' . $price - ($price * ($discount / 100)) . '</span>
                        </div>
                        <div class="col">
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
function discountBanner($n)
{
    echo '
            ' . $n . '%
        ';
}
function ButtonBuyNow()
{
    echo '<a href="best-seller"><button class="btn mr-5" id="buynowBtn">Buy Now</button></a>';

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
        // Chuyển hướng đến trang detail với ID của sản phẩm
        window.location.href = '/product-details?id=' + productId;
    }
   </script>
  <div class="banner" id="banner">

    <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703164519/Web%20DDA%20COMECTIC/yrnoriupxwfqjtaos6un.jpg" alt="">
    <div class="discountBanner">
        <?php discountBanner(50) ?>
    </div>
    <div class="btnBanner">
        <?php ButtonBuyNow() ?>
    </div>
    <div class="slogan">
        <p>Stand Firm Sale - Buy Wholeheartedly</p>
    </div>
</div>
<?php generateDiscountHeader("50% OFF SELECT BEST SELLERS") ?>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">

        @php
        $totalItems = count($products);
        $slides = ceil($totalItems / 4);
        @endphp

        @for ($i = 0; $i < $slides; $i++) <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
            <div class="card-wrapper container-sm d-flex justify-content-around">

                @for ($j = $i * 4; $j < min(($i + 1) * 4, $totalItems); $j++) <div class="col-md-3">
                    @php
                    generateProductCard(
                    $products[$j]->id,
                    $products[$j]->product_name,
                    $products[$j]->size,
                    $products[$j]->price,
                    $products[$j]->description,
                    $products[$j]->category,
                    $products[$j]->image,
                    50,
                    ); @endphp
            </div>
            @endfor

    </div>
</div>
@endfor

</div>

<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
</a>

<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>
</div>

<?php generateDiscountHeader("ULTRA FACIAL FAVORITES") ?>
<div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">

      @php
          $totalItems = count($products);
          $slides = ceil($totalItems / 4);
      @endphp
    
      @for ($i = 0; $i < $slides; $i++)
          <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
              <div class="card-wrapper container-sm d-flex justify-content-around">


                @for ($j = $i * 4; $j < min(($i + 1) * 4, $totalItems); $j++) <div class="col-md-3">
                    @php
                    favoritesProductCard(
                    $products[$j]->id,
                    $products[$j]->product_name,
                    $products[$j]->size,
                    $products[$j]->price,
                    $products[$j]->description,
                    $products[$j]->category,
                    $products[$j]->image,
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
<?php generateDiscountHeader("OUR SERVICES"); ?>
<div class="container-fluid ">
    <div class="row">
        <div class="col-1">
        </div>
        <div class="col-5 " style="color:black; font-size: 30px; line-height: 30px;">
            <br><br><br>
            <div class="row">
                <div class="col mb-5">
                    <strong>GET REWARDED FORTREATING YOUR SKIN!</strong>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Join My DDA Rewards to start earning points, rewards, and exclusive perks! Earn 1 point for every $1
                    spent (100 points=$10 OFF!)
                </div>
            </div>
            <div class="row mt-5">
                @if(session()->has('user_data'))
                    <div class="col "></div>
                    <div class="col text-center">
                        <?php ButtonBuyNow(); ?>
                    </div>
                    <div class="col"></div>
                @else
                    <div class="col">
                        <?php ButtonSignUp(); ?>
                    </div>
                    <div class="col">
                        <?php ButtonSignIn(); ?>
                    </div>  
                @endif
            </div>
        </div>
        <div class="col-5 ">
            <img id="ImgService" src="https://res.cloudinary.com/duas1juqs/image/upload/v1703078914/Web%20DDA%20COMECTIC/bqj9oialnhxwdqbuibdt.png" alt="">
        </div>
        <div class="col-1 ">

        </div>
    </div>
</div>
<?php generateDiscountHeader("CHOSEN FOR YOU"); ?>
<div class="container mb-5">
    <div class="row ">
        <div class="col-3 text-center ">
            <div>
                <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703081592/Web%20DDA%20COMECTIC/fcp2auslbdbq60uwgcbl.png" />
                <h4>CYBER DEALS</h4>
            </div>
        </div>

        <div class="col-3 text-center">
            <div>
                <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703088248/Web%20DDA%20COMECTIC/ugbgjzvszagqj8kkqqev.png">
                <h4>BEST SELERS</h4>
            </div>
        </div>

        <div class="col-3 text-center">
            <div>
                <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703088350/Web%20DDA%20COMECTIC/x7s4y9vovtdc44zv7pyn.png">
                <h4>MOISTUZI</h4>
            </div>
        </div>

        <div class="col-3 text-center">
            <div>
                <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703088464/Web%20DDA%20COMECTIC/ql2l4orvow5vro88yprl.png">
                <h4>GIFTS FOR ALL</h4>
            </div>
        </div>
    </div>
</div>
<?php generateDiscountHeader("ABOUT US") ?>
@endsection