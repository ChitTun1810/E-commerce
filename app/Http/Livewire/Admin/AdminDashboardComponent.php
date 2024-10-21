<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminDashboardComponent extends Component
{
    public $ph_num;
    public $lat;
    public $lang;
    use WithFileUploads;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function phnum()
    {
        $user = User::where('id',auth()->user()->id)->first();
        $user->ph_num = $this->ph_num;
        $user->save();
        return back();
    }

    public function avatarUpload()
    {
        $user = User::where('id',auth()->user()->id)->first();
        $imageName = request()->image->getClientOriginalName();
        request()->image->storeAs('avatar/'.(auth()->user()->name),$imageName);
        $user->avatar = $imageName;
        $user->save();
        return back();
    }
    public function addlocation()
    {
        $user = User::where('id',auth()->user()->id)->first();
        $user->lat = $this->lat;
        $user->lang = $this->lang;
        $user->save();
        return back();
    }
    public function render()
    {
        return view('livewire.admin.admin-dashboard-component');
    }
}
