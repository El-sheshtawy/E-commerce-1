<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use PDF;

class AdminOrderController extends Controller
{
    public function index()
    {
        $order=Order::all();
        return view('site.admin.pages.orders.orders',compact('order'));
    }

    public function delivered($id)
    {
        $order=Order::where('id',$id)->first();
        $order->update([
            'delivery_status'=>'delivered',
            'payment_status'=>'paid'
        ]);
        return redirect()->back();
    }

    public function printPDF($id)
    {
        $order=Order::where('id',$id)->first();
        $pdf=PDF::loadView('site.admin.pages.orders.pdf',compact('order'));
        return $pdf->download('order_details.pdf');
    }

    public function sendEmail($id)
    {
        $order=Order::find($id);
        $user=User::where('id',$order->user_id)->first();
        return view('site.admin.pages.orders.email',compact('order','user'));
    }

    public function sendUserEmail(Request $request,$id)
    {
        $order=Order::where('id',$id)->first();
        $details=[
            'greeting'=>$request->greeting,
            'firstline'=>$request->firstline,
            'body'=>$request->body,
            'button'=>$request->button,
            'url'=>$request->url,
            'lastline'=>$request->lastline,
        ];
        Notification::send($order,new SendEmailNotification($details));
        return redirect()->route('orders.index');
    }

    public function searchInProducts(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->search;
            $order = Order::where('name', 'like', "%$search%")->orWhere('phone', 'like', "%$search%")
                ->orWhere('product_title', 'like', "%$search%")->get();
            return view('site.admin.pages.orders.orders', compact('order'));
        }
    }
}

