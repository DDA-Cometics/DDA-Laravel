@extends('layouts.main')
@section('title', 'Home Page')

@section('css')
  <link rel="stylesheet" href="/assets/css/home.css">

@endsection

@section('content')
    @foreach ($products as $p )
      <div class="haha">id: {{$p->id}}</div>
      <div class="">id: {{$p->product_name}}</div>
    @endforeach
@endsection

<form method="POST" action="/product/create">
  @csrf

  name:<input type="text" name="product_name">
  size:<input type="text" name="size">
  price:<input type="text" name="price">
  Mô tả:<input type="text" name="description">
  image:<input type="text" name="image">
  <button type="submit">Submit</button>
</form>