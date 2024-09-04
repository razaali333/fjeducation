<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Services\SilkpayService;
use Illuminate\Http\Request;

class SilkPaymentController extends Controller
{
    protected $silkpayService;

    public function __construct(SilkpayService $silkpayService)
    {
        $this->silkpayService = $silkpayService;
    }

    public function createPayLink(Request $request)
    {

        // Validate the incoming request
        $request->validate([
            'book_id' => 'required|exists:contents,id',  // Assuming 'contents' table has 'id' as the book ID
        ]);
        // dd('work');
        // Assuming you have predefined amount and currency for the book
        $book = Content::find($request->book_id);
        $amount = $book->price ?? 10; // Replace with actual field if needed
        $currency = 'USD'; // Change this to dynamic currency if needed

        // Generate PayByLink using your Silkpay service
        $payLink = $this->silkpayService->createPayByLink($amount, $currency);

        // Check if PayLink was successfully generated
        if ($payLink) {
            return response()->json([
                'success' => true,
                'payment_url' => $payLink,  // Returning payment URL
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment link',
            ], 500);
        }
    }


    public function success_silk(Request $request)
    {
        return response()->json(['message' => 'Payment Success']);
     }
    public function notify_silk(Request $request)
    {
        return response()->json(['message' => 'Payment Info']);
    }
    public function cancel_silk(Request $request)
    {
        return view('pages.cancel_silk');  // Returning a view instead of JSON

    }
}
