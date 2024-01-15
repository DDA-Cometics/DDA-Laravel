@extends('layouts.main')

@section('title', 'Cart')

@section('css')
    <link rel="stylesheet" href="/assets/css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" 
    />
@endsection

@section('content')
    @if(request('err'))
        <div id="errorModal" class="modal">
            <div class="modal-content " id="modalErr">
                <button class="close text-right">X</button>
                <p>You haven't added any products to your cart. Please add products before proceeding.</p>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var modal = document.getElementById('errorModal');
                modal.style.display = 'block';
                var closeBtn = document.querySelector('.close');
                closeBtn.addEventListener('click', function() {
                    modal.style.display = 'none';
                });
                setTimeout(function() {
                    modal.style.display = 'none';
                }, 8000);
            });
        </script>
    @endif
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
                <div class="d-none">
                    <?= $total=0; ?>
                </div>
                @foreach ($shoppingCart as $cartItem)
                    <?php
                        $product_id = $cartItem['products']['id'];
                        $product_name = $cartItem['products']['product_name'];
                        $size = $cartItem['products']['size'];
                        $price = $cartItem['products']['price'];
                        $description = $cartItem['products']['description'];
                        $category = $cartItem['products']['category'];
                        $image = $cartItem['products']['image'];
                        $discount = 50;
                        $quantity = $cartItem['quanity'];
                        $a= ($price* $quantity) - (($discount/100)*($price* $quantity));
                        $total += $a;
                    ?>  
                    <div class="row" id="containerProducts">
                        <div class="col-4 mt-2">
                            <img style="width: 150px; height: 200px;" src="<?= $image ?>" alt="<?= $product_name ?>">
                        </div>
                        <div class="col-8">
                            <h5><?= $product_name ?></h5><br>
                            <div class="row">
                                <div class="col-4">
                                    <i class="fa-solid fa-circle-info"></i> YOU GET <?= $discount ?> OFF! <br>
                                    <br><h5><?= $size ?></h5>
                                </div>
                                <div class="col-8">
                                    <h6>Quantity</h6>
                                    <form action="/add-to-cart" method="post">
                                        @csrf
                                    <div class="quantity-container">  
                                        <input type="number" name="id" value="{{ session('user_data')['id'] ?? 0 }}" class="d-none">
                                        <input type="number" name="product_id" id="product_id" value="<?php echo $product_id ?>" class="d-none">
                                        <button  type="button" class="btn btn-light decreaseBtn">-</button>
                                        <input style="width: 100px" type="number" class="form-control quantity-input text-center" style="width: 50px;" name="quanity" value="<?= $quantity ?>">
                                        <button  type="button" class="btn btn-light increaseBtn">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col d-flex" id="myPrice">
                                    <div class="mr-3" id="newPrice"><del style="text-decoration: line-through">$<?= $price ?></del></div>
                                    <div class="oldPrice">$<?= $a ?></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                            
                                    <button type="submit" class="selectable-button" style="width:100px;font-weight: 650;" id="saveBtn">Save</button>
                                </div>
                            </form>
                            <div class="modal fade" id="wishlistModal" tabindex="-1" aria-labelledby="wishlistModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="wishlistModalLabel">Wishlist Update</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Chúng tôi sẽ cập nhật tính năng này.
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="col-5">
                                    <h5 class="selectable-button" >Add to Wishlist</h5>
                                </div>
                                <div class="col-4">
                                    <form action="/add-to-cart" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="number" name="id" value="{{ session('user_data')['id'] ?? 0 }}" class="d-none">
                                        <input type="number" name="product_id" id="product_id" value="<?php echo $product_id ?>" class="d-none">
                                    <button type="submit" class="selectable-button h5" id="removeBtn">Remove</button>
                                </form>
                                </div>
                            </div>
                     
                        </div>
                    </div>
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
                            <h6><?= $total ?></h6><br>
                            <h6>Free</h6><br>
                            <h6>$0.00</h6><br>
                        </div>
                    </div>
                    <form action="/payUrl" method="post">
                        @csrf
                        <div class="row p-3" id ="tables">
                            <div class="col">
                                <div class="border-line" id="line">
                                    <h6>Add a promo code</h6>
                                    <div class="newInput" >
                                        <select id="new" name="voucher_id" style="height: 40px;">
                                            <option value="0" selected disabled>Select a voucher</option>
                                            @foreach($vouchers as $voucher)
                                                @if( $total < 1000 && $voucher->discount <= 3)
                                                    <option value="{{ $voucher->discount }}">
                                                        {{ $voucher->description }}
                                                    </option>
                                                @elseif( $total > 2000 && $voucher->discount <= 5)
                                                    <option value="{{ $voucher->discount }}">
                                                        {{ $voucher->description }}
                                                    </option>
                                                @elseif($total > 3000 && $voucher->discount <= 8)
                                                    <option value="{{ $voucher->discount }}">
                                                        {{ $voucher->description }}
                                                    </option>
                                                @elseif($total > 6000 && $voucher->discount <= 10)
                                                    <option value="{{ $voucher->discount }}">
                                                        {{ $voucher->description }}
                                                    </option>
                                                @elseif( $total > 15000 && $voucher->discount <= 15)
                                                    <option value="{{ $voucher->discount }}">
                                                        {{ $voucher->description }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <input type="text" name="user_name" value="{{ session('user_data')['last_name'] }} {{ session('user_data')['first_name'] }}" class="d-none">
                                        <button type="button" id="apply" name="payUrl" onclick="applyVoucher()">APPLY</button><br>
                                        <p>Please note: Certain promotions cannot be combined. Please see specific promotion
                                            terms and conditions.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <br>
                    <div class="row p-3">
                        <div class="col-6">
                            <br>
                            <h6>ESTIMATED TOTAL</h6>
                        </div>
                        <div class="col-6 text-right">  
                            <h6><?= $total ?></h6>
                            <p id="discountMessage"></p>
                            <h6 id="new_total" class="text-danger"><?= $total ?></h6>
                            <input type="number" name="amount" id="amount" value="<?= $total ?>" class="d-none">
                        </div>
                    </div><br>
                    <div class="checkoutButton ">
                        <center><button type="button" id="checkout">PROCEED TO SECURE CHECKOUT </button></center>
                    </div><br>
                    <div class="momoPay">

                        <center><button type="submit" id="momo" name="payUrl">MMOMO PAY</button></center>
                    </div><br>
                    <div class="pickUp">
                        <center> <button type="button" id="pickup">PICK UP DIRECTLY AT THE STORE </button>
                            <center>
                    </div>
                </div>
            </div>
        </form>
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
        function applyVoucher(){
            var discountValue = parseFloat(document.getElementById('new').value);
            var totalValue = <?= $total ?>;
            var discountedTotal = totalValue - (totalValue * discountValue / 100);
            document.getElementById('new_total').innerText = discountedTotal.toFixed(0);
            document.getElementById('amount').value = discountedTotal;
            document.getElementById('discountMessage').innerText = 'Discount of ' + discountValue + '% applied.';
        }
    </script>
@endsection