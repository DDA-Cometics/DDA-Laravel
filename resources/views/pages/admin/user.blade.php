@extends('layouts.admin')

@section('css')
  <link rel="stylesheet" href="/assets/css/userManagement.css">
@endsection

@section('content')
<script>
    function toggleForm() {
        var form = document.getElementById("container");
        form.classList.toggle("d-none");
        form.classList.toggle("d-flex");
    }
    function toggleForm2() {
        var form = document.getElementById("container2");
        form.classList.toggle("d-none");
        form.classList.toggle("d-flex");
    }
</script>
<button id="showForm1" class="Btn" onclick="toggleForm()">
    <div class="sign">+</div>
    <div id="showForm" class="text">Create</div>
</button>
<div class="d-none" id="container">
<form action="/userManagement/create" method="POST" id="formUser" class="">
    @csrf
    <div class="form-inp">
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name">
    </div>
    <div class="form-inp">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name">
    </div>
    <div class="form-inp">
        <label for="account_name">Account Name:</label>
        <input type="text" id="account_name" name="account_name">
    </div>
    <div class="form-inp">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
    </div>
    <div class="form-inp">
        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    
    <div class="form-inp">
        <label for="address">Address:</label>
        <input type="text" id="address" name="address">
    </div>
    <div class="form-inp">
        <label for="phone_number">Phone Numbers:</label>
        <input type="tel" id="phone_number" name="phone_number">
    </div>
    <div class="form-inp">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
    </div>
    <div class="form-inp">
        <label for="date">BirthDay:</label>
        <input type="date" id="date" name="date">
    </div>
    <div class="form-inp">
        <label for="image">Image:</label>
        <input type="text" id="image" name="image">
    </div>

    <button id="submit-button" type="submit" class="mb-3">Create</button>
    <button id="cancel-button" type="button" onclick="toggleForm()">Cancel</button>
</form>
</div>
<table id="user Table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Account Name</th>
            <th>Password</th>
            <th>Role</th>
            <th>Address</th>
            <th>Phone Numbers</th>
            <th>Email</th>
            <th>BirthDay</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Table rows will be inserted here using JavaScript -->
        @foreach ($users as $p )
            <tr>
                <td>{{$p->id}}</td>
                <td><img src="{{$p->image}}" alt="user Image" style="max-width: 100px; max-height: 100px;"></td>
                <td>{{$p->last_name}}</td>
                <td>{{$p->first_name}}</td>
                <td>{{$p->account_name}}</td>
                <td>{{$p->password}}</td>
                <td>{{$p->role}}</td>
                <td>{{$p->address}}</td>
                <td>{{$p->phone_number}}</td>
                <td>{{$p->email}}</td>
                <td>{{$p->date}}</td>
                <td>
                    <form action="/userManagement/delete" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-remove"
                                name="id" value="{{$p->id}}" id="removeBtn">
                                Remove
                        </button>
                    </form>
                    <button class="btn btn-edit" name="id" value="{{$p->id}}" id="editBtn" onclick="toggleForm2()">Edit</button>
                </td>
            </tr>
            <div class="d-none" id="container2">
                <form action="/userManagement/update" method="POST" id="formUser2" class="">
                    @csrf
                    @method('PUT')
                    <div class="form-inp">
                        <label for="last_name">Last Name:</label>
                        <input type="text" id="last_name" value="{{$p->last_name}}" name="last_name">
                    </div>
                    <div class="form-inp">
                        <label for="first_name">First Name:</label>
                        <input type="text" id="first_name" value="{{$p->first_name}}" name="first_name">
                    </div>
                    <div class="form-inp">
                        <label for="account_name">Account Name:</label>
                        <input type="text" id="account_name"  value="{{$p->account_name}}" name="account_name">
                    </div>
                    <div class="form-inp">
                        <label for="password">Password:</label>
                        <input type="password" id="password"  value="{{$p->password}}" name="password">
                    </div>
                    <div class="form-inp">
                        <label for="role">Role:</label>
                        <select id="role" name="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    
                    <div class="form-inp">
                        <label for="address">Address:</label>
                        <input type="text" id="address" value="{{$p->address}}" name="address">
                    </div>
                    <div class="form-inp">
                        <label for="phone_number">Phone Numbers:</label>
                        <input type="tel" id="phone_number" value="{{$p->phone_number}}" name="phone_number">
                    </div>
                    <div class="form-inp">
                        <label for="email">Email:</label>
                        <input type="email" id="email" value="{{$p->email}}" name="email">
                    </div>
                    <div class="form-inp">
                        <label for="date">BirthDay:</label>
                        <input type="date" id="date" value="{{$p->date}}" name="date">
                    </div>
                    <div class="form-inp">
                        <label for="image">Image:</label>
                        <input type="text" id="image" value="{{$p->image}}" name="image">
                    </div>
                
                    <button id="submit-button" type="submit" name="id" value="{{$p->id}}" class="mb-3">Update</button>
                    <button id="cancel-button" type="button" onclick="toggleForm2()">Cancel</button>
                </form>
            </div>
        @endforeach
    </tbody>
</table>
@endsection