<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\Review;
use App\Models\User;
use App\Notifications\NewComment;
use Illuminate\Support\Facades\Notification;

class CommentController extends Controller
{
    public function reply()
    {
        $reply = new Reply;
        $reply->review_id = request()->review_id;
        $reply->user_id = auth()->user()->id;
        $reply->content = request()->content;
        $reply->save();
        $user = User::where('id',request()->user_id)->get();
        if(!$user[0]->id == auth()->user()->id ){
            Notification::send($user, new NewComment(auth()->user()));
        }
        return redirect('faq');
    }
    public function deletereview($id)
    {
        $review = Review::find($id);
        $review->delete();
        return back()->with('message','Review is deleted');
    }
    public function deletereply($id)
    {
        $reply = Reply::find($id);
        $reply->delete();
        return back()->with('message','Comment is deleted');
    }
    public function editreply($id)
    {
        $reply = Reply::find($id);
        $reply->content = request()->edittext;
        $reply->update();
        return redirect(route('faq'));
    }

}
