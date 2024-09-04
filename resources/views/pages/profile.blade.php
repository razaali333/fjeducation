@extends('layouts.app')

@section('title', 'Welcome to EDINNO')
<link rel="stylesheet" href="{{ asset('style/profile.css') }}">
<link rel="stylesheet" href="{{ asset('style/card.css') }}">
@section('content')
<div class="container">
    <div class="profile">
       <div class="section-content">
        <h1 class="title">Welcome to FJ Education</h1>
        <div class="profile-tabs">
           <a href="{{url('profile')}}" class="router-link-active router-link-exact-active active">Personal</a>
            <a href="{{url('packages')}}" class="tab">Packages</a>
            <a href="{{url('access')}}" class="tab">Access</a>
        </div>
        <div class="section-content personal">
            <div class="m-form">
                <div class="profile-title">My profile</div>
                <div class="form-item">
                        <label for="first-name">Your first name</label>
                        <div class="input-group">
                            <img src="{{asset('images/name.png')}}" alt="Name Icon" class="input-icon">
                            <input type="text" value="{{ $firstName }}" id="first-name" >
                        </div>
                </div>
                <div class="form-item">
                        <label for="first-name">Your last name</label>
                        <div class="input-group">
                            <img src="{{asset('images/name.png')}}" alt="Name Icon" class="input-icon">
                            <input type="text" value="{{ $lastName }}" id="first-name" >
                        </div>
                </div>
                <div class="form-item">
                        <label for="first-name">Emali</label>
                        <div class="input-group">
                            <img src="{{asset('images/email.png')}}" alt="Name Icon" class="input-icon">
                            <input type="text" value="{{ $user->email }}" id="first-name">
                        </div>
                </div>
                <div class="form-item">
                        <label for="first-name">Phone Number</label>
                        <div class="input-group">
                            <img src="{{asset('images/phone.png')}}" alt="Name Icon" class="input-icon">
                            <input type="text"  value="{{ $user->phone }}"  id="first-name" >
                        </div>
                </div>
                <div class="form-item">
                        <label for="first-name">Passowrd</label>
                        <div class="input-group">
                            <img src="{{asset('images/lock.png')}}" alt="Name Icon" class="input-icon">
                            <input type="text"   id="first-name" placeholder="*********">
                        </div>
                </div>
                <button class="m-action">Save</button>
            </div>

        </div>
    </div>

</div>


@endsection
