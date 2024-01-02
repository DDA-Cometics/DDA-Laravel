@extends('layouts.main')
@section('title', 'Login_Register Page')

@section('css')
<link rel="stylesheet" href="/assets/css/login.css">
@endsection

@section('content')
@if(session('error'))
<center>
    <p>{{ session('error') }}</p>
</center>
@endif
<div class="container" id="containerLog">
    <div class="row">
        <div class="row">
            <a class="titleLog" href="/">Home ></a>
            <a class="titleLog" href="">Sign in &amp; Register</a>
        </div>

        <div class="row">
            <div class="column" id="log">
                <h2>Sign In</h2>
                <label>Required (*)</label>
                <!-- Form Login -->
                <form action="/login/login" method="post">
                    @csrf
                    <div>
                        <div class="form-group">
                            <input type="email" id="emailSignIn" name="email" placeholder="Email Address (*)" required>
                        </div>
                        <div class="form-group">
                            <input type="password" id="passwordSignIn" name="password" placeholder="Password (*)" required>
                        </div>
                        <div id="form-check">
                            <label>
                                <input id="check" type="checkbox" name="remember"> Accept terms
                            </label>
                            <a id="?forgot" href="?fogot">Forgot the password</a>
                        </div>
                        <button id="buttonn" type="submit">Sign In</button>
                        <div class="divider">
                            <hr class="left-line">
                            <span class="or-text">OR</span>
                            <hr class="right-line">
                        </div>
                        <h6 id="one-ck">Sign In With One Click</h6>
                        <p>Log in with your social media account</p>
                        <div class="row">
                            <div class="col"> <a href="https://www.facebook.com" target="_blank"><button id="button1">Facebook</button></a> </div>
                            <div class="col"> <a href="https://www.google.com" target="_blank"><button id="button2">Google</button></a> </div>
                        </div>
                        <p id="tex">When you use Facebook or Google to login to our site, be advised that your data is governed by Facebook’s or Google’s privacy policy and terms of use.</p>
                    </div>
                </form>
            </div>
            <div class="col">
            </div>
            <div class="column" id="log2">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <h2>Create Account</h2>

                <form action="/register/register" id="register" method="post">
                    @csrf
                    <br>
                    <div class="row">
                        <div class="col">
                            <!-- Form Register -->
                            <div class="form-group">
                                <input type="text" id="first_name" name="first_name" placeholder="First name (*)" required>
                                @if ($errors->has('first_name'))
                                <span class="error">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="email" id="emailSignUp" name="email" placeholder="Email Address (*)" required>
                                @if ($errors->has('email'))
                                <span class="error">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" id="passwordSignUp" name="password" placeholder="Password (*)" required>
                                @if ($errors->has('password'))
                                <span class="error">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" id="number" name="phone_number" placeholder="Phone number (*)" required>
                                @if ($errors->has('phone_number'))
                                <span class="error">{{ $errors->first('phone_number') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" id="image" name="image" placeholder="Image (*)" required>
                                @if ($errors->has('image'))
                                <span class="error">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" id="last_name" name="last_name" placeholder="Last name (*)" required>
                                @if ($errors->has('last_name'))
                                <span class="error">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="email" id="confirmEmail" name="confirm_email" placeholder="Confirm email (*)" required>
                                @if ($errors->has('confirm_email'))
                                <span class="error">{{ $errors->first('confirm_email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm password (*)" required>
                                @if ($errors->has('confirm_password'))
                                <span class="error">{{ $errors->first('confirm_password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" id="address" name="address" placeholder="Address (*)" required>
                                @if ($errors->has('address'))
                                <span class="error">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" id="account_name" name="account_name" placeholder="Account name (*)" required>
                                @if ($errors->has('account_name'))
                                <span class="error">{{ $errors->first('account_name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <p id="tex">Date of birth* <br>We want to wish you a happy birthday! When you provide your birthday, we will also use this information to personalize our marketing efforts</p>
                    </div>
                    <div class="row">
                        <input type="date" id="date" name="date" placeholder="date (*)" required>
                        @if ($errors->has('date'))
                        <span class="error">{{ $errors->first('date') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <button id="buttonn2" type="submit">Create an account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
@endsection