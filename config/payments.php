<?php

return [
    'merchant_key' => env('MERCHANT_KEY'),

    /**
     * Using testing currency ('TST') for transactions if true.
     * False let you use currencies from your profile.
     */
    'debug' => env('PAYMENT_DEBUG', true),
];
