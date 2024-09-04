@extends('layouts.app')

@section('title', 'Welcome to EDINNO')
<link rel="stylesheet" href="{{ asset('style/profile.css') }}">
<link rel="stylesheet" href="{{ asset('style/card.css') }}">
<link rel="stylesheet" href="{{ asset('style/package.css') }}">
<link rel="stylesheet" href="{{ asset('style/access.css') }}">
@section('content')
<div class="container">
    <div class="profile">
       <div class="section-content">
        <h1 class="title">Welcome to FJ Education</h1>
        <div class="profile-tabs">
            <a href="{{url('profile')}}" class="tab">Personal</a>
            <a href="{{url('packages')}}" class="tab">Packages</a>
            <a href="{{url('access')}}"  class="router-link-active router-link-exact-active active">Access</a>
        </div>

        <div class="product-block vertical">
            @if($books->isEmpty() && $videos->isEmpty())
                <p class="not-found">No contents found yet.</p>
            @else
                @foreach($books as $book)
                    <div class="product-item">
                        <span class="badge">E-book</span>
                        <img class="product-img" src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }} Book Cover">
                        <div class="product-title">{{ $book->title }}</div>
                        <div class="product-about">{{ $book->description }}</div>
                        <a href="{{ asset('storage/' . $book->file) }}" target="_blank" class="product-buy-access">Start learning</a>
                    </div>
                @endforeach

                @foreach($videos as $video)
                    <div class="product-item">
                        <span class="badge">Video</span>
                        <img class="product-img" src="{{ asset('storage/' . $video->cover) }}" alt="{{ $video->title }} Book Cover">
                        <div class="product-title">{{ $video->title }}</div>
                        <div class="product-about">{{ $video->description }}</div>
                        <a href="{{ asset('storage/' . $video->file) }}" target="_blank" class="product-buy-access">Start learning</a>
                    </div>
                @endforeach
            @endif
        </div>


    </div>

</div>


@endsection
