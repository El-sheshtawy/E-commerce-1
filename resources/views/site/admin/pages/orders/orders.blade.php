@extends('site.admin.layouts.app')
@section('title')
    Orders
@endsection

@section('content')
    <style>

        .title_deg{
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 40px;
        }
        .table_deg{
            border: 2px solid white;
            margin: auto;
            width: 100%;
            padding-top: 50px;
            text-align: center;
        }
        .th_deg{
            background: skyblue;
        }

    </style>
    <div class="main-panel">
        <div class="content-wrapper">
  <h1 class="title_deg">
     All Orders
  </h1>
        <div style="padding-bottom: 30px; padding-left: 400px">
            <form action="{{ route('orders.search') }}" method="get">
                @csrf
                <input type="text" name="search" placeholder="Search For Order">
                <input type="submit" name="Search" class="btn btn-outline-primary">
            </form>

        </div>
        <table class="table_deg">
            <tbody>
                  <tr class="th_deg">

                    <th style="padding: 10px">Name</th>
                    <th style="padding: 10px">Email</th>
                    <th style="padding: 10px">Address</th>
                    <th style="padding: 10px">Phone</th>
                    <th style="padding: 10px">Product</th>
                    <th style="padding: 10px">Quantity</th>
                    <th style="padding: 10px">Price</th>
                    <th style="padding: 10px">Payment Status</th>
                    <th style="padding: 10px">Delivery Status</th>
                    <th style="padding: 10px">Image</th>
                    <th style="padding: 10px">Delivered</th>
                    <th style="padding: 10px">Print PDF</th>
                    <th style="padding: 10px">Send Email</th>

                 </tr>
                  @forelse($order as $order)
                <tr>
                <td>{{$order->name}}</td>
                <td>{{$order->email}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->phone}}</td>
                <td>{{$order->product_title}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{$order->price}}</td>
                <td>{{$order->payment_status}}</td>
                <td>{{$order->delivery_status}}</td>
                <td>
                   <img src="/product/{{$order->image}}">
                </td>
                    @if($order->delivery_status=='processing')
                    <td>
                        <a href="{{ route('delivered',$order->id) }}" onclick="return confirm('Are You sure this product delivered ?')" class="btn btn-primary">Delivered</a>
                    </td>
                    @else
                        <td>
                            <p style="color: green">Delivered</p>
                        </td>
                    @endif
                    <td>
                        <a class="btn-btn alert-secondary" href="{{ route('pdf.print',$order->id) }}" onclick="return confirm('Are You sure that you want to Download as PDF?')">Print PDF</a>
                    </td>

                    <td>
                        <a class="btn btn-info" href="{{route('email.send',$order->id)}}">Send Email</a>
                    </td>

                </tr>
                @empty
                      <div>
                          <tr>
                              <td colspan="16">
                                         No Data Found
                              </td>
                          </tr>
                      </div>
                  @endforelse
            </tbody>
        </table>
    </div>
@endsection

