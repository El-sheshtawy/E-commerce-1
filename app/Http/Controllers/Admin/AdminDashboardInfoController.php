<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;


class AdminDashboardInfoController extends Controller
{
    public function showUsersInfo()
    {
        $users=User::all();
       return $users;
    }

    public function showProductsInfo()
    {

        $products= Product::all();
        return $products;
    }

    public function showOrdersInfo()
    {
        $orders=Order::all();
        return $orders;
    }
    public function showProcessingOrdersInfo()
    {
        $processingOrders= Order::all()->where('delivery_status','processing');
        return $processingOrders;
    }

    public function showDeliveredOrdersInfo()
    {
        $deliveredOrders= Order::all()->where('delivery_status','delivered');
        return $deliveredOrders;
    }

    public function calculateTotalRevenue()
    {
        $totalRevenue=0;
        foreach (Order::all() as $order){
            $totalRevenue+=$order->price;
        }
         // return view('site.admin.dashboard.money_accounting',compact('totalRevenue'));
    }
    public function showAdminDashboardStatistics()
    {
        $totalRevenue=0;
        foreach (Order::all() as $order){
            $totalRevenue+=$order->price;
        }
        $dashboardInfo=[
            'usersCount'=>User::all()->count(),
            'productsCount'=>Product::all()->count(),
            'ordersCount'=>Order::all()->count(),
            'processingOrdersCount'=>Order::all()->where('delivery_status','processing')->count(),
            'deliveredOrdersCount'=>Order::all()->where('delivery_status','delivered')->count(),
            'totalRevenue'=>$totalRevenue,
        ];
        return view('site.admin.dashboard.dashboard',$dashboardInfo);
    }
}
