<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class AdminViewUsersComponent extends Component
{
    public function changeadm($id)
    {
        $user = User::where('id',$id)->first();
        $user->utype = 'ADM';
        $user->save();
        return back();
    }
    public function changeusr($id)
    {
        $user = User::where('id',$id)->first();
        $user->utype = 'USR';
        $user->save();
        return back();
    }
    public function changeact($id)
    {
        $user = User::where('id',$id)->first();
        $user->status = 'Active';
        $user->save();
        return back();
    }
    public function changeban($id)
    {
        $user = User::where('id',$id)->first();
        $user->status = 'Ban';
        $user->save();
        return back();
    }
    public function render()
    {
        $users = User::all();
        return view('livewire.admin.admin-view-users-component',[
            'users' => $users,
        ]);
    }
}
