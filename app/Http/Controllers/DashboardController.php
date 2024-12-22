<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserEvent;

class DashboardController extends Controller
{
    public function index()
    {
        $UserEvent = UserEvent::where('type', 1)->get();
        return view('UserPenal.dashboard', compact('UserEvent'));
    }
}
