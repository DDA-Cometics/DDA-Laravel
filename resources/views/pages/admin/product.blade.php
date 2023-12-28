@extends('layouts.admin')
@section('content')

<table id="productTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Size</th>
            <th>Price</th>
            <th>Description</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Table rows will be inserted here using JavaScript -->
        @foreach ($products as $p )
            <tr>
                <td>{{$p->id}}</td>
                <td><img src="{{$p->image}}" alt="Product Image" style="max-width: 100px; max-height: 100px;"></td>
                <td>{{$p->product_name}}</td>
                <td>{{$p->size}}</td>
                <td>{{$p->price}}</td>
                <td>{{$p->description}}</td>
                <td>{{$p->category}}</td>
                <td>
                    <button class="btn btn-remove" onclick="removeProduct({{$p->id}})" id="removeBtn">Remove</button>
                    <button class="btn btn-edit" onclick="editProduct({{$p->id}})" id="editBtn">Edit</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection