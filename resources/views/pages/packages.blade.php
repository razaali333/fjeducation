@extends('layouts.app')

@section('title', 'Welcome to EDINNO')
<link rel="stylesheet" href="{{ asset('style/profile.css') }}">
<link rel="stylesheet" href="{{ asset('style/card.css') }}">
<link rel="stylesheet" href="{{ asset('style/package.css') }}">
@section('content')
<div class="container">
        <!-- Loading Spinner (Initially Hidden) -->
<div id="loading" style="display: none">
    <img src="{{ asset('images/loading.gif') }}" alt="Loading...">
</div>
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
                <button class="package-buy create-pay-link" data-package-id="{{$package->id}}">Buy package</button>
            @endif
            </div>
            @endforeach

            </div>
    </div>

</div>


@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // console.log('Script loaded');
        const loadingElement = document.getElementById('loading');

    // Handle click for logged-in users to create pay link
    document.querySelectorAll('.create-pay-link').forEach(function (element) {
        // alert()
        element.addEventListener('click', function () {
            var packageId = this.getAttribute('data-package-id');

            // Show the loading GIF
            loadingElement.style.display = 'block';
            // AJAX call to create a pay link
            fetch('/create-pay-link', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    package_id: packageId,
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect to payment URL or do something else
                    // console.log()
                    window.location.href = data.url;
                } else {
                    // Hide the loading GIF if there's an error
                    loadingElement.style.display = 'none';
                    console.error('Error:', data.message);
                }
            })
            .catch(error => {
                // Hide the loading GIF if there's an error
                loadingElement.style.display = 'none';
                console.error('Error:', error);
            });
        });
    });


});

</script>
@endsection
