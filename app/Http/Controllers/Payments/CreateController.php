<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Payments\CreateRequest;
use App\Models\Enum\TransactionStatus;
use App\Models\Enum\TransactionType;
use App\Models\Rate;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;


class CreateController extends CoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRequest $request): JsonResponse
    {
        $data = $request->validated();

        /** @var Rate $rate */
        $rate = Rate::query()->find($data['rate_id']);

        /** @var User $user */
        $user = Auth::guard('api')->user();

        DB::beginTransaction();

        try {
            /** @var Transaction $transaction */
            $transaction = Transaction::query()->create([
                'user_id' => $user->id,
                'rate_id' => $rate->id,
                'amount' => $rate->price,
                'currency_label' => $rate->currency_label,
                'status' => TransactionStatus::PENDING,
                'type' => TransactionType::DEPOSIT,
                'payload' => '',
                'ip' => $request->getClientIp(),
            ]);

            $transliteratedName = Str::transliterate($user->name);
            $words = explode(' ', $transliteratedName);

            $url = 'https://api-test.noonpayments.com/payment/v1/order';

            $payload = [
                "apiOperation" => "INITIATE",
                "order" => [
                    "reference" => $transaction->id,
                    "amount" => $rate->price,
                    "currency" => 'AED',
                    "name" => "Account replenishment.",
                    "channel" => "web",
                    "category" => "pay"
                ],
                "billing"=> [
                    "contact"=> [
                        "firstName"=> $words[0],
                        "lastName"=> $words[1] ?? '',
                        "mobilePhone"=> $user->phone,
                        "email"=> $user->email,
                    ]
                ],
                "configuration" =>
                    [
                        'tokenizeCc' => 'true',
                        'paymentAction' => 'SALE',
                        'returnUrl' => 'https://fjeducation.com/payment-success',
                        'locale' => 'en',
                    ]
            ];

            $response = Http::withHeaders([
                'Authorization' => config('payments.merchant_key'),
                'Content-Type' => 'application/json'
            ])->post($url, $payload);

            $responseData = $response->json();

            DB::commit();

            if ($response->successful() && $responseData['resultCode'] == 0 && $responseData['result']['order']['status'] == 'INITIATED') {
                $paymentUrl = $responseData['result']['checkoutData']['postUrl'];

                $this->result->Success = true;
                $this->result->Content = [
                    'link' => $paymentUrl,
                ];

                return response()->json($this->result);
            } else {
                // Handle errors or unsuccessful payment initiation
                $errorMessage = $responseData['message'] ?? 'Unknown error';
                $this->result->Error = $errorMessage;

                \Log::error('PAYMENT ERROR', ba[config('payments.merchant_key')]);

                return response()->json($this->result, 400);
            }
        } catch (Exception $exception) {
            DB::rollBack();

            $this->result->Error = $exception->getMessage();

            return response()->json($this->result);
        }
    }
}
