@extends('layouts.app')

@section('title', 'Welcome to EDINNO')
<link rel="stylesheet" href="{{ asset('style/profile.css') }}">
<link rel="stylesheet" href="{{ asset('style/card.css') }}">
<link rel="stylesheet" href="{{ asset('style/package.css') }}">
@section('content')
<div class="container">
    <div class="profile">
       <div class="section-content">
        <h1 class="title">Welcome to FJ Education</h1>
        <div class="profile-tabs">
            <a href="{{url('profile')}}" class="tab">Personal</a>
            <a href="{{url('packages')}}" class="router-link-active router-link-exact-active active">Packages</a>
            <a href="{{url('access')}}" class="tab">Access</a>
        </div>
        <div class="package-block">
            @foreach($packages as $package)
            <div class="package-item">
                <div class="package-title">{{ $package->title}}</div>
                <div class="package-body">{{ $package->description}}</div>
                <div class="package-access"></div><div class="package-price">{{ $package->price}} {{ $package->currency_label}}</div>
                @php
                // Check if the user has purchased this package
                $purchased = $user->transactions()->where('rate_id', $package->id)->exists();
            @endphp

            @if($purchased)
                <button class="package-buy-d" disabled>Already purchased</button>
            @else
                <button class="package-buy">Buy package</button>
            @endif
            </div>
            @endforeach

            </div>
    </div>

</div>


@endsection
