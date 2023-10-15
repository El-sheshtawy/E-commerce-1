@extends('site.user.layouts.app')


@section('title')
    SHESHTAWY | My Orders
@endsection



@section('content')

    @if(session()->has('cst_cancel_order'))
        <div class="alert alert-danger" role="alert" style="text-align: center;">
            {{session()->get('cst_cancel_order')}}
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
    @if($orders->isNotEmpty())

        <h1 class="no_select" style="text-align: center;">My Orders</h1><br>
        <table class="center">

            <thead>
            <tr>
                <th class="th_deg"> Order Number</th>
                <th class="th_deg"> Order by Customer</th>
                <th class="th_deg"> Product</th>
                <th class="th_deg">Image</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Order date and time</th>
                <th class="th_deg">Order Status</th>
                <th class="th_deg">Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($orders as $order)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$order->product_title}}</td>
                    <td>
                        <img src="/product/{{$order->image}}" alt="imgae not show">
                    </td>
                    <td>${{$order->price}}</td>
                    <td>{{$order->created_at->format('l, jS \of F Y, h:i:s A')}}</td>
                    <td>{{ $order->delivery_status }}</td>
                    @if($order->delivery_status === 'processing')
                    <td>
                        <a class=" btn btn-danger" onclick="confirmation(event)" href="{{route('order.cancel',$order->id)}}">Cancel</a>
                    </td>
                    @else
                        <td style="color: green">Already Delivered</td>
                    @endif

                </tr>

            @endforeach
            </tbody>
        </table><br>

    @elseif(!$orders->isNotEmpty())
        <h3 style="text-align: center">Orders is empty now</h3>
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
            title: "Are you sure to cancel this order ?",
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

