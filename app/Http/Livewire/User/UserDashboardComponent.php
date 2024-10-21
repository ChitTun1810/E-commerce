<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserDashboardComponent extends Component
{
    public $ph_num;
    public $image;
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
        $this->validate([
            'image' => 'required|image'
        ]);
        $user = User::where('id',auth()->user()->id)->first();
        $imageName = $this->image->getClientOriginalName();
        $this->image->storeAs('avatar/'.(auth()->user()->name),$imageName);
        $user->avatar = $imageName;
        $user->save();
        $this->emitTo('profile-component','refreshComponent');
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
        return view('livewire.user.user-dashboard-component');
    }
}
