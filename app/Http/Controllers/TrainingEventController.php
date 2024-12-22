<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{EventTraning, PaymentHistory};

class TrainingEventController extends Controller
{
    public function index($id)
    {
        // Get the event training records
        $EventTraning = EventTraning::where('event_id', $id)->get();

        // Check if the user has successfully paid for the event
        $PaymentHistory = PaymentHistory::where('user_id', auth()->id())
            ->where('event_id', $id)
            ->where('status', 2)
            ->first();

        // If payment is not found, redirect with a message
        if (!$PaymentHistory) {
            return redirect()->back()->with('msg', 'Please buy the event.');
        }

        // Return the view with event training data
        return view('Event_traning.index', compact('EventTraning'));
    }
}
