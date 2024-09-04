<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NoonService;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class NoonController extends Controller
{
    protected $noonService;

    public function __construct(NoonService $noonService)
    {
        $this->noonService = $noonService;
    }

    public function createInvoice(Request $request)
    {
          // Assuming you are passing the package_id from the request, get it from the request
    $packageId = $request->input('package_id');

    // Store the package_id in the session
     session(['package_id' => $packageId]);


        $result = $this->noonService->createOrder(550, 'AED');

        // $result = $this->noonService->createInvoice($invoiceData);
        if ($result['success']) {
            return response()->json(['success' => true, 'url' => $result['payment_url']]);
        } else {
            return response()->json(['success' => false, 'message' => $result['message']], 500);
        }
    }
     public function network_cancel()
    {
        return view('pages.cancel_network');
    }

   public function network_success(Request $request)
{
    // Get the order reference from the query parameters
    $orderReference = $request->query('ref');

    // Fetch the order status using the Noon service
    $orderStatus = $this->noonService->getOrderStatus($orderReference);

    $user = Auth::user();


    // Check if the request was successful
    if ($orderStatus['success']==true) {
        $packageId = session('package_id');

        $check_status=$orderStatus['data']['_embedded']['payment'][0]['state'];
            switch ($check_status) {
                case 'CAPTURED':
                    $amountData = $orderStatus['data']['_embedded']['payment'][0]['amount']['value'];
                    $currency = $orderStatus['data']['_embedded']['payment'][0]['amount']['currencyCode'];

                    $amount = $amountData / 100;
                    $format_amt = $amount . ' ' . $currency;
                    $status = 'success';
                    break;

                default:
                    $format_amt = 0;
                    $status = 'error';
                    break;
            }


        // Extract the data
        $data = $orderStatus['data'];

        // Check if the reference already exists in the transactions table
        $existingTransaction = Transaction::where('referance', $data['reference'])->first();
    //  dd($existingTransaction);
        if (!$existingTransaction) {


        // Extract billing address data
        $billingAddress = $data['billingAddress'];

        // Extract amount and currency
           $amountData = $data['_embedded']['payment'][0]['amount']['value'];
           $currency = $data['_embedded']['payment'][0]['amount']['currencyCode'];

            $amount = $amountData / 100;

        // Create a new Transaction record
        Transaction::create([
            'user_id' => $user->id,
            'rate_id'=>$packageId,
            'referance' => $data['reference'],
            'emailAddress' => $data['emailAddress'],
            'firstName' => $billingAddress['firstName'],
            'lastName' => $billingAddress['lastName'],
            'address1' => $billingAddress['address1'],
            'city' => $billingAddress['city'],
            'countryCode' => $billingAddress['countryCode'],
            'amount' => $amount,
            'currency' => $currency,
            'status' => $data['_embedded']['payment'][0]['state'],
            'orderReference' => $data['reference'],

        ]);

        // Return the data as a JSON response
        // return response()->json($orderStatus['data']);

    }


    }
    else {
        // Return an error response if the request failed
       $status='error';
       $format_amt=0;
    }

     return view('pages.network_success',compact('status','format_amt'));
}


     public function networkWebhook(Request $request)
    {
        // Get the raw JSON input
        $json = file_get_contents("php://input");

        // Decode the JSON data
        $order = json_decode($json);

        // Log the data
        Log::info('Webhook received:', ['data' => $order]);

        // Respond with a 200 OK status
        return response()->json(['status' => 'success'], 200);
    }
    // public function createInvoice(Request $request)
    // {
    //     $invoiceData = [
    //         "firstName" => $request->input('firstName', 'Test'),
    //         "lastName" => $request->input('lastName', 'Customer'),
    //         "email" => $request->input('email', 'test@customer.com'),
    //         "transactionType" => "SALE",
    //         "emailSubject" => "Invoice from ACME Services LLC",
    //         "invoiceExpiryDate" => now()->addDays(7)->format('Y-m-d'),
    //         "paymentAttempts"=>3,
    //         "redirectUrl"=>'http://localhost:8000/network_success',
    //         "items" => [
    //             [
    //                 "description" => "1 x large widget",
    //                 "totalPrice" => [
    //                     "currencyCode" => "AED",
    //                     "value" => 100
    //                 ],
    //                 "quantity" => 1
    //             ]
    //         ],
    //         "total" => [
    //             "currencyCode" => "AED",
    //             "value" => 100
    //         ],
    //         "message" => "Thank you for shopping with ACME Services LLC. Please visit the link provided below to pay your bill. We will ship your order once we have confirmation of your payment."
    //     ];

    //     $result = $this->noonService->createInvoice($invoiceData);
    //     if ($result['success']) {
    //         return response()->json(['success' => true, 'url' => $result['payment_url']]);
    //     } else {
    //         return response()->json(['success' => false, 'message' => $result['message']], 500);
    //     }
    // }
}
