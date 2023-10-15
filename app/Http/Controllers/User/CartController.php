<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function showCart()
    {
        if (Auth::id()) {
            $cart = Cart::all()->where('user_id', Auth::id());
            return view('site.user.pages.cart-show', compact('cart'));
        }
        return redirect()->to('/login');
    }

    public function cancelCart(Request $request)
    {
        if (Auth::id()) {
            $cart = Cart::where('user_id', Auth::id())->where('id', $request->cart_id)->first();
            Cart::destroy($cart->id);
            Alert::success('A product removed', 'An item has been removed from the cart');
            return redirect()->back();
        }
        return redirect()->to('/login');
    }
}
