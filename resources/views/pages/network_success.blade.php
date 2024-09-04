@extends('layouts.app')

@section('title', 'Payment Canceled')

@section('content')
    <div class="main-cont">
        <div class="success-container">


    @if ($status == 'success')
        <div class="status-icon success"><img src="{{asset('images/success.png')}}" alt=""></div>
        <div class="status-message">Payment Successful!</div>
    @else
        <div class="status-icon error"><img src="{{asset('images/error.png')}}" alt=""></div>
        <div class="status-message">Payment Failed!</div>
    @endif
    <div class="transaction-details">
        <p><strong>Amount:</strong> {{$format_amt}}</p>
    </div>
    <div class="buttons">
        <a href="#" class="btn btn-continue">Continue Shopping</a>
        <!--<a href="/download-receipt" class="btn btn-receipt">Download Receipt</a>-->
    </div>
</div>
    </div>

@endsection

<style>
        .main-cont{
            width: 100%;
    display: flex;
    align-items: stretch;
    justify-content: center;
        }
        .success-container {
                background-color: #6247aa;
    background-image: linear-gradient(316deg, #6247aa 0%, #a594f9 74%);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
            margin-top:50px;
        }
         .status-icon {
            font-size: 70px;
            margin-bottom: 20px;
        }
        .success {
            mix-blend-mode: luminosity;
        }
        .error {
            mix-blend-mode: multiply;
        }
        .status-message {
            font-size: 24px;
            margin-bottom: 20px;
            color: #eefdfb;
        }
        .success-icon {
            font-size: 70px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .success-message {
            font-size: 24px;
            margin-bottom: 20px;
            color: #eefdfb;
        }
        .transaction-details {
            font-size: 18px;
            margin-bottom: 10px;
            color: #fff;
        }
        .transaction-details strong {
            color: #333333;
        }
        .buttons {
            width:100%;
            margin-top: 30px;
        }
        .btn {
            background-color: #543ee9 !important;
            width:auto !important;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin: 0 10px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-continue {
            background-color: #28a745;
            color: white;
        }
        .btn-continue:hover {
            background-color: #218838;
        }
        .btn-receipt {
            background-color: #6c757d;
            color: white;
        }
        .btn-receipt:hover {
            background-color: #5a6268;
        }
        @media (max-width: 768px) {
        .success-container
        {
                max-width: 75%;
        }

        }
    </style>
