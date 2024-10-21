<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HeaderBtmComponent extends Component
{
    public function render()
    {
        if(auth()->user()){
            $notifications = auth()->user()->unreadNotifications;
            return view('livewire.header-btm-component',[
                'notifications' => $notifications,
            ]);
        }
        return view('livewire.header-btm-component');

    }
}
