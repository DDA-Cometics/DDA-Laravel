@extends('layouts.main')
@section('title', 'Cart')
@section('css')
    <link rel="stylesheet" href="/assets/css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')

    <?php
    
    function createCartPage($id, $name, $size, $price, $description, $category, $image, $discount,$quanity)
    {
        echo '
         <div class="row" id="containerProducts" >
            <div class="col-4 mt-2">
                <img style="width:150px;height:200px;" src="' .
            $image .
            '" alt="' .
            $name .
            '">
            </div>
            <div class="col-8">
                <h5>' .
            $name .
            '</h5><br>  
                <div class="row">
                    <div class="col-4">
                        <i class="fa-solid fa-circle-info"></i> YOU GET ' .
            $discount .
            ' OFF!  <br>
                        <br><h5>' .
            $size .
            '</h5>
                    </div>
                    <div class="col-8">
                        <h6>Quantity</h6>
                        <div class="quantity-container">
                            <button class="btn btn-light decreaseBtn">-</button>
                            <input style="width:70px" type="number" class="form-control quantity-input" style="width: 50px;" value="'.$quanity.'">
                            <button class="btn btn-light increaseBtn">+</button>
                        </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col d-flex id="myPrice">
                        <div class="mr-3" id="newPrice" ><del style="text-decoration: line-through">$' .
            $price .
            '</div>
                        <div class="oldPrice" >$' .
            ($price - $discount) .
            '</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <h5 class="selectable-button" onclick="handleButtonClick(this)">Edit</h5>
                    </div>
                    <div class="col-5">
                        <h5 class="selectable-button" onclick="handleButtonClick(this)">Add to Wishlist</h5>
                    </div>
                    <div class="col-4">
                        <h5 class="selectable-button" onclick="handleButtonClick(this)">Remove</h5>
                    </div>
                </div>
    
           </div>
    
           </div>';
    }
    
    ?>

    <body>
        <h2 class="mt-4 ml-3">My Shopping Bag (<?php echo count($shoppingCart); ?> Items)</h2><br>
        <div class="row container-fluid">
            <div class="col-7">
                <center>
                    <div id="title"><i class="fas fa-check-circle pb-3" style="color:green"></i> FREE ground shipping
                    </div>
                </center>
                <div class= "border: 1px solid black">
                    <hr style="border: 1px solid;">
                </div>

                
                @foreach ($shoppingCart as $cartItem)
                @php
                    createCartPage(
                        $cartItem['products']['product_id'],
                        $cartItem['products']['product_name'],
                        $cartItem['products']['size'],
                        $cartItem['products']['price'],
                        $cartItem['products']['description'],
                        $cartItem['products']['category'],
                        $cartItem['products']['image'],
                        50,
                        $cartItem['quanity']
                    );
                @endphp
            @endforeach
            
                
                
            </div>

            <div class="col-5 mx-auto " id="payMent">
                <div class="content"style="width: 100; height: 100%; background: #D9D9D9">
                    <div class="row p-3">
                        <div class="col-6">
                            <h6>SUBTOTAL</h6><br>
                            <h6>ESTIMATED SHIPPING</h6><br>
                            <h6>ESTIMATED TAX <div style="width: 50%; height: 100%; border: 2px #736D6D solid"></div><br>
                            </h6>
                        </div>
                        <div class="col-6 text-right">
                            <h6>$75.00</h6><br>
                            <h6>Free</h6><br>
                            <h6>$0.00</h6><br>
                        </div>
                    </div>
                    <form action="">
                        <div class="row p-3" id ="tables">
                            <div class="col">
                                <div class="border-line" id="line">
                                    <h6>Add a promo code</h6>
                                    <div class="newInput">
                                        <input type="text" id="new">
                                        <button type="submit" id="apply">APPLY</button><br>
                                        <p>Please note: Certain promotions cannot be combined. Please see specific promotion
                                            terms and conditions.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form><br>
                    <div class="row p-3">
                        <div class="col-6">
                            <h6>ESTIMATED TOTAL</h6>
                        </div>
                        <div class="col-6 text-right">
                            <h6>$75.00</h6>
                        </div>
                    </div><br>
                    <div class="checkoutButton ">
                        <center><button id="checkout">PROCEED TO SECURE CHECKOUT </button></center>
                    </div><br>
                    <div class="momoPay">
                        <center><button id="momo">MMOMO PAY</button></center>
                    </div><br>
                    <div class="pickUp">
                        <center> <button id="pickup">PICK UP DIRECTLY AT THE STORE </button>
                            <center>
                    </div>
                </div>
            </div>

            <script>
                let currentQuantity = 1;
                let originalWidth, originalHeight;

                function changeImage(newImageUrl) {
                    const quantityInput = document.getElementById('quantityInput');
                    currentQuantity = quantityInput.value;

                    const mainImage = document.getElementById('mainImage');
                    if (!originalWidth && !originalHeight) {
                        originalWidth = mainImage.width;
                        originalHeight = mainImage.height;
                    }

                    mainImage.src = newImageUrl;
                    mainImage.style.width = originalWidth + 'px';
                    mainImage.style.height = originalHeight + 'px';
                    mainImage.style.border = 'none';

                    quantityInput.value = currentQuantity;
                }

                document.querySelectorAll('.quantity-container').forEach(container => {
                    const decreaseBtn = container.querySelector('.decreaseBtn');
                    const increaseBtn = container.querySelector('.increaseBtn');
                    const quantityInput = container.querySelector('.quantity-input');

                    decreaseBtn.addEventListener('click', () => {
                        updateQuantity(quantityInput, -1);
                    });

                    increaseBtn.addEventListener('click', () => {
                        updateQuantity(quantityInput, 1);
                    });
                });

                function updateQuantity(quantityInput, change) {
                    let newQuantity = parseInt(quantityInput.value) + change;
                    newQuantity = Math.max(1, newQuantity);
                    quantityInput.value = newQuantity;
                }

                function handleButtonClick(element) {
                    // Toggle the 'selected-button' class
                    element.classList.toggle('selected-button');

                    // Remove 'selected-button' class from other buttons
                    document.querySelectorAll('.selectable-button').forEach(button => {
                        if (button !== element) {
                            button.classList.remove('selected-button');
                        }
                    });
                }
            </script>
        @endsection
