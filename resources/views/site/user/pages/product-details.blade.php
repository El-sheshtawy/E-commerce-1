@extends('site.user.layouts.app')

@section('title')
    {{$product->title}} Details
@endsection

@section('content')

    <style>


        .no_select {
            -webkit-user-select: none; /* Safari */
            -ms-user-select: none; /* IE 10 and IE 11 */
            user-select: none; /* Standard syntax */
        }


    </style>

                  {{--alert messages--}}
    {{--

    @if(session()->has('add_comment'))

        <div class="alert alert-primary" role="alert">
            {{\Illuminate\Support\Facades\Auth::user()->name}},    {{session()->get('add_comment')}}
        </div>

    @endif

    @if(session()->has('update_comment'))

    <div class="alert alert-primary" role="alert">
       {{\Illuminate\Support\Facades\Auth::user()->name}}, {{session()->get('update_comment')}}
    </div>

    @endif

    @if(session()->has('delete_comment'))

        <div class="alert alert-danger" role="alert">
            {{\Illuminate\Support\Facades\Auth::user()->name}},   {{session()->get('delete_comment')}}
        </div>

    @endif

    @if(session()->has('add_reply'))

        <div class="alert alert-primary" role="alert">
            {{\Illuminate\Support\Facades\Auth::user()->name}},    {{session()->get('add_reply')}}
        </div>

    @endif

    @if(session()->has('update_reply'))

        <div class="alert alert-primary" role="alert">
            {{\Illuminate\Support\Facades\Auth::user()->name}},    {{session()->get('update_reply')}}
        </div>

    @endif


    @if(session()->has('delete_reply'))

        <div class="alert alert-danger" role="alert">
            {{\Illuminate\Support\Facades\Auth::user()->name}},   {{session()->get('delete_reply')}}
        </div>

    @endif

    --}}

    <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="img-box">
                <img src="/product/{{$product->image}}" alt="">
            </div>
        <br>
            <div class="detail-box">
                <h5 style="color: green">Model Product Name: <span style="color: blue; font-weight: normal" >{{$product->title}}</span></h5>
                <h5 style="color: green">{{$product->title}} Description: <span style="color: blue; font-weight: normal">{{$product->description}}</span></h5>


            @if(!is_null($product->discount_price))

                    <h5 style="color: green;">
                        Discount Price:<span  style="font-weight: normal; color: blue">
                        ${{$product->discount_price}}</span>
                    </h5>

                    <h6 style="text-decoration:line-through;color:red; font-weight: normal">
                        Price:
                        ${{$product->price}}
                    </h6>

                @else

                    <h6 style="color: green; font-weight: normal">
                        Price:<br>
                        ${{$product->price}}
                    </h6>

                @endif
               <h5 style="color: green">Product Category : <span style="color: blue; font-weight: normal">{{$product->category}}</span>  </h5>

                <form action="{{url($product->title.'/cart/add/'.$product->id)}}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-md-4">
                            <input type="number"  name="quantity" value="1" min="1" style="width: 100px">
                        </div>

                        <div class="col-md-4">
                            <input type="submit" value="Add To Cart">
                        </div>

                    </div>
                </form>

            </div>
        </div>
    <div>

     @if($product->comments->isNotEmpty())
      <br>  <h4 class="no_select">Comments :</h4><br>

        @error('body')

        @else

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @enderror


                    {{--Comments--}}

        @foreach($product->comments as $comment)

            @auth

            @if($comment->user_id===\Illuminate\Support\Facades\Auth::user()->id)
                <h6 style="color: blue">@ me
                    <span style="margin: 30px ;color: green">
                        ({{ $comment->created_at->format('l, jS \of F Y, h:i:s A') }})
                    </span>
                </h6>
            <p style="color: black">- {{ $comment->body }}</p>

                    <a style="color: hotpink" href="javascript::void(0);" onclick="edit(this)" data-commentId="{{$comment->id}}">
                        [Edit]
                    </a>

                    <a style="color: sandybrown; margin: 50px" onclick="return confirm('Are You want to delete your comment?')"
                       href="{{ route('comment.delete',$comment->id) }}">
                        [Delete]
                    </a>

                @else

                    <h6 style="color: blue">{{ $comment->user->name }}
                        <span style="margin: 30px ;color: green">
                        ({{ $comment->created_at->format('l, jS \of F Y, h:i:s A') }})
                    </span>
                    </h6>
                    <p style="color: black">- {{ $comment->body }}</p>

                    <a style="color:brown ;margin: 30px" href="javascript::void(0);" onclick="reply(this)"
                       data-comment_id="{{$comment->id}}">
                        [Reply]
                    </a>


                    @endif
                @else


                <h6 style="color: blue">{{ $comment->user->name }}
                    <span style="margin: 30px ;color: green">
                        ({{ $comment->created_at->format('l, jS \of F Y, h:i:s A') }})
                    </span>
                </h6>
                <p style="color: black">- {{ $comment->body }}</p>

                <a style="color:brown ;margin: 30px" href="javascript::void(0);" onclick="reply(this)"
                   data-comment_id="{{$comment->id}}">
                    [Reply]
                </a>


                @endauth


                 <!-- Replies -->

             @if($comment->replies->isNotEmpty())
             @foreach($comment->replies as $reply)

                 @auth

             @if($reply->user_id===$comment->user_id and $reply->user_id=== \Illuminate\Support\Facades\Auth::user()->id)

                            <h6 style="color: blue">@me
                                <span style="margin: 30px ;color: green">
                        ({{ $reply->created_at->format('l, jS \of F Y, h:i:s A') }})
                    </span>
                            </h6>
                            <p style="color: black">- {{ $reply->body }}</p>

                            <a style="color: hotpink; margin: 50px"href="javascript::void(0);" onclick="editReply(this)"
                               data-replyId="{{ $reply->id }}">
                                [Edit reply]
                            </a>
                            <a style="color: sandybrown; margin: 50px" onclick="return confirm('Are You want to delete your reply?')"
                               href="{{ route('reply.delete',$reply->id) }}">
                                [Delete reply]
                            </a>

            @elseif($reply->user_id !== $comment->user_id and $reply->user_id=== \Illuminate\Support\Facades\Auth::user()->id)
                            <h6 style="padding: 30px; color: red" >
                                Reply: @me
                                <span style="margin: 30px; color: green">({{$reply->created_at->format('l, jS \of F Y, h:i:s A')}})</span>->
                                <span style="font-weight: normal; color: black">{{ $reply->body }}</span>
                                <span>

                                      <a style="color: hotpink; margin: 50px"href="javascript::void(0);" onclick="editReply(this)"
                                         data-replyId="{{ $reply->id }}">
                                            [Edit reply]
                                      </a>
                            <a style="color: sandybrown; margin: 50px"
                               onclick="return confirm('Are You want to delete your reply?')"
                               href="{{ route('reply.delete',$reply->id) }}">
                                    [Delete reply]
                            </a>
                                </span>
                            </h6>

                @elseif($reply->user_id===$comment->user_id and $reply->user_id !==\Illuminate\Support\Facades\Auth::user()->id)


                            <h6 style="color: blue">{{ $reply->user->name }}
                                <span style="margin: 30px ;color: green">
                        ({{ $reply->created_at->format('l, jS \of F Y, h:i:s A') }})
                                </span>
                            </h6>
                            <p style="color: black">- {{ $reply->body }}</p>

                            <a style="color:brown ;margin: 30px" href="javascript::void(0);" onclick="reply(this)"
                               data-comment_id="{{$comment->id}}">
                                [Reply]
                            </a>

                        @else

                            <h6 style="padding: 30px; color: red" >
                                Reply: {{ $reply->user->name }}
                                <span style="margin: 30px; color: green">({{$reply->created_at->format('l, jS \of F Y, h:i:s A')}})</span>->
                                <span style="font-weight: normal; color: black">{{ $reply->body }}</span>
                                <span>
                                     <a style="color:brown ;margin: 30px" href="javascript::void(0);" onclick="reply(this)"
                                        data-comment_id="{{$comment->id}}">
                                [Reply]
                            </a>
                                </span>
                            </h6>

                            @endif
                        @else
                            <h6 style="padding: 30px; color: red" >
                                Reply: {{ $reply->user->name }}
                                <span style="margin: 30px; color: green">({{$reply->created_at->format('l, jS \of F Y, h:i:s A')}})</span>->
                                <span style="font-weight: normal; color: black">{{ $reply->body }}</span>
                                <span>
                                     <a style="color:brown ;margin: 30px" href="javascript::void(0);" onclick="reply(this)"
                                        data-comment_id="{{$comment->id}}">
                                [Reply]
                            </a>
                                </span>
                            </h6>
                        @endauth

        @endforeach
                @endif
                <hr>
            @endforeach
        @endif

        @if($product->comments->isNotEmpty())


            {{-- Update Comment Form--}}
        <div style="display: none;" class="EditDiv">
            <form method="POST" action="{{ url('/comment/'.$comment->id.'/update') }}">
                @csrf
                <input id="commentId" name="commentId" type="hidden">
                <textarea style="width: 30%;height: 100px" name="body" type="text" placeholder="Edit comment here">
                </textarea><br>
                @error('body')
                <div  style="width: 40%"class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="javascript::void(0)" class="" onclick="edit_comment_close(this)">Close</a>
            </form>
        </div>


            {{-- Add Reply Form--}}
            <div style="display: none;" class="ReplyDiv">
                <form method="POST" action="{{ url('/product/'.$product->id.'/comment/'.$comment->id.'/reply/store') }}">
                    @csrf
                    <input id="comment_id" name="comment_id" type="hidden">
                    <textarea style="width: 30%;height: 100px" name="reply" type="text" placeholder="Add reply here">
                </textarea>

                    <br>
                    <button type="submit" class="btn btn-primary">Reply</button>
                    <a href="javascript::void(0);" class="" onclick="reply_close(this)">Close</a>
                </form>
            </div>

            @if($comment->replies->isNotEmpty())

            {{-- Update Reply Form--}}
            <div style="display: none" class="EditReplyDiv">
            <form method="POST" action="{{ url('/comment/'.$comment->id.'/reply/'.$reply->id) }}">
                @csrf
                <input name="replyId" id="replyId" type="hidden">
                <textarea style="width: 30%;height: 100px" name="reply" type="text" placeholder="Add reply here">
                </textarea><br>
                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="javascript::void(0);" class="" onclick="edit_reply_close(this)">Close</a>

            </form>
            </div>

            @endif
            @endif

           {{-- Add comment Form--}}
         <div class="no_select">
            <h5>Add a comment :</h5>
          <form method="POST" action="{{ url('/product/'.$product->id.'/comment/store') }}">
              @csrf
              @error('body')
              <div class="alert alert-danger" style="width: 40%" >
                      <ul>
                              <li style="height: 1%">The Comment must not be empty!</li>
                      </ul>
                  </div>
              @enderror
                <textarea style="width: 40%" name="body" type="text" placeholder="Add comment here"></textarea><br>
              <button  type="submit" class="btn btn-primary">comment</button>
                </form>
            </div>
    </div>
    </div>
    </div>
@endsection

@section('js_extra')

    <script type="text/javascript">
        function edit(caller)
        {
            document.getElementById('commentId').value=$(caller).attr('data-commentId');
            $('.EditDiv').insertAfter($(caller));
            $('.EditDiv').show();
        }
        function edit_comment_close(caller)
        {
            $('.EditDiv').hide();
        }
    </script>

    <script type="text/javascript">
        function reply(caller)
        {
            document.getElementById('comment_id').value=$(caller).attr('data-comment_id');
            $('.ReplyDiv').insertAfter($(caller));
            $('.ReplyDiv').show();
        }

        function reply_close(caller)
        {
            $('.ReplyDiv').hide();
        }
    </script>

    <script type="text/javascript">
        function editReply(caller)
        {
            document.getElementById('replyId').value=$(caller).attr('data-replyId');
            $('.EditReplyDiv').insertAfter($(caller));
            $('.EditReplyDiv').show();
        }

        function edit_reply_close(caller)
        {
            $('.EditReplyDiv').hide();
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>

@endsection

@section('alert')
    @include('sweetalert::alert')
@endsection
