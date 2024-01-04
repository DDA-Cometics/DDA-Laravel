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
{{-- ...................... --}}
<div class="d-none" id="container">
    <div class="row ">
        <div class="col"></div>
        <div class="col">
            <form action="/voucherManagement/create" method="POST" id="formUser" class="">
                @csrf
                <div class="form-inp">
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description">
                    @if ($errors->has('description'))
                        <span class="error">{{ $errors->first('description') }}</span>
                        @endif
                </div>
                <div class="form-inp">
                    <label for="discount">Disccount:</label>
                    <input type="number" id="discount" name="discount">
                    @if ($errors->has('discount'))
                        <span class="error">{{ $errors->first('discount') }}</span>
                        @endif
                </div>
                <div class="form-inp">
                    <label for="active_datetime">Active Datetime:</label>
                    <input type="datetime-local" id="active_datetime" name="active_datetime">
                    @if ($errors->has('active_datetime'))
                        <span class="error">{{ $errors->first('active_datetime') }}</span>
                    @endif
                </div>
                <div class="form-inp">
                    <label for="expired_datetime">expired_datetime:</label>
                    <input type="datetime-local" id="expired_datetime" name="expired_datetime">
                    @if ($errors->has('expired_datetime'))
                        <span class="error">{{ $errors->first('expired_datetime') }}</span>
                        @endif
                </div>
            
                <button id="submit-button" type="submit" class="mb-3">Create</button>
                <button id="cancel-button" type="button" onclick="toggleForm()">Cancel</button>
            </form>
        </div>
        <div class="col"></div>
    </div>

</div>

{{-- ........................... --}}
<div class="context">
    <h3>LIST VOUCHER<hr ></h5>
</div>
<table id="voucher Table">
    <thead>
        <tr>
            <th>ID</th>
            <th>description</th>
            <th>discount</th>
            <th>active_datetime</th>
            <th>expired_datetime</th>
            <th>updated_at</th>
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
                <td>{{$p->updated_at}}</td>
                <td>
                    <form action="/voucherManagement/delete" method="POST">
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
                    <div class="col">

                    </div>
                    <div class="col">
                        <div  >
                            <div class="containerForm2 ">
                                <form action="/voucherManagement/update/{{$p->id}}"method="POST" id="formUser2" class="d-none">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-inp">
                                        <label for="description">Description:</label>
                                        <input type="text" id="description" value="{{ $p->description }}" name="description">
                                    </div>
                                    <div class="form-inp">
                                        <label for="discount">Discount:</label>
                                        <input type="text" id="discount" value="{{ $p->discount }}" name="discount">
                                    </div>
                                    <div class="form-inp">
                                        <label for="active_datetime">Active Datetime:</label>
                                        <input type="datetime-local" id="active_datetime" name="active_datetime">
                                        @if ($errors->has('active_datetime'))
                                            <span class="error">{{ $errors->first('active_datetime') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-inp">
                                        <label for="expired_datetime">expired_datetime:</label>
                                        <input type="datetime-local" id="expired_datetime" name="expired_datetime">
                                        @if ($errors->has('expired_datetime'))
                                            <span class="error">{{ $errors->first('expired_datetime') }}</span>
                                            @endif
                                    </div>
                                    
                                    <button id="submit-button" type="submit" name="id" value="{{ $p->id }}" class="mb-3">Update</button>
                                    <button id="cancel-button" type="button" onclick="toggleForm2('{{$p->id}}')">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                    </div>
                </div>  
            </div>  
        @endforeach
    </tbody>
</table>


@endsection