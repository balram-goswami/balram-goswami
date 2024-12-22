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
        $userEvents = UserEvent::with(['user', 'eventType'])->get();

        return view('UserPenal.dashboard', compact('userEvents'));
    }
}
