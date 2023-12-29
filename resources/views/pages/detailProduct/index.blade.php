@extends('layouts.main')

@section('title', 'Detail Page')

@section('css')
    <link rel="stylesheet" href="/assets/css/detailProduct.css">
@endsection

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-md-6 ">
            <div class="d-flex justify-content-center" style="display:flex; justify-content:center">
                <img id="mainImage" src="https://res.cloudinary.com/duas1juqs/image/upload/v1703470305/Web%20DDA%20COMECTIC/ikmlaqkj5wh3jkydbssm.png" alt="Sữa tắm" class="img-fluid mb-3">
            </div>
            <div class="d-flex justify-content-center">
                <div class="col-4 mx-1" style="padding: 0; ">
                    <img onclick="changeImage('https://res.cloudinary.com/duas1juqs/image/upload/v1703471009/Web%20DDA%20COMECTIC/p1qqsfgpmdepdwj7rsnv.png')" src="https://res.cloudinary.com/duas1juqs/image/upload/v1703471009/Web%20DDA%20COMECTIC/p1qqsfgpmdepdwj7rsnv.png" alt="Dầu gội" class="small-image">
                </div>
                <div class="col-4 mx-1" style="padding: 0;">
                    <img onclick="changeImage('https://res.cloudinary.com/duas1juqs/image/upload/v1703471073/Web%20DDA%20COMECTIC/mzhk9ji272xq0rn66p0s.png')" src="https://res.cloudinary.com/duas1juqs/image/upload/v1703471073/Web%20DDA%20COMECTIC/mzhk9ji272xq0rn66p0s.png" alt="Chăm sóc" class="small-image">
                </div>
                <div class="col-4 mx-1" style="padding: 0;">
                    <img onclick="changeImage('https://res.cloudinary.com/duas1juqs/image/upload/v1703471149/Web%20DDA%20COMECTIC/if4p8lvjdcrlugq7hvpw.png')" src="https://res.cloudinary.com/duas1juqs/image/upload/v1703471149/Web%20DDA%20COMECTIC/if4p8lvjdcrlugq7hvpw.png" alt="Dầu xả" class="small-image">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <div>
                    <h4>Lotion Olay Body Cellscience B3 + Vitamin c</h4><br>
                    <div class="custom-border"  style=" border: 1px black solid"></div>
                    <div class="d-flex">
                        <div class="mr-3">
                            <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703472124/Web%20DDA%20COMECTIC/dghewvbdzpk2f4ojc7wy.png" alt="Sao">
                            <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703472124/Web%20DDA%20COMECTIC/dghewvbdzpk2f4ojc7wy.png" alt="Sao">
                            <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703472124/Web%20DDA%20COMECTIC/dghewvbdzpk2f4ojc7wy.png" alt="Sao">
                            <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703472124/Web%20DDA%20COMECTIC/dghewvbdzpk2f4ojc7wy.png" alt="Sao">   
                            <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703472265/Web%20DDA%20COMECTIC/vngvbk1bywoaidyjpune.png" alt="Sao">   
                        </div>
                        <p class="mb-0">(1452)</p>
                    </div><br>
                    <div class="d-flex">
                        <div class="mr-3" style="color: #000; font-size: 26px; font-family: Noto Serif; font-weight: 400;"><del style="text-decoration: line-through">$50.00</del>
                        </div>
                        <div style="color: #F40707; font-size: 26px; font-family: Noto Serif; font-weight: 400; text-transform: capitalize; letter-spacing: 0.91px; word-wrap: break-word">$30.00</div>
                    </div><br>
                    <div>
                      <p>The Olay Body Cellscience B3 + Vitamin C Body Lotion is a highly acclaimed skincare product that has received numerous accolades for its exceptional quality. This body lotion is part of Olay's Body Cellscience line, which is designed to address the unique needs of mature skin. The B3 + Vitamin C formula is particularly noteworthy as it combines two powerful ingredients, niacinamide (B3) and vitamin C, to provide a range of benefits for the skin.</p>
                    </div>
                    <div class="container mt-5">
                      <div class="quantity-container">
                          <button class="btn btn-light" id="decreaseBtn">-</button>
                          <input type="text" class="form-control quantity-input" id="quantityInput" value="1" readonly>
                          <button class="btn btn-light" id="increaseBtn">+</button>
                      </div>
                  </div><br>
                  <div class="button-container">
                  <button class="btn custom-button" style="padding: 10px 20px" onclick="addToCart('product123')">BUY NOW</button>

                    <button class="btn custom-button cart-button" style="width: 150px">
                        <img style="width:20px; height:20px " src="https://res.cloudinary.com/duas1juqs/image/upload/v1703476193/Web%20DDA%20COMECTIC/rqafps51whllc9mimpay.png" alt="giỏ hàng">
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
    
    
    let cart = [];
    function addToCart(productId) {
        cart.push(productId);
        alert('Added to cart. Product ID: ' + productId);
        console.log('Cart:', cart);
    }
    function getCartContent() {
        return cart;
    }
    function viewCart() {
        const cartContent = getCartContent();
        alert('Cart Content: ' + JSON.stringify(cartContent))
    }
    
    
    </script>
    
@endsection
