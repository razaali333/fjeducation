<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\CoreController;
use App\Models\Enum\TransactionStatus;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CallbackController extends CoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $noon_id = $request->query('noon_id');
        $merchant_reference = $request->query('merchant_reference');

        if (!$noon_id || !$merchant_reference) {
            $this->result->Error = 'Required arguments is missing.';

            return response()->json($this->result->Error, 400);
        }

        $transaction = Transaction::query()->find($merchant_reference);

        try {
            $url = 'https://api-test.noonpayments.com/payment/v1/order/'.$noon_id;

            $response = Http::withHeaders([
                'Authorization' => config('payments.merchant_key'),
                'Content-Type' => 'application/json'
            ])->get($url);

            if ($response->successful()) {
                $responseData = $response->json();
                $order = $responseData['result']['order'];
                $status = $order['status'];
            } else {
                $this->result->Error = 'Status request was failed.';

                $responseData = $response->json();
                Log::error('TRANSACTION REQUEST FAILED', $responseData);

                return response()->json($this->result->Error, 400);
            }

            $transactionStatus = match ($status) {
                'CAPTURED', 'AUTHORIZED' => TransactionStatus::SUCCESS,
                'ABANDONED', 'CANCELLED', 'EXPIRED', 'FAILED', 'VOID', 'TIMEDOUT', 'UNKNOWN' => TransactionStatus::FAILED,
                default => TransactionStatus::PENDING,
            };

            $transaction->update(['status' => $transactionStatus]);

            return response()->json(['success' => true, 'status' => $status]);

        } catch (Exception $exception) {
            $this->result->Error = $exception->getMessage();

            return response()->json($this->result);
        }
    }
}
