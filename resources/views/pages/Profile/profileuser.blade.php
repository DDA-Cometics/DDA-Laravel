@extends('layouts.main')
@section('title', '♥Profile♥')
@section('css')
    <link rel="stylesheet" href="/assets/css/profileUser.css">
@endsection
@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editButton = document.getElementById('editButton');
            var profileForm = document.getElementById('profileForm');
            var editProfileForm = document.getElementById('editProfileForm');
            var cancelButton = document.getElementById('cancelButton');
            editButton.addEventListener('click', function() {
                profileForm.style.display = 'none';
                editProfileForm.style.display = 'block';
            });
            cancelButton.addEventListener('click', function() {
                profileForm.style.display = 'block';
                editProfileForm.style.display = 'none';
            });
        });
    </script>
    @if (session()->has('user_data'))
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4" id="newProfile">
                    <div class="profile-card card mt-4">
                        <center><img src="{{ session('user_data')['image'] }}" alt="Profile Image"
                                class="img-fluid profile-image"></center>
                        <h2 class="text-center">{{ session('user_data')['last_name'] }}
                            {{ session('user_data')['first_name'] }}</h2>
                        <div class="text-center">
                            <button type="button" id="editButton" class="btn btn-edit">Edit Profile</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="profile-info card mt-4" id="profileForm">
                        <h2 class="text-center mb-4">USER INFORMATION</h2>
                        <div class="user-info">
                            <p><strong>Email:</strong> {{ session('user_data')['email'] }}</p>
                            <p><strong>Last Name:</strong> {{ session('user_data')['last_name'] }}</p>
                            <p><strong>First Name:</strong> {{ session('user_data')['first_name'] }}</p>
                            <p><strong>User ID:</strong> {{ session('user_data')['id'] }}</p>
                            <p><strong>User Phone:</strong> {{ session('user_data')['user_phone'] }}</p>
                            <p><strong>Account Name:</strong> {{ session('user_data')['account_name'] }}</p>
                            <p><strong>Address:</strong> {{ session('user_data')['address'] }}</p>
                            <p><strong>Role:</strong> {{ session('user_data')['role'] }}</p>
                        </div>
                    </div>
                    <div class="edit-profile-info card mt-4" id="editProfileForm" style="display: none;">
                        <h2 class="text-center mb-4">EDIT PROFILE</h2>
                        <form action="/edit-profile" method="post">
                            @csrf
                            @method('put')
                            <input class="d-none" type="text" name="id" value="{{ session('user_data')['id'] }}">
                            <div class="form-group">
                                <label for="editProfileImage">Profile Image</label>
                                <input type="file" class="form-control-file" id="editProfileImage"
                                    name="editProfileImage" value="{{ session('user_data')['image'] }}">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    value="{{ session('user_data')['last_name'] }}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    value="{{ session('user_data')['first_name'] }}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter password">
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    placeholder="Enter new password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirm_password"
                                    name="confirm_password" placeholder="Confirm new password">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <button type="submit" class="btn btn-save btn-block" id="saveButton">Save</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-cancel btn-block"
                                        id="cancelButton">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><br>  
    @else
        @php
            return redirect('/login');
        @endphp
    @endif
@endsection
