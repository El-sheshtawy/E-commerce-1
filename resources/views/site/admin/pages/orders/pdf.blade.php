<h1>

   Order Details

</h1>


<h3>Order Name : <span style="font-weight:normal">{{$order->name}}</span>  </h3>
<h3>Customer Email : <span style="font-weight:normal">{{$order->email}}</span>  </h3>

<h3>Customer Address : <span style="font-weight:normal">{{$order->address}}</span>  </h3>
@if($order->phone)
<h3>Customer Phone : <span style="font-weight:normal">{{$order->phone}}</span>  </h3>
@endif



<h3>Product Name : <span style="font-weight:normal">{{$order->product_title}}</span>  </h3>
<h3>Quantity : <span style="font-weight:normal">{{$order->quantity}}</span>  </h3>
<h3>Product Price : <span style="font-weight:normal">{{$order->price}}</span>  </h3>
<h3>Payment Status : <span style="font-weight:normal">{{$order->payment_status}}</span>  </h3>
<h3>Delivery Status : <span style="font-weight:normal">{{$order->delivery_status}}</span>  </h3>

<h3>Product Photo :</h3>
<br><br>
<img  height="250" width="450" src="product/{{$order->image}}">
