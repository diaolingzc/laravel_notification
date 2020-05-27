<?php

namespace App\Http\Controllers;

use App\Notifications\RobotNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class SmsController extends Controller
{
    public function robot()
    {
        Notification::send(request()->user(), new RobotNotification('111'));
    }
}
