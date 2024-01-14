@extends('layouts.main')
@section('title',"History")
@section('css')
    <link rel="stylesheet" href="/assets/css/payment_history.css">  
@endsection
 @section('content')
    <center><h1>Order History</h1></center>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Time</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @if (count($paymentHistory)==0)
                <tr>
                    <td>Empty</td>
                    <td>Empty</td>
                    <td>Empty</td>
                    <td>Empty</td>
                    <td>Empty</td>
                </tr>
            @else
                @foreach ($paymentHistory as $payment)
                    @foreach ($payment->order->orderDetails as $detail)
                        <tr>
                            <td>{{ $payment->order_id }}</td>
                            <td>{{ $payment->order->date }}</td>
                            <td>{{ $detail->product->product_name }}</td>
                            <td>{{ $detail->quanity }}</td>
                            <td>{{ $payment->amount}}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
