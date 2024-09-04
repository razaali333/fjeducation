@extends('layouts.app')

@section('title', 'Payment Canceled')

@section('content')
<div class="payment-cancel-container">
    <div class="cancel-message">
        <img src="{{ asset('images/cancel.png') }}" alt="Cancel Icon" class="cancel-icon">

        <h1>Payment Canceled</h1>
        <p>We're sorry, but your payment has been canceled. If this was a mistake, you can try again.</p>
        <a href="{{ url('/') }}" class="button">Return to Home</a>
        <a href="{{ url('/books') }}" class="button">View More Books</a>
    </div>
</div>
@endsection

<style>
       .payment-cancel-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80vh;
        text-align: center;
    }

    .cancel-message {
        max-width: 500px;
        background-color: #fff;
        padding: 40px;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h1 {
        color: #ff4d4d;
        font-size: 36px;
        margin-bottom: 20px;
    }

    p {
        font-size: 18px;
        margin-bottom: 30px;
    }

    .button {
        display: inline-block;
        padding: 12px 24px;
        background-color: #00c4cc;
        color: #fff;
        border-radius: 4px;
        text-decoration: none;
        margin: 0 10px;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #009da2;
    }
    @media (max-width: 768px) {
        .payment-cancel-container{
            max-width: 90%;
            margin: auto;
        }
        .button{
            margin-top:10px;
        }
    }
</style>
