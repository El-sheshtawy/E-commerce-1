<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe;

class StripePaymentController extends Controller
{
    public function showFormStripe($totalPrice)
    {
        return view('site.user.pages.stripe', compact('totalPrice'));
    }

    public function StoreStripe(Request $request, $totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $totalPrice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com.",
        ]);

        if (Auth::id()) {
            $userCarts = Cart::all()->where('user_id', Auth::id());
            foreach ($userCarts as $cart) {
                order::create([
                    'name' => $cart->username,
                    'email' => $cart->email,
                    'phone' => $cart->phone,
                    'address' => $cart->address,
                    'user_id' => $cart->user_id,
                    'product_title' => $cart->product_title,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->price,
                    'image' => $cart->image,
                    'payment_status' => 'cash using card',
                    'delivery_status' => 'processing',
                ]);
            }
            Cart::where('user_id', Auth::id())->delete();

            Session::flash('success', 'Payment successful!');

            return redirect()->to('/cart/show')->with('card_method','We have received your order, Payment successful!');
        }
    }
}
