@extends('site.user.layouts.app')

@section('title')
    SHESHTAWY | My cart
@endsection


@section('content')

        @if(session()->has('cash_method'))
            <div class="alert-success" style="text-align: center">
                {{session()->get('cash_method')}}
            </div>
        @endif

        @if(session()->has('card_method'))
            <div class="alert-success" style="text-align: center">
                {{session()->get('card_method')}}
            </div>
        @endif

        @if(session()->has('error_create_order'))
            <div class="alert alert-danger" style="text-align: center">
                {{session()->get('error_create_order')}}
            </div>
        @endif

<style>

    .no_select {
        -webkit-user-select: none; /* Safari */
        -ms-user-select: none; /* IE 10 and IE 11 */
        user-select: none; /* Standard syntax */
    }

    .center{
        margin: auto;
        width: 50%;
        text-align: center;
        padding: 30px;
    }
    table,th,td{
        border: 1px solid grey;
    }
    .th_deg{
        font-size: 30px;
        padding: 5px;
        background: skyblue;
    }
</style>
        @if($cart->isNotEmpty())

    <h1 class="no_select" style="text-align: center;">My Cart Items</h1><br>
    <table class="center">

        <th class="th_deg">Cart Item Number</th>
        <th class="th_deg">Title</th>
        <th class="th_deg">Quantity</th>
        <th class="th_deg">Price</th>
        <th class="th_deg">Image</th>
        <th class="th_deg">Date</th>
        <th class="th_deg">Action</th>
        </tr>
        <thead>
        <tr>
        </thead>
        <tbody>

        @php  $totalPrice=0;  @endphp

        @foreach($cart as $item)
        <tr>
            <td>{{$loop->index + 1}}</td>
            <td>{{$item->product_title}}</td>
            <td>{{$item->quantity}}</td>
            <td>$ {{$item->price}}</td>
            <td>
                <img src="/product/{{$item->image}}" alt="imgae not show">
            </td>
            <td>
                {{$item->created_at->format('l, jS \of F Y , h:i:s A')}}
            </td>
            <td>
                    <a class=" btn btn-danger" onclick="confirmation(event)" href="{{route('cart-item.cancel',$item->id)}}">
                        Cancel
                    </a>
            </td>
        </tr>
            @php
            $totalPrice+=$item->price;
            @endphp

        @endforeach
        </tbody>
    </table><br>

<div>
    <h4 style="text-align: center;">Total Order Price: ${{$totalPrice}} </h4>
</div>

<div class="center">
    <h1 style="font-size: 25px; padding-bottom: 15px;">Proceed to order</h1>
    <a href="{{route('order.cash')}}" class="btn btn-danger">Cash on Delivery</a>
    <a href="{{route('stripe.show',$totalPrice)}}" class="btn btn-danger">Pay useing Card</a>
</div>
        @elseif(!$cart->isNotEmpty())
            <h3 class="no_select" style="text-align: center">Cart is empty now</h3>
        @endif
@endsection

@section('js_extra')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
            integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        swal({
            title: "Are you sure to cancel this product from your cart ?",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }
            });
    }
</script>

@endsection

@section('alert')
    @include('sweetalert::alert')
@endsection
