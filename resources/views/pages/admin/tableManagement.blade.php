@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="/assets/css/userManagement.css">
    <link rel="stylesheet" href="/assets/css/moretable.css">
@endsection

@section('content')
    <script>
        function toggleForm() {
            var form = document.getElementById("container");
            form.classList.toggle("d-none");
            form.classList.toggle("d-flex");
        }
        document.addEventListener('DOMContentLoaded', function() {
            const containers = document.querySelectorAll('.controForm .containerForm2');
            containers.forEach(container => 
            {
                const id = container.id.split('-')[1];
                const isHidden = container.classList.contains('d-none');
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
            const isHidden = container2.classList.contains('d-none');
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
    <br>
    <center>
        <a type="button" class="btn btn-rounder" id="linkPage" href="?table=applied-voucher">Table: Applied Voucher</a>
        <a type="button" class="btn btn-rounder" id="linkPage" href="?table=orders">Table: Orders</a>
        <a type="button" class="btn btn-rounder" id="linkPage" href="?table=order_details">Table: Order_details</a>
        <a type="button" class="btn btn-rounder" id="linkPage" href="?table=payment_history">Table: Payment_history</a>
    </center>
    @if(request()->query('table') === 'applied-voucher')
    <button id="showForm1" class="Btn" onclick="toggleForm()">
        <div class="sign">+</div>
        <div id="showForm" class="text">NEW</div>
    </button>
    <div id="container" class="d-none">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <form class="" action="/admin/more-table/voucher-management-applied-create" id="formUser" method="post">
                    @csrf
                    @method('post')
                    <div class="form-inp">
                        <label for="product_id">Product ID:</label>
                        <select id="product_id" name="product_id" required>
                            <option value="" disabled selected>Select a product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }} id {{ $product->id }}</option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                    <div class="form-inp">
                        <label for="vourcher_id">Voucher ID:</label>
                        <select id="vourcher_id" name="vourcher_id" required>
                            <option value="" disabled selected>Select a voucher</option>
                            @foreach($vouchers as $v)
                                <option value="{{ $v->id }}">{{ $v->id }}</option>
                            @endforeach
                        </select>
                        <br>
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
            <h3>ApplyVoucher Table<hr></h3>
        </div>
        <table id="productTable">
            <thead id="row1">
                <tr>
                    <th>ID</th>
                    <th>Product ID</th>
                    <th>Voucher ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appliedVouchers as $v)
                    @php $a=$v->id @endphp
                    <form action="/admin/more-table/voucher-management-applied-update/{{$v->id}}" method="post">
                        @csrf
                        @method('PUT')
                        <tr id="row_{{ $v->id }}">
                            <td>{{$v->id}}</td>
                            <td>
                                <select id="product_id" name="product_id" value="" required>
                                    <option value="{{ $v->product_id }}" >{{ $v->product_id }}</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->id }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select id="vourcher_id" name="vourcher_id" value="" required>
                                    <option value="{{ $v->vourcher_id }}">{{ $v->vourcher_id }}</option>
                                    @foreach($vouchers as $v)
                                        <option value="{{ $v->id }}">{{ $v->id }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                            <button type="submit">Update</button>
                        </form> 
                            <form action="/admin/more-table/voucher-management-applied-delete/{{$a}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit">Delete</button>
                            </form>
                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>    
    @elseif(request()->query('table') === 'orders')
        <button id="showForm1" class="Btn" onclick="toggleForm()">
            <div class="sign">+</div>
            <div id="showForm" class="text">NEW</div>
        </button>
        <div id="container" class="d-none">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <form class="" action="/admin/more-table/order-management-create" id="formUser" method="post">
                        @csrf
                        @method('post')
                            <div class="form-inp">
                                <label for="user_id">User ID:</label>
                                <select id="user_id" name="user_id" value="" required>
                                    @foreach($users as $u)
                                        <option value="{{ $u->id }}">{{ $u->id }}</option>
                                    @endforeach
                                </select>
                                <br>
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
                <h3>Orders Table<hr></h3>
            </div>
            <table id="productTable">
                <thead id="row1">
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Date</th>
                        <th>Updated_at</th>
                        <th>Created_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $o)
                        @php $a=$o->id @endphp
                        <form action="/admin/more-table/order-management-update/{{$o->id}}" method="post">
                            @csrf
                            @method('PUT')
                            <tr id="row_{{ $o->id }}">
                                <td>{{$o->id}}</td>
                                <td>
                                    <select id="user_id" name="user_id" value="" required>
                                        <option value="{{ $o->user_id }}" >{{ $o->user_id }}</option>
                                        @foreach($users as $u)
                                            <option value="{{ $u->id }}">{{ $u->id }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>{{$o->date}} </td>
                                <td>{{$o->updated_at}} </td>
                                <td>{{$o->created_at}} </td>
                                <td>
                                <button type="submit">Update</button>
                            </form> 
                                <form action="/admin/more-table/order-management-delete/{{$a}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit">Delete</button>
                                </form>
                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  

    @elseif(request()->query('table') === 'order_details')
        <button id="showForm1" class="Btn" onclick="toggleForm()">
            <div class="sign">+</div>
            <div id="showForm" class="text">NEW</div>
        </button>
        <div id="container" class="d-none">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <form class="" action="/admin/more-table/order-detail-management-create" id="formUser" method="post">
                        @csrf
                        @method('post')
                            <div class="form-inp">
                                <label for="order_id">Order ID:</label>
                                <select id="order_id" name="order_id" value="" required>
                                    <option value="" disabled selected>Select a Order ID</option>
                                    @foreach($orders as $o)
                                        <option value="{{ $o->id }}">{{ $o->id }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="form-inp">
                                <label for="product_id">Product ID:</label>
                                <select id="product_id" name="product_id" value="" required>
                                    <option value="" disabled selected>Select a Product ID</option>
                                    @foreach($products as $p)
                                        <option value="{{ $p->id }}">{{ $p->id }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="form-inp">
                                <label for="quanity">Quantity:</label>
                                <input type="number" name="quanity" id="quanity" value="" placeholder="Enter the product quantity">
                                <br>
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
                <h3>Orders Detail Table<hr></h3>
            </div>
            <table id="productTable">
                <thead id="row1">
                    <tr>
                        <th>ID</th>
                        <th>Order ID</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Updated_at</th>
                        <th>Created_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderDetails as $od)
                        @php 
                            $a=$od->id ;
                            $b=$od->product_id;
                            $c=$od->quanity;
                        @endphp
                        <form action="/admin/more-table/order-detail-management-update/{{$a}}" method="post">
                            @csrf
                            @method('PUT')
                            <tr id="row_{{ $od->id }}">
                                <td>{{$od->id}}</td>
                                <td>
                                    <select id="order_id" name="order_id" >
                                        <option value="{{ $od->order_id }}" >{{ $od->order_id }} </option>
                                        @foreach($orders as $o)
                                            <option value="{{ $o->id }}">{{ $o->id }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select id="product_id" name="product_id">
                                        <option value="{{ $b }}" >{{ $b }} </option>
                                        @foreach($products as $p)
                                            <option value="{{ $p->id }}">{{ $p->id }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="quanity" value="{{$c}}">
                                </td>
                                <td>{{$o->updated_at}} </td>
                                <td>{{$o->created_at}} </td>
                                <td>
                                <button type="submit">Update</button>
                            </form> 
                                <form action="/admin/more-table/order-detail-management-delete/{{$a}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit">Delete</button>
                                </form>
                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  
    @elseif(request()->query('table') === 'payment_history')
        <button id="showForm1" class="Btn" onclick="toggleForm()">
            <div class="sign">+</div>
            <div id="showForm" class="text">NEW</div>
        </button>
        <div id="container" class="d-none">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <form class="" action="/admin/more-table/payment-history-management-create" id="formUser" method="post">
                        @csrf
                        @method('post')
                            <div class="form-inp">
                                <label for="order_id">Order ID:</label>
                                <select id="order_id" name="order_id" value="" required>
                                    <option value="" disabled selected>Select a Order ID</option>
                                    @foreach($orders as $o)
                                        <option value="{{ $o->id }}">{{ $o->id }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="form-inp">
                                <label for="amount">Amount:</label>
                                <input type="number" name="amount" value="" placeholder="Enter the product amount">
                                <br>
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
                <h3>Payment History Table<hr></h3>
            </div>
            <table id="productTable">
                <thead id="row1">
                    <tr>
                        <th>Payment ID</th>
                        <th>Order ID</th>
                        <th>Amount</th>
                        <th>Updated_at</th>
                        <th>Created_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paymentHistory as $pay)
                        @php 
                            $pays=$pay->payment_id;
                            $b=$pay->order_id;
                            $c=$pay->amount
                        @endphp
                        <form action="/admin/more-table/payment-history-management-update/{{$pays}}" method="post">
                            @csrf
                            @method('PUT')
                            <tr id="row_{{ $pay->id }}">
                                <td>{{$pays}}</td>
                                <td>
                                    <select id="order_id" name="order_id" >
                                        <option value="{{ $b }}" > {{$b }} </option>
                                        @foreach($orders as $o)
                                            <option value="{{ $o->id }}">{{ $o->id }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="amount" value="{{$c}}">
                                </td>
                                <td>{{$pay->updated_at}} </td>
                                <td>{{$pay->created_at}} </td>
                                <td>
                                <button type="submit">Update</button>
                            </form> 
                                <form action="/admin/more-table/payment-history-management-delete/{{$pay}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit">Delete</button>
                                </form>
                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  
    @else
    <button id="showForm1" class="Btn" onclick="toggleForm()">
        <div class="sign">+</div>
        <div id="showForm" class="text">NEW</div>
    </button>
    <div id="container" class="d-none">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <form class="" action="/admin/more-table/voucher-management-applied-create" id="formUser" method="post">
                    @csrf
                    @method('post')
                    <div class="form-inp">
                        <label for="product_id">Product ID:</label>
                        <select id="product_id" name="product_id" required>
                            <option value="" disabled selected>Select a product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }} id {{ $product->id }}</option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                    <div class="form-inp">
                        <label for="vourcher_id">Voucher ID:</label>
                        <select id="vourcher_id" name="vourcher_id" required>
                            <option value="" disabled selected>Select a voucher</option>
                            @foreach($vouchers as $v)
                                <option value="{{ $v->id }}">{{ $v->id }}</option>
                            @endforeach
                        </select>
                        <br>
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
            <h3>ApplyVoucher Table<hr></h3>
        </div>
        <table id="productTable">
            <thead id="row1">
                <tr>
                    <th>ID</th>
                    <th>Product ID</th>
                    <th>Voucher ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appliedVouchers as $v)
                    @php $a=$v->id @endphp
                    <form action="/admin/more-table/voucher-management-applied-update/{{$v->id}}" method="post">
                        @csrf
                        @method('PUT')
                        <tr id="row_{{ $v->id }}">
                            <td>{{$v->id}}</td>
                            <td>
                                <select id="product_id" name="product_id" value="" required>
                                    <option value="{{ $v->product_id }}" >{{ $v->product_id }}</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->id }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select id="vourcher_id" name="vourcher_id" value="" required>
                                    <option value="{{ $v->vourcher_id }}">{{ $v->vourcher_id }}</option>
                                    @foreach($vouchers as $v)
                                        <option value="{{ $v->id }}">{{ $v->id }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                            <button type="submit">Update</button>
                        </form> 
                            <form action="/admin/more-table/voucher-management-applied-delete/{{$a}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit">Delete</button>
                            </form>
                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection