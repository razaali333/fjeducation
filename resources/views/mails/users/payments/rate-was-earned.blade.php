@php
    /** @var \App\Models\Transaction $transaction */
@endphp

<html lang="en">
<head>
    <style>
        table {
            border-collapse: collapse;
        }

        table td {
            border: 1px solid black;
        }
    </style>
    <title></title>
</head>
<body>
<div>
    <div>Hello! Thanks for your order. Here is some details about your oder:</div>
    <div>
        <table>
            <tr>
                <td>Order ID</td>
                <td>{{ $transaction->id }}</td>
            </tr>
            <tr>
                <td>Selected tariff</td>
                <td>{{ $transaction->rate->title }}</td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>{{ $transaction->amount }} {{ $transaction->currency_label }}</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>{{ $transaction->created_at }}</td>
            </tr>
        </table>
    </div>
    <div><a href="https://fjeducation.com/profile/access">Click this link to start education</a></div>
    <div>
        <p>We wish you good luck!</p>
        <p>If you will have any questions just write us to <a href="mailto:info@fjeducation.com">info@fjeducation.com</a></p>
    </div>
</div>
</body>
</html>
