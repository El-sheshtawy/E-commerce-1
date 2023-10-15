<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(AddReplyRequest $request)
    {
        if (Auth::id()) {
            if ($request->has('comment_id')) {
                $comment = Comment::where('id', $request->comment_id)->first();
                Reply::create([
                    'user_id' => Auth::id(),
                    'comment_id' => $comment->id,
                    'body' =>trim(ucfirst(strtolower($request->reply))),
                ]);
                return redirect()->back()->with('add_reply', 'Your reply has been added');
            }
        }
        return redirect()->route('login');
    }

    public function update(UpdateReplyRequest $request)
    {
        if (Auth::id()) {
            if ($request->has('replyId')) {
                $reply=Reply::find($request->replyId);
                $reply->update([
                    'user_id' =>Auth::id(),
                    'body' =>trim(ucfirst(strtolower($request->reply))),
            ]);
            }
            return redirect()->back()->with('update_reply','Your reply has been updated successfully');
        }
    }

    public function delete($id)
    {
        if (Auth::id()){
            Reply::destroy($id);
            return redirect()->back()->with('delete_reply','Your reply has been deleted successfully');
        }
        return redirect()->route('login');
    }

}

