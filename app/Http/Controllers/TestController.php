<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\Test;
use Illuminate\Support\Facades\Notification;

class TestController extends Controller
{
    public function sendTestNoti()
    {
        $user = User::first();
        $enrollmentData = [
            'body'  => 'You received an new test notification',
            'enrollmentText' =>'You are allowed to enroll',
            'url' => url('/'),
            'thankyou' => 'You have 14days to enroll',
        ];
        // $user->notify(new Test($enrollmentData));
        Notification::send($user, new Test($enrollmentData));
    }
}
