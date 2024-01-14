@extends('layouts.main')
@section('title',"Checkout")
@section('css')
    <link rel="stylesheet" href="/assets/css/checkout.css">  
@endsection
    @section('content')
    @php
        $partnerCode = $data['partnerCode'];
        $orderId = $data['orderId'];
        $requestId = $data['requestId'];
        $amount = $data['amount'];
        $orderInfo = $data['orderInfo'];
        $orderType = $data['orderType'];
        $transId = $data['transId'];
        $resultCode = $data['resultCode'];
        $message = $data['message'];
        $payType = $data['payType'];
        $responseTime = $data['responseTime'];
        $extraData = $data['extraData'];
        $signature = $data['signature'];
        $paymentOption = $data['paymentOption'];
    @endphp
    <div class="container-fluid" id="modelPayment">
        <div class="content">
            @if ($message=="Successful.")
                <h1>Payment Successful !</h1><br><br>
                <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703351741/Web%20DDA%20COMECTIC/gurc3wpnyhzqpsdqibgd.png" alt="logo"><br> <br>
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <p>Payment type</p>
                            <p>Your name</p>
                            <p>Mobile</p>
                            <p>Email </p>
                            <p>Amount paid  </p>
                        </div>
                        <div class="col-6">
                            <p>{{$payType}} </p>
                            <p>{{$orderInfo}}</p>
                            <p> {{ session('user_data')['user_phone'] }}</p>
                            <p>{{ session('user_data')['email'] }}</p>
                            <p class="text-success">$ {{$amount}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="/history" type="submit" class="btn btn-primary font-weight-bold" >SHOW</a>
                        </div>
                    </div>
                </div>
            @else
                <h1>Payment Failed !</h1><br><br>
                <img src="https://res.cloudinary.com/duas1juqs/image/upload/v1703325910/Web%20DDA%20COMECTIC/claem76qdwwlnmglebap.png" alt="logo"><br> <br>
                <p>Sorry, your payment failed for some reason. <br>
                    - The order has been cancelled. <br>
                    - Internet connection is interrupted. <br>
                    You can re-order or try to test the connection.
                </p>
                <div class="row">
                    <div class="col">
                        <a href="/cart" type="submit" class="btn btn-primary font-weight-bold" >Return to payment page</a>
                    </div>
                </div>
            @endif 
        </div>
    </div>
@endsection
