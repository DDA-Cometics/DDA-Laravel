@extends('layouts.main')
@section('title', 'Home Page')

@section('css')
<link rel="stylesheet" href="/assets/css/home.css">
<link rel="stylesheet" href="/assets/css/search.css">
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
function ButtonSignUp()
{
    echo '<a href="register"><button id="buttonSignUp" type="button">REGISTER</button></a>';
}
function ButtonSignIn()
{
    echo '<a href="login"><button id="buttonSignIn" type="button">SIGN IN</button></a>';
}
?>
<script>
    function redirectToDetail(productId) {
        // Chuyển hướng đến trang detail với ID của sản phẩm
        window.location.href = '/product-details?id=' + productId;
    }
</script>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="row m-2">
            @if($products->isEmpty())
                 <center class="col message">
                    I apologize, but no matching products were found. 
                </center>
            @else
                @foreach ($products as $item)
                <div class="col-4 mb-5">
                    @php
                    generateProductCard(
                    $item->id,
                    $item->product_name,
                    $item->size,
                    $item->price,
                    $item->description,
                    $item->category,
                    $item->image,
                    50
                    )
                    @endphp
                </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-2"></div>
</div>




@endsection