<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    EventType,
    UserEvent,
    EventTraning,
    PaymentHistory,
    User
};
use Illuminate\Support\Facades\{
    Auth,
    Validator,
    Storage,
    Session,
    Redirect
};

class EventController extends Controller
{

    public function create()
    {
        $Event = UserEvent::where('type', 2)->get();
        return view('AdminPenal.create_event', compact('Event'));
    }

    public function viewEventType()
    {
        $EventType = EventType::all();
        return view('AdminPenal.ViewEventType', compact('EventType'));
    }

    public function createEventType()
    {
        $EventType = EventType::all();
        return view('AdminPenal.CreateEventType', compact('EventType'));
    }

    public function saveEventType(Request $request)
    {
        // Validation
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'nullable|string|max:255', // You can add a max length for better control
                'description' => 'nullable|string|max:500', // Added max length for description
            ]
        );

        // If validation fails, return a JSON response with errors
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()  // Use ->errors() instead of getMessageBag()
            ], 422);
        }

        // Create a new EventType instance and save the data
        $form = new EventType;
        $form->name = $request->name;
        $form->description = $request->description;
        $form->save();

        return redirect()->route('admin.viewEventType')->with('success', 'Event created successfully.');
    }


    public function destroyEventType($id)
    {
        $eventType = EventType::findOrFail($id);
        $eventType->delete();
        return redirect()->route('admin.viewEventType')->with('success', 'Event Type deleted successfully.');
    }


    public function showcreateevent()
    {

        $EventType = EventType::get();
        return view('AdminPenal.event', compact('EventType'));
    }
    public function upload_event_video()
    {
        $EventType = UserEvent::where('type', 2)->get();

        return view('AdminPenal.upload_event_video', compact('EventType'));
    }

    public function uploadVideo(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|mimes:mp4,mov,avi|max:20480',
                'event_name' => 'required|string',
                'event_type' => 'required|integer',
            ]);

            $videoPath = $request->file('image')->store('assets/Event_traning', 'public');

            $latestOrder = EventTraning::where('event_id', $request->event_type)
                ->orderBy('order_id', 'desc')
                ->first();

            $orderId = $latestOrder ? $latestOrder->order_id + 1 : 1;
            // dd($orderId);
            EventTraning::create([
                'title' => $request->event_name,
                'event_id' => $request->event_type,
                'video_type' => $videoPath,
                'order_id' => $orderId,
            ]);

            return back()->with('success', 'Video uploaded successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error uploading video: ' . $e->getMessage());
        }
    }

    public function create_event(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'event_type' => 'required|string|max:255',
            'image' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Ensure directory exists
            Storage::disk('public')->makeDirectory('event_images');

            // Handle file upload
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();
            $shortenedName = substr(pathinfo($originalName, PATHINFO_FILENAME), 0, 12) . '.' . $file->getClientOriginalExtension();

            // Save the file with a shortened name
            $storedPath = $file->storeAs('event_images', $shortenedName, 'public');


            UserEvent::create([
                'user_id' => Auth::id(),
                'event_name' => $request->event_name,
                'event_date' => $request->event_date,
                'guest_names' => $request->guest_names,
                'speaker_name' => $request->speaker_name,
                'location' => $request->location,
                'type' => 2,
                'status' => 1,
                'event_type' => $request->event_type,
                'description' => $request->description,
                'image_path' => $shortenedName,  // Store the image name in the database
            ]);
            return redirect()->route('admin.eventcreate')->with('success', 'Event created successfully.');
        }
        return redirect()->route('admin.eventcreate')->with('error', 'Event created successfully.');
    }

    // Payment controller view
    public function publishRequestView()
    {

        $list = UserEvent::all();
        foreach ($list as $event) {
            $userName = User::find($event->user_id)->name ?? 'Unknown User';
        }
        return view('AdminPenal.PublishRequestView', compact('list', 'userName'));
    }

    public function publishEventDelete($id)
    {
        $eventType = UserEvent::findOrFail($id);
        $eventType->delete();
        return redirect()->back()->with('success', 'Event Type deleted successfully.');
    }

    public function publishedEventReview($id)
    {
        $list = UserEvent::find($id);
        return view('AdminPenal.PublishedEventReview', compact('list'));
    }

    public function publishEventStatusUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:2,3',
        ]);
        $userEvent = UserEvent::findOrFail($id);

        $userEvent->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Event status updated successfully.');
    }
}
