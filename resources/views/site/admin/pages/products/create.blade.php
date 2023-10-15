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
            @if(session()->has('add_message'))
                <div class="alert alert-success">
                    {{session()->get('add_message')}}
                </div>
            @endif
        <div class="content-wrapper">
            <div class="div_center">
                <h1 class="font_size">Add Product</h1>


            <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

            <div class="div_center">
                <label>Product Title</label>
                <input class="text_color" type="text" name="title" placeholder="write a title">
            </div>

            <div class="div_center">
                <label>Product Description</label>
                <input class="text_color" type="text" name="description" placeholder="write a description">
            </div>

            <div class="div_center">
                <label>Product Price</label>
                <input class="text_color" type="number" name="price" placeholder="write a price">
            </div>

            <div class="div_center">
                <label>Product Quantity</label>
                <input class="text_color" type="number" name="quantity" placeholder="write a quantity" min="0">
            </div>

            <div class="div_center">
                <label>Product Discount</label>
                <input class="text_color" type="number" name="discount_price" placeholder="write a discount">
            </div>


            <div class="div_center">
                <label>Product Category</label>
                <select class="text_color" name="category" required="">
                    <option value="" selected>Add a category here</option>
                    @foreach($categories as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="div_center">
                <label>Product Image Here</label>
                <input class="text_color" type="file" name="image" placeholder="upload image">
            </div><br>

            <input  type="submit" name="submit" value="Add Category" class="btn-primary">
         </form>
@endsection

