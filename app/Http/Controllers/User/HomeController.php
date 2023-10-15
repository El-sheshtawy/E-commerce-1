<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $products=Product::paginate(6);
        return view('site.user.pages.index',compact('products'));
    }

    public function showProductDetails(Request $request)
    {
            $product = Product::where('id', $request->product_id)->first();
            return view('site.user.pages.product-details', compact('product',));
    }

    public function addToCart(Request $request)
    {
        if (Auth::id()) {
            $user=Auth::user();
            $product=Product::where('id',$request->product_id)->first();
           Cart::create([
                "product_title"=>$product->title,
                "product_id"=>$product->id,
                "username"=>$user->name,
                "user_id"=>$user->id,
                "email"=>$user->email,
                "phone"=>$user->phone,
                "address"=>$user->address,
               "quantity"=>$request->quantity,
                "price"=>$product->discount_price ? $product->discount_price * $request->quantity
                    : $product->price * $request->quantity,
                "image"=>$product->image,
            ]);
             Alert::success('product added successfully','You have been added Product to cart');
            return redirect()->back();
        } else {
            return redirect()->route('login');
        }
    }

    public function searchInProducts(Request $request)
    {
        if ($request->has('search')){
            $products=Product::where('title','like','%'.$request->search.'%')
                ->orwhere('category','like','%'.$request->search.'%')->paginate(6);
            return view('site.user.pages.index',compact('products'));
        }
    }


    public function redirectToRegisterForm()
    {
        return redirect()->to('/register');
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to('/');
    }
}
