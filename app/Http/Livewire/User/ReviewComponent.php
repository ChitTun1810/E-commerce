<?php

namespace App\Http\Livewire\User;

use App\Models\Review;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use App\Models\User;
use App\Notifications\NewReview;

class ReviewComponent extends Component
{
    public $stars;  
    public $review;

    public function review()
    {
        $user = User::where('utype','ADM')->get();
        $review = new Review;
        $review->user_id = auth()->user()->id;
        $review->review = $this->review;
        $review->rating = $this->stars;
        $review->save();
        Notification::send($user, new NewReview(auth()->user()));
        return redirect(route('home.index'));
    }

    public function render()
    {
        return view('livewire.user.review-component');
    }
}
