<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Review;
use App\Models\Reply;
use Livewire\WithPagination;

class RouteController extends Controller
{
    use WithPagination;
    public function logout()
    {   
        Session::flush();
        Auth::logout();
        return back();
    }
    public function test()
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

        $reviews = Review::latest()->paginate(4,['*'],'review');
        $replys = Reply::all();
        return view('livewire.test',[
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
