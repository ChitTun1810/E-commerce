<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class NotificationComponent extends Component
{
    public function markNotification($request)
    {
        // auth()->user()
        //     ->unreadNotifications
        //     ->when($request->input('id'), function ($query) use ($request) {
        //         return $query->where('id', $request->input('id'));
        //     })
        //     ->markAsRead();
        // return response()->noContent();  
    }
    public function markasread($id)
    {
        $notifications = auth()->user()->unreadNotifications->count();
        $noti = auth()->user()->unreadNotifications->find($id);
        $noti->markAsRead();

        return response()->json(['data' => $notifications]);
    }

    public function shownoti()
    {
        $user = auth()->user();
    
        // Retrieve all the read notifications for the user
        $readNotifications = $user->notifications()->whereNotNull('read_at')->get();
            
        return response()->json(['data' => $readNotifications]);    
    }
    public function readnoti()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
    public function render()
    {
        $notifications = auth()->user()->unreadNotifications;
        return view('livewire.notification-component',[
            'notifications' => $notifications,
        ]);
    }
}
