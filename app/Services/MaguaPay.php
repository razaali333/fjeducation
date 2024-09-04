<?php

namespace App\Services;

use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Http;

class MaguaPay
{
    private const string BASIC_URL = 'https://api-gateway.magua-pay.com';
    private Transaction $transaction;
    private array $header = [];
    private array $data = [];
    private string $method;

    /**
     * @throws Exception
     */
    function __construct()
    {
        if (empty(config('magua.key')) || empty(config('magua.secret'))) {
            throw new Exception('Variables not set');
        }

        $this->header = [
            'Authorization' => 'Basic ' . base64_encode(config('magua.key') . ':' . config('magua.secret'))
        ];
    }

    public function setTransaction(Transaction $transaction): MaguaPay
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function preparePayment(): static
    {
        if (empty($this->transaction)) {
            throw new Exception('No transaction was set.');
        }

        $this->method = 'initPayment';

        $this->data = [
            "account" => "USD-sandbox",
            "order_id" => $this->transaction->id,
            "amount" => $this->transaction->amount,
            "currency" => "USD",
            "recurrent" => false,
            "merchant_site" => config('app.url'),
            "purpose" => "Some description",
            "customer_first_name" => $this->transaction->user->name,
            "customer_last_name" => $this->transaction->user->name,
            "customer_address" => '---',
            "customer_city" => '---',
            "customer_zip_code" => '---',
            "customer_country" => '---',
            "customer_phone" => '---',
            "customer_email" => $this->transaction->user->email,
            "customer_ip_address" => $this->transaction->ip,
            "success_url" => config('app.front_url') . '/success-payment',
            "fail_url" => config('app.front_url') . '/fail-payment',
            "callback_url" => route('payments.callback'),
            "status_url" => route('payments.check')
        ];

        return $this;
    }

    /**
     * @throws Exception
     */
    public function prepareRefund(): static
    {
        if (empty($this->transaction)) {
            throw new Exception('No transaction was set.');
        }

        $this->method = 'refund';

        $this->data = [
            'order_id' => $this->transaction->id,
            'amount' => $this->transaction->amount,
            'reason' => 'Refund',
            'callback_url' => route('payments.callback'),
        ];

        return $this;
    }

    /**
     * @throws Exception
     */
    public function send()
    {
        if (empty($this->data) || empty($this->header)) {
            throw new Exception('No data was set.');
        }

        $response = Http::withHeaders($this->header)->post(self::BASIC_URL . '/' . $this->method, $this->data);

        return json_decode($response->body());
    }
}
