<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(AddCommentRequest $request, $product_id)
    {
        if (Auth::id()) {
            $product = Product::where('id', $product_id)->first();
            Comment::create([
                'user_id'=>Auth::id(),
                'product_id'=>$product->id,
                'body'=>trim(ucfirst(strtolower($request->body))),
                'created_at'=>date('l,Js \of F Y,h:i:s A'),
            ]);
            return redirect()->back()->with('add_comment','Your Comment has been added');
        }
        return redirect()->route('login');
    }

    public function update(UpdateCommentRequest $request)
    {
        if (Auth::id()) {
                $comment = Comment::where('id', $request->commentId)->first();
                $comment->update([
                    'body' => trim(ucfirst(strtolower($request->body))),
                    'updated_at'=> date('l,Js \of F Y,h:i:s A'),
                ]);
              return redirect()->back()->with('update_comment', 'Your Comment has been updated successfully');
        }
        return redirect()->to('/login');
    }


    public function destroy($id)
    {
        if (Auth::id()){
            Comment::destroy($id);
            return redirect()->back()->with('delete_comment', 'Your Comment has been deleted successfully');
        }
        return redirect()->route('login');
    }
}
