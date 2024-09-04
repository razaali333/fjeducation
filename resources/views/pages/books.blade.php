@extends('layouts.app')

@section('title', 'Welcome to EDINNO')
<link rel="stylesheet" href="{{ asset('style/card.css') }}">
@section('content')
<section class="market-research">
    <!-- Loading Spinner (Initially Hidden) -->
<div id="loading" style="display: none">
    <img src="{{ asset('images/loading.gif') }}" alt="Loading...">
</div>

    <h2>Book content</h2>
    <p>In our catalog you will find literature covering a wide range of strategies and approaches to investing, ranging from basic concepts to more complex analytical methods. These books will become a reliable guide in the world of financial solutions, helping to develop skills for successful investment management.</p>
</section>
<div class="row">
    @foreach($books as $book)
    <div class="card">
        <div class="card-image">
            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }} Book Cover">
        </div>
        <div class="card-content">
            <h2 class="card-title">{{ $book->title }}</h2>
            <p class="card-description">
                {{ $book->description }}
            </p>
            @if(Auth::check())
            <!-- AJAX call to create a pay link -->
            <a href="javascript:void(0);" class="card-button create-pay-link"  data-book-id="{{ $book->id }}">Get this item</a>
        @else
            <!-- Show login modal if not authenticated -->
            <a href="javascript:void(0);"  id="account-link" class="card-button account-link">Get this item</a>
        @endif
        </div>
    </div>
@endforeach


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
            var bookId = this.getAttribute('data-book-id');

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
                    book_id: bookId
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
