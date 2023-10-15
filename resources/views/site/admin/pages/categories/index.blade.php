@extends('site.admin.layouts.app')
@section('title')
    Categories
@endsection
@section('css_extra')
    <style>
        .div_center{
            text-align: center;
            padding-top: 40px;
        }
        .h2_font{
            font-size: 40px;
            padding-bottom: 40px;
        }
        .center{
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid wheat;
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

                <h2 class="h2_font">Add Category</h2>

                <form action="{{route('category.store')}}" method="POST">
                    @csrf
                    <input type="text" name="category_name" placeholder="write category name">
                    <input type="submit" name="submit" value="Add Category" class="btn-primary">
                </form>


            </div>
            <div>
                <table class="center">
                    <tr>
                        <td>Category Name</td>
                        <td>Action</td>
                    </tr>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->category_name}}</td>
                            <td>
                                <a class="btn-danger" href="{{route('category.destroy',$category->id)}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

