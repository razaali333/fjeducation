<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SilkpayService
{
    protected $sid;
    protected $key_id;
    protected $url;

    public function __construct()
    {
        $this->sid = env('SILKPAY_SID');
        $this->key_id = env('SILKPAY_KEY_ID');
        $this->url = env('SILKPAY_URL');
    }

    public function generateSignature($cid, $timestamp)
    {
        // Chain format: sid|cid|timestamp|key_id
        $chain = $this->sid . '|' . $cid . '|' . $timestamp . '|' . $this->key_id;

        // Calculate the SHA-1 hash
        return sha1($chain);
    }

    public function createPayByLink($amount, $currency)
    {
        // Generate a 32-character random CID
        $cid = bin2hex(random_bytes(16));
        // Current timestamp
        $timestamp = time();
        // Generate the signature
        $signature = $this->generateSignature($cid, $timestamp);

        // Data to be sent to Silkpay
        $data = [
            'signature' => $signature,
            'uid' => 2001,
            'sid' => $this->sid,
            'timestamp' => $timestamp,
            'cid' => $cid,
            'amount' => $amount,
            'currency' => $currency,
            'url_ok' => 'http://127.0.0.1:8000/success_silk',
            'cancel_url' => 'http://127.0.0.1:8000/cancel_silk',
            'notify_url' => 'http://127.0.0.1:8000/notify_silk',
            'mail' => 'raza@gmail.com',
            'phone' => '123456789',
            'street' => '123456789',
            'postal_code' => '00000',
            'city' => 'New York',
            'country' => 'US',
            'lastname' => 'raza',
            'firstname' => 'ali',
            'ip' => request()->ip(), // Use the user's real IP address
        ];

        try {
            // Log request data for debugging
            Log::info('Sending request to Silkpay:', $data);

            // Make the HTTP POST request to Silkpay
            $response = Http::asForm()->post($this->url, $data);
            dd($response->json());
            // Check if the response was successful
            if ($response->successful()) {
                // Decode the response body
                $responseData = $response->json();

                // Log the response for debugging
                Log::info('Received response from Silkpay:', $responseData);

                // Check for the redirect URL in the response data
                if (isset($responseData['redirect_url'])) {
                    return $responseData['redirect_url']; // Return the payment URL
                } else {
                    Log::error('Silkpay response did not include redirect_url', $responseData);
                    return null;
                }
            } else {
                // Log the response body if the request failed
                Log::error('Silkpay Error:', ['status' => $response->status(), 'body' => $response->body()]);
                return null;
            }
        } catch (\Exception $e) {
            // Log the exception message
            Log::error('Error creating Silkpay PayByLink:', ['exception' => $e->getMessage()]);
            return null;
        }
    }

}
