<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function payOrderCash()
    {
        if (Auth::id()) {
            $userCarts = Cart::all()->where('user_id', Auth::id());
            DB::beginTransaction();
            try {
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
                        'payment_status' => 'cash on delivery',
                        'delivery_status' => 'processing',
                    ]);
                }
                Cart::where('user_id', Auth::id())->delete();
                DB::commit();
                return redirect()->back()
                    ->with('cash_method', 'We have received your order, Pay Method has been added as cash on delivery');
            }
            catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error_create_order', 'An Unknown error in server, please try later');
            }
        }
                return redirect()->to('/login');
   }

        public function showOrders()
        {
            if (Auth::id()){
                $orders=Order::all()->where('user_id',Auth::id());
                return view('site.user.pages.orders-show',compact('orders'));
            }
            else{
                return redirect()->route('login');
            }
        }

        public function cancelOrder(Request $request)
        {
            if (Auth::id()) {
                Order::where('user_id',Auth::id())->where('id',$request->order_id)->first()->delete();
                Alert::success('An order deleted','This order has been deleted from your orders');
                return redirect()->back();
                }
            return  redirect()->route('login');
        }
}
