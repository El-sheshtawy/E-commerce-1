@extends('site.admin.layouts.app')
@section('css_extra')

    <style>
        .center{
            margin:auto;
            width: 50%;
            border: 2px solid white;
            text-align: center;
            margin-top: 40px;
        }
        .font_size{
            text-align: center;
            font-size: 40px;
            padding-top: 20px;
        }
        .image_size{
            width: 200px;
            height: 200px;
        }
        .th_color{
            background: skyblue;
        }
        .th_dg{
            padding: 20px;
        }
    </style>

@endsection

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @if(session()->has('delete_message'))
                <div class="alert-danger">
                {{session()->get('delete_message')}}
                </div>
            @endif

                @if(session()->has('update_message'))
                    <div class="alert-success">
                        {{session()->get('update_message')}}
                    </div>
                @endif

            <h2 class="font_size">All Products</h2>
        <table class="center">

            <tr class="th_color">
                <th class="th_dg">Product Title</th>
                <th class="th_dg">Product Description</th>
                <th class="th_dg">Product Category</th>
                <th class="th_dg">Product Price</th>
                <th class="th_dg">Quantity </th>
                <th class="th_dg">Discount </th>
                <th class="th_dg">Proudct Image</th>
                <th class="th_dg">Edit</th>
                <th class="th_dg">Delete</th>

            </tr>
            @foreach($products as $product)
            <tr>
                <td>{{$product->title}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->category}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->discount_price}}</td>
                <td>
                    <img class='image_size' src="/product/{{$product->image}}">
                </td>
                <td>
                    <a class="btn btn-success" href="{{route('product.edit',$product->id)}}">Edit</a>
                </td>
                <td>
                    <a class="btn-danger" href="{{route('product.destroy',$product->id)}}">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>


    </div>

@endsection

@section('title')
  Show Product
@endsection
