<h1>Send Email to : {{$order->email}}</h1>

@extends('site.admin.layouts.app')
@section('title')
    Email Send
@endsection

@section('css_extra')
    <style>
        label{
            display: inline-block;
            width: 200px;
            font-size: 15px;
        }
    </style>
@endsection


@section('content')
    <div class="main-panel">

        <div class="content-wrapper">
            <div class="div_center">
                <h3 style="text-align: center;">Send Email to:  <span style="font-weight:normal;">{{$order->email}}</span>  </h3>
                <form action="{{ route('email.user.send',$order->id) }}" method="POST">
                    @csrf

                <div style="padding-left: 35%; padding-top: 30px">
                    <label>Email Greeting :</label>
                    <input type="text" name="greeting">
                </div>

                <div style="padding-left: 35%; padding-top: 30px">
                    <label>Email Firstling :</label>
                    <input type="text" name="firstline">
                </div>

                <div style="padding-left: 35%; padding-top: 30px">
                    <label>Email Body :</label>
                    <input type="text" name="body">
                </div>

                <div style="padding-left: 35%; padding-top: 30px">
                    <label>Email Button Name  :</label>
                    <input type="text" name="button">
                </div>

                <div style="padding-left: 35%; padding-top: 30px">
                    <label>Email URL  :</label>
                    <input type="text" name="url">
                </div>

                <div style="padding-left: 35%; padding-top: 30px">
                    <label>Email Last Line  :</label>
                    <input type="text" name="lastline">
                </div>

                <div style="padding-left: 35%; padding-top: 30px">
                    <label>Email Last Line  :</label>
                    <input  type="submit" name="submit" value="Send Mail" class="btn-primary">
                </div>

                </form>
            </div>
        </div>
    </div>
@endsection

