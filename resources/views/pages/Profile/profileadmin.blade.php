@extends('layouts.admin')
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
                <div class="col-md-4">
                    <div class="profile-card card mt-4">
                        <center><img src="{{ session('user_data')['image'] }}" alt="Profile Image"
                                class="img-fluid profile-image"></center>
                        <h2 class="text-center">{{ session('user_data')['last_name'] }}
                            {{ session('user_data')['first_name'] }}</h2>
                        <p class="text-center">{{ session('user_data')['email'] }}</p>
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
                        <form action="/edit-profile" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="editProfileImage">Profile Image</label>
                                <input type="file" class="form-control-file" id="editProfileImage"
                                    name="editProfileImage">
                            </div>
                            <div class="form-group">
                                <label for="editFullName">Full Name</label>
                                <input type="text" class="form-control" id="editFullName" name="editFullName"
                                    value="{{ session('user_data')['last_name'] }}.{{ session('user_data')['first_name'] }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="editPassword">Password</label>
                                <input type="password" class="form-control" id="editPassword" name="editPassword"
                                    placeholder="Enter password">
                            </div>
                            <div class="form-group">
                                <label for="editNewPassword">New Password</label>
                                <input type="password" class="form-control" id="editNewPassword" name="editNewPassword"
                                    placeholder="Enter new password">
                            </div>
                            <div class="form-group">
                                <label for="editConfirmPassword">Confirm New Password</label>
                                <input type="password" class="form-control" id="editConfirmPassword"
                                    name="editConfirmPassword" placeholder="Confirm new password">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <button type="submit" class="btn btn-save btn-block">Save</button>
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
        </div>
    @else
        <p class="error-message">No user data available!</p>
    @endif
@endsection
