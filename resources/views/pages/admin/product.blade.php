@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="/assets/css/productCreate.css">
@endsection

@section('content')

<button id="showForm1" class="Btn" onclick="toggleForm()">

    <div class="sign">+</div>

    <div id="showForm" class="text">Create</div>
</button>

<div id="container" class="d-none">
    <form class="create" action="/product/create" id="formUser" method="post">
        @csrf
        <div class="form-inp">
            <label for="image">Image:</label>
            <input type="text" id="image" name="image" required><br>
            @if ($errors->has('image'))
            <span class="error">{{ $errors->first('image') }}</span>
            @endif
        </div>
        <div class="form-inp">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required><br>
            @if ($errors->has('product_name'))
            <span class="error">{{ $errors->first('product_name') }}</span>
            @endif
        </div>
        <div class="form-inp">
            <label for="size">Size:</label>
            <input type="text" id="size" name="size" required><br>
            @if ($errors->has('size'))
            <span class="error">{{ $errors->first('size') }}</span>
            @endif
        </div>
        <div class="form-inp">
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required><br>
            @if ($errors->has('price'))
            <span class="error">{{ $errors->first('price') }}</span>
            @endif
        </div>
        <div class="form-inp">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea><br>
            @if ($errors->has('description'))
            <span class="error">{{ $errors->first('description') }}</span>
            @endif
        </div>
        <div class="form-inp">
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required><br>
            @if ($errors->has('category'))
            <span class="error">{{ $errors->first('category') }}</span>
            @endif
        </div>

        <button id="submit-button" type="submit">Create</button>
        <button id="cancel-button" type="button" onclick="toggleForm()">Cancel</button>
    </form>
</div>

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
                <form action="/product/delete" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-remove" name="id" value="{{$p->id}}" id="removeBtn">Remove</button>
                </form>
                <button class="btn btn-edit" name="id" value="({{$p->id}})" id="editBtn">Edit</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    function toggleForm() {
        var form = document.getElementById("container");
        form.classList.toggle("d-none");
        form.classList.toggle("d-flex");
    }
    document.addEventListener('DOMContentLoaded', function() {
    // Kiểm tra nếu có thông báo lỗi hiển thị trên form
    const errorSpans = document.querySelectorAll('.error');

    if (errorSpans.length > 0) {
        // Nếu có lỗi xuất hiện, thực hiện hàm toggleForm()
        toggleForm();
    }
});
</script>


@endsection