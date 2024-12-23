<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    UserEvent,
    Admin,
    EventType,
    User
};

class DashboardController extends Controller
{
    public function index()
    {
        $adminEvents = UserEvent::with(['user', 'eventType'])
        ->where('type', 2)
        ->get();
        $userEvents = UserEvent::with(['user', 'eventType'])
        ->where('type', 1)
        ->get();

        return view('UserPenal.dashboard', compact('adminEvents', 'userEvents'));
    }
}
