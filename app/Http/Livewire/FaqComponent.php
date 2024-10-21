<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class FaqComponent extends Component
{
    public $content = array();
    public $edittext;
    use WithPagination;
    
    public function reply($id)
    {
        $reply = new Reply;
        $reply->review_id = $id;
        $reply->user_id = auth()->user()->id;
        $reply->content = $this->content[$id];
        $reply->save();
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
        $reply->content = $this->edittext;
        $reply->update();
        return redirect(route('faq'));
    }
    function viewreply($id)
    {
        $review = Review::find($id);
        return back(['review' => $review]);
    }

    public function render()
    {
        $total = Review::all()->count();
        $star5 = Review::all()->where('rating','5')->count();
        $s5rate = round((($star5/$total)*100),1);

        $star4 = Review::all()->where('rating','4')->count();
        $s4rate= round((($star4/$total)*100),1);

        $star3 = Review::all()->where('rating','3')->count();
        $s3rate = round((($star3/$total)*100),1);

        $star2 = Review::all()->where('rating','2')->count();
        $s2rate = round((($star2/$total)*100),1);

        $star1 = Review::all()->where('rating','1')->count();
        $s1rate = round((($star1/$total)*100),1);

        $reviews = Review::paginate(4,['*'],'review');
        $replys = Reply::all();
        return view('livewire.faq-component',[
            's5rate'    => $s5rate,
            's4rate'    => $s4rate,
            's3rate'    => $s3rate,
            's2rate'    => $s2rate,
            's1rate'    => $s1rate,
            'reviews' => $reviews,
            'replys'     => $replys,
        ]);    
    }
}
