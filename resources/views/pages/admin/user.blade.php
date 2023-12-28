@extends('layouts.admin')
@section('content')

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
                    <button class="btn btn-remove" onclick="remove({{$p->id}})" id="removeBtn">Remove</button>
                    <button class="btn btn-edit" onclick="edit({{$p->id}})" id="editBtn">Edit</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection