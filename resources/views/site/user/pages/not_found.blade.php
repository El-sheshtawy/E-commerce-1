<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>SHESHTAWY | Page Not Found</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>

    *{
        margin: 0;
        padding: 0;
        outline: none;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
    body{
        height: 100vh;

        background-size: 400%;
    }
    #error-page{
        position: absolute;
        top: 10%;
        left: 15%;
        right: 15%;
        bottom: 10%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
    }
    #error-page .content{
        max-width: 600px;
        text-align: center;
    }
    .content h2.header{
        font-size: 18vw;
        line-height: 1em;
        position: relative;
    }
    .content h2.header:after{
        position: absolute;
        content: attr(data-text);
        top: 0;
        left: 0;
        right: 0;
        background: -webkit-repeating-linear-gradient(#fd5c63, #fd5c63, #fd5c63, #fd5c63, #fd5c63, #fd5c63, #fd5c63, #fd5c63);
        background-size: 400%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 1px 1px 2px #fd5c63;
        animation: animate 10s ease-in-out infinite;
    }
    @keyframes animate {
        0%{
            background-position: 0 0;
        }
        25%{
            background-position: 100% 0;
        }
        50%{
            background-position: 100% 100%;
        }
        75%{
            background-position: 0% 100%;
        }
        100%{
            background-position: 0% 0%;
        }
    }
    .content h4{
        font-size: 1.5em;
        margin-bottom: 20px;
        text-transform: uppercase;
        color: #000;
        font-size: 2em;
        max-width: 600px;
        position: relative;
    }
    .content h4:after{
        position: absolute;
        content: attr(data-text);
        top: 0;
        left: 0;
        right: 0;
        text-shadow: 1px 1px 2px rgba(255,255,255,0.4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .content p{
        font-size: 1.2em;
        color: #0d0d0d;
    }
    .content .btns{
        margin: 25px 0;
        display: inline-flex;
    }
    .content .btns a{
        display: inline-block;
        margin: 0 10px;
        text-decoration: none;
        border: 2px solid red;
        color: red;
        font-weight: 500;
        padding: 10px 25px;
        border-radius: 25px;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }
    .content .btns a:hover{
        background: white;
        color: #fd5c63;
    }
    .no_select {
        -webkit-user-select: none; /* Safari */
        -ms-user-select: none; /* IE 10 and IE 11 */
        user-select: none; /* Standard syntax */
    }

    input::placeholder{
        text-align: center;
        color:red;
        opacity:0.4;
    }

    body {
        font-family: Arial;
    }

    * {
        box-sizing: border-box;
    }

    form.example input[type=text] {
        padding: 10px;
        font-size: 17px;
        border: 1px solid indianred;
        float: left;
        width: 80%;
        background: white;
    }

    form.example button {
        float: left;
        width: 20%;
        padding: 10px;
        background: #fd5c63;
        color: white;
        font-size: 17px;
        border: 1px solid red;
        border-left: none;
        cursor: pointer;
    ::plac
    }

    form.example button:hover {
        background: #fd5c63;
    }

    form.example::after {
        content: "";
        clear: both;
        display: table;
    }


</style>


<div>
    <img src="{{asset('assets/images/red.JPG')}}" style="padding-left: 20px; padding-top: 20px; height: 70px">
</div>
<br>

<div style="margin-top: -30px">
    <form class="example" style="margin-left: 1000px; padding-right: 20px" method="GET" action="{{ url('/product/search') }}">
        @csrf
        @if(isset($_GET['search']))
            <input style="width: 200px"   type="text" name="search" placeholder="Search here" value="{{ $_GET['search'] }}" required >
            <br> <button style="margin-left: 71px"  type="submit">
                <i class="fa fa-search"></i>
            </button>
        @else
            <input   type="text" name="search" placeholder= "Search for products here"  required>

            <button  class="btn btn-danger"  type="submit" >
                <i class="fa fa-search"></i>
            </button>
        @endif
        <br>
    </form>
</div>



<div id="error-page" style="margin-left: 80px; margin-top: 150px">
    <div class="content" style="padding-bottom: 100px">
        <div class="no_select">
            <h4 data-text="Opps! Page not found" class="no_select">
                    Sorry! We couldn't find that page
            </h4>
            <p class="no_select">
               Try searching or go to SHESHTAWY's home page.
            </p>
            <br>
        </div>
        <div class="btns">
            <a class="d-flex justify-content-center" href="/"><span class="no_select">return home</span></a>
        </div>
    </div>
</div>
</body>
</html>

