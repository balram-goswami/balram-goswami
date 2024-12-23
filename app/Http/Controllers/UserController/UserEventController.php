<?php

namespace App\Http\Controllers\UserController;

use Illuminate\Support\Facades\{Auth, DB};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    EventType,
    UserEvent,
    PaymentHistory
};

class UserEventController extends Controller
{
    public function index()
    {
        $eventIds = DB::table('payment_history')
            ->whereIn('event_id', function ($query) {
                $query->select('id')
                    ->from('event_types');
            })
            ->pluck('user_id');

        $EventType = EventType::where('id', $eventIds)->get();

        return view('UserPenal.userevents.event', compact('EventType'));
    }

    public function create_event(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'event_type' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // dd($request->all());

        // Handle image upload
        if ($request->hasFile('image')) {
            // Store the image
            $imagePath = $request->file('image')->store('event_images', 'public');

            // Get the file name
            $imageName = basename($imagePath);

            // Store the image file name in the database
            UserEvent::create([
                'user_id' => Auth::id(),
                'event_name' => $request->event_name,
                'event_date' => $request->event_date,
                'guest_names' => $request->guest_names,
                'speaker_name' => $request->speaker_name,
                'location' => $request->location,
                'type' => 1,
                'status' => 1,
                'event_type' => $request->event_type,
                'description' => $request->description,
                'image_path' => $imageName,  // Store the image name in the database
            ]);
            return redirect()->route('userevent')->with('success', 'Event created successfully.');
        }
        return redirect()->route('userevent')->with('error', 'Event created successfully.');
    }

    public function courespaymentpage($id)
    {
        // $Event = UserEvent::where('type', 2)->get();
        $Event = UserEvent::where('id', $id)->get();
        $PaymentHistory = PaymentHistory::where('user_id', auth()->id())
            ->where('status', 2)
            ->get();

        return view('UserPenal.coures_payment_pages', compact('Event', 'PaymentHistory'));
    }



    public function my_event()
    {
        $myEvent = PaymentHistory::where('user_id', Auth::id())->pluck('event_id');
        $Event = UserEvent::whereIn('id', $myEvent)->get();
        $PaymentHistory = PaymentHistory::where('user_id', auth()->id())
            ->where('status', 2)
            ->get();
        $createEvent = PaymentHistory::where('user_id', auth()->id())
            ->where('event_status', 2)
            ->exists();

        return view('UserPenal.userevents.myevents', compact('Event', 'PaymentHistory', 'createEvent'));
    }

    public function edit($id)
    {
        $event = UserEvent::findOrFail($id);
        $EventType = EventType::get();
        return view('UserPenal.userevents.editevent', compact('event', 'EventType')); // Return an edit view
    }

    public function destroy($id)
    {
        $event = UserEvent::findOrFail($id);
        $event->delete();
        return redirect()->route('my_event')->with('success', 'Event deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'guest_names' => 'nullable|string',
            'speaker_name' => 'nullable|string',
            'location' => 'required|string|max:255',
            'event_type' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $event = UserEvent::findOrFail($id);

        // Update fields
        $event->event_name = $request->event_name;
        $event->event_date = $request->event_date;
        $event->guest_names = $request->guest_names;
        $event->speaker_name = $request->speaker_name;
        $event->location = $request->location;
        $event->event_type = $request->event_type;
        $event->description = $request->description;

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('event_images', 'public');
            $event->image = $path;
        }

        $event->save();

        return redirect()->route('my_event')->with('success', 'Event updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required',
            'amount' => 'required|numeric|min:1', // Validate amount
            'transaction_id' => 'required|string', // Validate transaction_id as required and a string
        ]);

        $payment = PaymentHistory::create([
            'user_id' => auth()->id(), // Assuming the user is authenticated
            'event_id' => $request->input('event_id'),
            'type' => $request->input('payment_method'),
            'amount' => $request->input('amount'),
            'transaction_id' => $request->input('transaction_id'),
            'payment_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Payment Send Request successfully!');
    }
}
