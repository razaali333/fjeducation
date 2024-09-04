@extends('layouts.app')

@section('title', 'Welcome to EDINNO')
<link rel="stylesheet" href="{{ asset('style/card.css') }}">
@section('content')
<section class="market-research">
    <h2>Video content</h2>
    <p>In this collection of training videos, you will find fascinating resources, providing a clear understanding of the technical aspects of blockchain technologies. In addition, the catalog includes extensive materials on technical analysis, helping to develop skills in market analysis and making informed decisions in the field of finance.</p>
</section>
<div class="row">
    @foreach($videos as $video)
    <div class="card">
        <div class="card-image">
            <img src="{{ asset('storage/' . $video->cover) }}" alt="{{ $video->title }}  Cover">
        </div>
        <div class="card-content">
            <h2 class="card-title">{{ $video->title }}</h2>
            <p class="card-description">
                {{ $video->description }}
            </p>
            @if(Auth::check())
            <!-- AJAX call to create a pay link -->
            <a href="javascript:void(0);" class="card-button create-pay-link"  data-video-id="{{ $video->id }}">Get this item</a>
        @else
            <!-- Show login modal if not authenticated -->
            <a href="javascript:void(0);"  id="account-link" class="card-button account-link">Get this item</a>
        @endif
            {{-- <a href="#" class="card-button">Get this item</a> --}}
        </div>
    </div>
    @endforeach
</div>

@endsection
