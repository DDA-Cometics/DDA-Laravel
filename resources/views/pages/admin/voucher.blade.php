@extends('layouts.admin')
@section('content')

<table id="voucher Table">
    <thead>
        <tr>
            <th>ID</th>
            <th>description</th>
            <th>discount</th>
            <th>active_datetime</th>
            <th>expired_datetime</th>
            <th>deleted_at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Table rows will be inserted here using JavaScript -->
        @foreach ($vouchers as $p )
            <tr>
                <td>{{$p->id}}</td>
                <td>{{$p->description}}</td>
                <td>{{$p->discount}}</td>
                <td>{{$p->active_datetime}}</td>
                <td>{{$p->expired_datetime}}</td>
                <td>{{$p->deleted_at}}</td>
                <td>
                    <button class="btn btn-remove" onclick="removeProduct({{$p->id}})" id="removeBtn">Remove</button>
                    <button class="btn btn-edit" onclick="editProduct({{$p->id}})" id="editBtn">Edit</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection