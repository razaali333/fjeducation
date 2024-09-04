<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }
    public function books()
    {
         // Fetch books from the contents table where content_category_id matches the books category
    $books =Content::where('content_category_id',1)->orderBy('created_at', 'desc')->get();
    // dd($books);

// Pass the books to the view
return view('pages.books', compact('books'));
    }
    public function videos()
    {
        $videos =Content::where('content_category_id',2)->orderBy('created_at', 'desc')->get();
        return view('pages.videos', compact('videos'));
    }
    public function privacy()
    {
        return view('pages.privacy');
    }
    public function cookie()
    {
        return view('pages.cookie');
    }
    public function terms()
    {
        return view('pages.terms');
    }
    public function profile()
    {
        // Get the logged-in user's details
    $user = Auth::user();
     // Split the user's name into first and last name
     $nameParts = explode(' ', $user->name, 2);

     // Set the first and last name
     $firstName = $nameParts[0];
     $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

    return view('pages.profile', compact('user', 'firstName', 'lastName'));

    }
    public function packages()
    {
        $packages=Rate::query()->orderBy('created_at','desc')->get();
        $user = auth()->user(); // Assuming the user is logged in
        // dd($packages);
        return view('pages.packages',compact('packages','user'));
    }

    public function access()
    {
        // Assuming the user is logged in
    $user = auth()->user();

    // Get the user's purchased packages by checking the transactions table
    $purchasedPackageIds = $user->transactions()->pluck('rate_id');

    // Retrieve the related rates and their contents
    $purchasedRates = Rate::whereIn('id', $purchasedPackageIds)->get();

    // Categorize contents by type (e.g., books, video)
    $books = Content::whereIn('package_id', $purchasedRates->pluck('id'))
                                ->where('content_category_id', '1')
                                ->get();

    $videos = Content::whereIn('package_id', $purchasedRates->pluck('id'))
                                 ->where('content_category_id', '2')
                                 ->get();
     return view('pages.access', compact('books', 'videos', 'purchasedPackageIds'));

    }

    public function Passwordreset(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Normally, you would generate a password reset token and send an email
            // For demonstration, we just return success
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }



    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/'); // Redirect to home after logout
}
}
