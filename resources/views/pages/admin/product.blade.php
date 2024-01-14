@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="/assets/css/productCreate.css">
@endsection

@section('content')

<button id="showForm1" class="Btn" onclick="toggleForm()">

    <div class="sign">+</div>

    <div id="showForm" class="text">NEW</div>
</button>

<div id="container" class="d-none">
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <form class="" action="/admin/product/create" id="formUser" method="post">
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
                <div class="form-inp">
                    <label for="skin_type">skin_type:</label>
                    <input type="text" id="skin_type" name="skin_type" required><br>
                    @if ($errors->has('skin_type'))
                    <span class="error">{{ $errors->first('skin_type') }}</span>
                    @endif
                </div>
                <div class="form-inp">
                    <label for="skin_concerns">skin_concerns:</label>
                    <input type="text" id="skin_concerns" name="skin_concerns" required><br>
                    @if ($errors->has('skin_concerns'))
                    <span class="error">{{ $errors->first('skin_concerns') }}</span>
                    @endif
                </div>
                <div class="form-inp">
                    <label for="ingredient">ingredient:</label>
                    <input type="text" id="ingredient" name="ingredient" required><br>
                    @if ($errors->has('ingredient'))
                    <span class="error">{{ $errors->first('ingredient') }}</span>
                    @endif
                </div>
                <button id="submit-button" class="mb-3" type="submit">Create</button>
                <button id="cancel-button" type="button" onclick="toggleForm()">Cancel</button>

            </form>
        </div>
        <div class="col"></div>
    </div>
</div>
<div class="table-wrapper">
    <div class="context">
        <h3>LIST PRODUCT<hr ></h5>
    </div>
    <table id="productTable">
        <thead id=" row1">
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
                    <form action="/admin/product/delete" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-remove" name="id" value="{{$p->id}}" id="removeBtn">Remove</button>
                    </form>
                    <button class="btn btn-edit" onclick="toggleForm2('{{$p->id}}')" id="editBtn">Edit</button>
                <td>
            </tr>
            <div class="d-none" id="container2-{{$p->id}}">
                <div class="row" id="controForm">
                    <div class="col"></div>
                    <div class="col">
                        <div class="containerForm2 ">
                            <form action="/admin/product-management/update/{{$p->id}}" method="POST" id="updateP" class="d-none">
                                @csrf
                                @method('PUT')
                                <div class="form-inp">
                                    <label for="image">image</label>
                                    <input type="text" id="image" value="{{ $p->image }}" name="image">
                                </div>
                                <div class="form-inp">
                                    <label for="size">size</label>
                                    <input type="text" id="size" value="{{ $p->size }}" name="size">
                                </div>
                                <div class="form-inp">
                                    <label for="product_name">Product name</label>
                                    <input type="text" id="product_name" value="{{ $p->product_name }}" name="product_name">
                                </div>
                                <div class="form-inp">
                                    <label for="description">description</label>
                                    <input type="text" id="description" value="{{ $p->description }}" name="description">
                                </div>
                                <div class="form-inp">
                                    <label for="price">Price</label>
                                    <input type="double" id="price" value="{{ $p->price }}" name="price">
                                </div>
                                <div class="form-inp">
                                    <label for="category">Category</label>
                                    <input type="text" id="category" value="{{ $p->category }}" name="category">
                                </div>
                                <div class="form-inp">
                                    <label for="ingredient">ingredient</label>
                                    <input type="text" id="ingredient" value="{{ $p->ingredient }}" name="ingredient">
                                </div>
                                <div class="form-inp">
                                    <label for="skin_type">skin_type</label>
                                    <input type="text" id="skin_type" value="{{ $p->skin_type }}" name="skin_type">
                                </div>
                                <div class="form-inp">
                                    <label for="skin_concerns">skin_concerns</label>
                                    <input type="text" id="skin_concerns" value="{{ $p->skin_concerns }}" name="skin_concerns">
                                </div>
                                <button id="submit-button" type="submit" name="id" value="{{ $p->id }}" class="mb-3">Edit</button>
                                <button id="cancel-button" type="button" onclick="toggleForm2('{{$p->id}}')">Cancel</button>
                            </form>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
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
            // Kiểm tra mỗi container2
            const containers = document.querySelectorAll('.controForm .containerForm2');

            containers.forEach(container => {
                // Tìm id tương ứng từ id container2
                const id = container.id.split('-')[1];

                // Kiểm tra xem container2 có lớp d-none hay không
                const isHidden = container.classList.contains('d-none');

                // Áp dụng trạng thái cho controForm
                toggleControForm(id, isHidden);
            });
        });

        function toggleForm2(id) {
            const container2 = document.getElementById(`container2-${id}`);
            const controForm = document.querySelector(`.controForm #container2-${id} .containerForm2`);

            if (container2.classList.contains('d-none')) {
                container2.classList.remove('d-none');
            } else {
                container2.classList.add('d-none');
            }

            // Lấy trạng thái mới của container2 sau khi thay đổi
            const isHidden = container2.classList.contains('d-none');

            // Áp dụng trạng thái cho controForm
            toggleControForm(id, isHidden);
        }

        function toggleControForm(id, isHidden) {
            const controForm = document.querySelector(`.controForm #controForm-${id}`);

            if (isHidden) {
                controForm.classList.add('d-none');
            } else {
                controForm.classList.remove('d-none');
            }
        }
    </script>


    @endsection