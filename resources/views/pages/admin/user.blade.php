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
        document.addEventListener('DOMContentLoaded', function () {
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
    <button id="showForm1" class="Btn" onclick="toggleForm()">
        <div class="sign">+</div>
        <div id="showForm" class="text">Create</div>
    </button>
<div class="d-none" id="container">
    <div class="row ">
        <div class="col"></div>
        <div class="col">
            <form action="/admin/user-management/create" method="POST" id="formUser" class="">
                @csrf
                <div class="form-inp">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name">
                    @if ($errors->has('last_name'))
                        <span class="error">{{ $errors->first('last_name') }}</span>
                    @endif
                </div>
                <div class="form-inp">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name">
                    @if ($errors->has('first_name'))
                        <span class="error">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
                <div class="form-inp">
                    <label for="account_name">Account Name:</label>
                    <input type="text" id="account_name" name="account_name">
                    @if ($errors->has('account_name'))
                        <span class="error">{{ $errors->first('account_name') }}</span>
                    @endif
                </div>
                <div class="form-inp" >
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                    @if ($errors->has('password'))
                        <span class="error">{{ $errors->first('password') }}</span>
                    @endif
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
                    @if ($errors->has('address'))
                        <span class="error">{{ $errors->first('address') }}</span>
                    @endif
                </div>
                <div class="form-inp">
                    <label for="phone_number">Phone Numbers:</label>
                    <input type="tel" id="phone_number" name="phone_number">
                    @if ($errors->has('phone_number'))
                        <span class="error">{{ $errors->first('phone_number') }}</span>
                    @endif
                </div>
                <div class="form-inp">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                    @if ($errors->has('email'))
                        <span class="error">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-inp">
                    <label for="date">BirthDay:</label>
                    <input type="date" id="date" name="date">
                    @if ($errors->has('date'))
                        <span class="error">{{ $errors->first('date') }}</span>
                    @endif
                </div>
                <div class="form-inp">
                    <label for="image">Image:</label>
                    <input type="text" id="image" name="image">
                    @if ($errors->has('image'))
                        <span class="error">{{ $errors->first('image') }}</span>
                    @endif
                </div>
                <button id="submit-button" type="submit" class="mb-3">Create</button>
                <button id="cancel-button" type="button" onclick="toggleForm()">Cancel</button>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>
<div class="table-wrapper">
    <div class="context">
        <h3>LIST USER<hr ></h3>
    </div>
    <table id="userTable">
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
            @foreach ($users as $p)
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
                        <form action="/admin/user-management/delete" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-remove" name="id" value="{{$p->id}}" id="removeBtn">
                                Remove
                            </button>
                        </form>
                        <button class="btn btn-edit" onclick="toggleForm2('{{$p->id}}')" id="editBtn">Edit</button>
                    </td>
                </tr>
                <div class="d-none" id="container2-{{$p->id}}" >
                    <div class="row " id="controForm">
                        <div class="col"> </div>
                        <div class="col">
                            <div  >
                                <div class="containerForm2 ">
                                    <form action="/admin/user-management/update/{{$p->id}}"method="POST" id="formUser2" class="d-none">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-inp">
                                            <label for="last_name">Last Name:</label>
                                            <input type="text" id="last_name" value="{{ $p->last_name }}" name="last_name">
                                        </div>
                                        <div class="form-inp">
                                            <label for="first_name">First Name:</label>
                                            <input type="text" id="first_name" value="{{ $p->first_name }}" name="first_name">
                                        </div>
                                        <div class="form-inp">
                                            <label for="account_name">Account Name:</label>
                                            <input type="text" id="account_name" value="{{ $p->account_name }}" name="account_name">
                                        </div>
                                        <div class="form-inp">
                                            <label for="password">Password:</label>
                                            <input type="password" id="password" value="{{ $p->password }}" name="password" readonly>
                                        </div>
                                        <div class="form-inp">
                                            <label for="role">Role:</label>
                                            <select id="roleEdit" name="role">
                                                <option value="user" @if($p->role == 'user') selected @endif>User</option>
                                                <option value="admin" @if($p->role == 'admin') selected @endif>Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-inp">
                                            <label for="address">Address:</label>
                                            <input type="text" id="address" value="{{ $p->address }}" name="address">
                                        </div>
                                        <div class="form-inp">
                                            <label for="phone_number">Phone Numbers:</label>
                                            <input type="tel" id="phone_number" value="{{ $p->phone_number }}" name="phone_number">
                                        </div>
                                        <div class="form-inp">
                                            <label for="email">Email:</label>
                                            <input type="email" id="email" value="{{ $p->email }}" name="email">
                                        </div>
                                        <div class="form-inp">
                                            <label for="date">BirthDay:</label>
                                            <input type="date" id="date" value="{{ $p->date }}" name="date">
                                        </div>
                                        <div class="form-inp">
                                            <label for="image">Image:</label>
                                            <input type="text" id="image" value="{{ $p->image }}" name="image">
                                        </div>
                                        <button id="submit-button" type="submit" name="id" value="{{ $p->id }}" class="mb-3">Update</button>
                                        <button id="cancel-button" type="button" onclick="toggleForm2('{{$p->id}}')">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col"></div>
                    </div>      
                </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection