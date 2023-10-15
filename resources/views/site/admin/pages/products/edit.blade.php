@extends('site.admin.layouts.app')
@section('title')
    Products
@endsection
@section('css_extra')
    <style>

        .div_center{
            text-align: center;
            padding-top: 40px;
        }
        .font_size{
            font-size: 40px;
            padding-bottom: 40px;
        }
        .text_color{
            color: black;
        }

    </style>
@endsection

@section('content')
    <div class="main-panel">
        @if(session()->has('delete_message'))
            <div class="alert-danger">
                {{session()->get('delete_message')}}
            </div>
        @endif
        @if(session()->has('add_messagae'))
            <div class="alert alert-success">
                {{session()->get('add_messagae')}}
            </div>
        @endif
        <div class="content-wrapper">
            <div class="div_center">
                <h1 class="font_size">Edit  Product</h1>
                <form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="div_center">
                        <label>Product Title</label>
                        <input class="text_color" type="text" name="title" placeholder="write a title" value="{{$product->title}}">
                    </div>

                    <div class="div_center">
                        <label>Product Description</label>
                        <input class="text_color" type="text" name="description" placeholder="write a description" value="{{$product->description}}">
                    </div>

                    <div class="div_center">
                        <label>Product Price</label>
                        <input class="text_color" type="number" name="price" placeholder="write a price" value="{{$product->price}}">
                    </div>

                    <div class="div_center">
                        <label>Product Quantity</label>
                        <input class="text_color" type="number" name="quantity" placeholder="write a quantity" min="0" value="{{$product->quantity}}">
                    </div>

                    <div class="div_center">
                        <label>Product Category</label>
                        <select class="text_color" name="category" required="">
                            <option value="" selected>Add a category here</option>
                            @foreach($categories as $category)
                                <option value="{{$category->category_name}}" selected>{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="div_center">
                        <label>Product Discount</label>
                        <input class="text_color" type="number" name="discount_price" placeholder="write a discount" value="{{$product->discount_price}}">
                    </div>

                    <div class="div_center">
                        <label>Current Product Image Here</label>
                        <img class="text_color" src="/product/{{$product->image}}"style="height: 100px; width: 100px">
                    </div><br>

                    <div class="div_center">
                        <label>Change Product Image Here</label>
                        <input class="text_color" type="file" name="image" placeholder="upload image" >
                    </div><br>

                    <input  type="submit" name="submit" value="Update Product" class="btn-primary">
                </form>
@endsection

