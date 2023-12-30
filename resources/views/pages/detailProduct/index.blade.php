@extends('layouts.main')

@section('title', 'Detail Page')

@section('css')
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/detailProduct.css">
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 ">
                <div class="d-flex justify-content-center">
                    <img id="mainImage" src="{{ $products->image }}" alt="Sữa tắm" class="img-fluid mb-3">
                </div>
                <div class="d-flex justify-content-center">
                    <div class="col-4 mx-1" style="padding: 0; ">
                        <img onclick="changeImage('https://res.cloudinary.com/duas1juqs/image/upload/v1703471009/Web%20DDA%20COMECTIC/p1qqsfgpmdepdwj7rsnv.png')"
                            src="https://res.cloudinary.com/duas1juqs/image/upload/v1703471009/Web%20DDA%20COMECTIC/p1qqsfgpmdepdwj7rsnv.png"
                            alt="Dầu gội" class="small-image">
                    </div>
                    <div class="col-4 mx-1" style="padding: 0;">
                        <img onclick="changeImage('https://res.cloudinary.com/duas1juqs/image/upload/v1703471073/Web%20DDA%20COMECTIC/mzhk9ji272xq0rn66p0s.png')"
                            src="https://res.cloudinary.com/duas1juqs/image/upload/v1703471073/Web%20DDA%20COMECTIC/mzhk9ji272xq0rn66p0s.png"
                            alt="Chăm sóc" class="small-image">
                    </div>
                    <div class="col-4 mx-1" style="padding: 0;">
                        <img onclick="changeImage('https://res.cloudinary.com/duas1juqs/image/upload/v1703471149/Web%20DDA%20COMECTIC/if4p8lvjdcrlugq7hvpw.png')"
                            src="https://res.cloudinary.com/duas1juqs/image/upload/v1703471149/Web%20DDA%20COMECTIC/if4p8lvjdcrlugq7hvpw.png"
                            alt="Dầu xả" class="small-image">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <div class="w-100">
                       <h4 id="nameProduct">{{ $products->product_name }}</h4><br>
                        <div class="custom-border " id="Star"></div>
                        <div class="d-flex">
                            <div class="mr-3">
                                <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703472124/Web%20DDA%20COMECTIC/dghewvbdzpk2f4ojc7wy.png"
                                    alt="Sao">
                                <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703472124/Web%20DDA%20COMECTIC/dghewvbdzpk2f4ojc7wy.png"
                                    alt="Sao">
                                <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703472124/Web%20DDA%20COMECTIC/dghewvbdzpk2f4ojc7wy.png"
                                    alt="Sao">
                                <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703472124/Web%20DDA%20COMECTIC/dghewvbdzpk2f4ojc7wy.png"
                                    alt="Sao">
                                <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703472265/Web%20DDA%20COMECTIC/vngvbk1bywoaidyjpune.png"
                                    alt="Sao">
                            </div>
                            <p class="mb-0">(1452)</p>
                        </div><br>
                        <div class="d-flex">
                            
                            <div class="mr-3" id="newOld">$ {{ $products->price }}
                            </div>
                            <div
                                id="newsPrice">
                                $ {{ $products->price / 2 }}</div>
                        </div><br>
                        <div>
                            <p>{{ $products->description }}</p>
                        </div>
                        <div class="size_product">
                            <b>Size: </b>
                            <select name="product_size" id="product_size">
                                <option value="{{ $products->size }}">{{ $products->size }}ml</option>
                            </select>
                        </div>
                        <div class="container mt-5">
                            <div class="quantity-container">
                                <button class="btn btn-light" id="decreaseBtn">-</button>
                                <input type="text" class="form-control quantity-input" id="quantityInput" value="1"
                                    readonly>
                                <button class="btn btn-light" id="increaseBtn">+</button>
                            </div>
                        </div><br>
                        <div class="button-container">
                            <button class="btn" id="buynowBtn">Buy Now</button>

                            <button class="btn custom-button cart-button" id="buynowBtn">
                                <i class="fa-solid fa-cart-shopping text-light"></i>
                            </button>
                        </div>

                    </div>
                </div>
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

        document.getElementById('decreaseBtn').addEventListener('click', () => {
            updateQuantity(-1);
        });

        document.getElementById('increaseBtn').addEventListener('click', () => {
            updateQuantity(1);
        });

        function updateQuantity(change) {
            const quantityInput = document.getElementById('quantityInput');
            let newQuantity = parseInt(quantityInput.value) + change;


            newQuantity = Math.max(1, newQuantity);

            quantityInput.value = newQuantity;
            currentQuantity = newQuantity;
        }
    </script>

@endsection
