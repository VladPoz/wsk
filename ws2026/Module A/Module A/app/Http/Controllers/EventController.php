<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    //
    public function list(Request $request){
        $data = $request->validate([
            'page' => 'integer|min:1',
            'date' => 'date|date_format:Y-m-d',
            'search' => 'string',
        ]);
        $events = Event::query()->withCount('registrations');
        if (isset($data['date'])) {
            $events->whereDate('event_date', $data['date']);
        }
        if(isset($data['search'])){
            $events->where(function ($query) use ($data) {
                $query->where('title', 'like', '%'.$data['search'].'%')->orWhere('location', 'like', '%'.$data['search'].'%');
            });
        }
        $events = $events->paginate(10);
        if(isset($data['page'])){
            $events->appends(['page' => $data['page']]);
        }
        return response()->json(['data' => $events->items(), 'meta' => [
            'current_page' => $events->currentPage(),
            'last_page' => $events->lastPage(),
            'per_page' => $events->perPage(),
            'total' => $events->total(),
        ]], 200);
    }

    public function create(Request $request){
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date|date_format:Y-m-d|after_or_equal:today|before_or_equal:' . now()->addYear()->format('Y-m-d'),
            'capacity' => 'required|integer|min:1',
        ]);
        $event = Event::query()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'location' => $data['location'],
            'event_date' => $data['event_date'],
            'capacity' => $data['capacity'],
        ]);
        return response()->json(["message" => "create success", 'data' => [
            'id' => $event->id,
            'title' => $event->title,
            'event_date' => $event->event_date,
        ]], 201);
    }

    public function show($id){
        $event = Event::query()->withCount('registrations')->find($id);
        if(!$event){
            return response()->json(["message" => "Not found"], 404);
        }
        $event->participants = $event->participants();
        return response()->json($event, 200);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date|date_format:Y-m-d|after_or_equal:today|before_or_equal:' . now()->addYear()->format('Y-m-d'),
            'capacity' => 'required|integer|min:1',
        ]);
        $event = Event::query()->with('registrations')->find($id);
        if(!$event){
            return response()->json(["message" => "Not found"], 404);
        }
        if ($event->capacity < $event->registrations->where('status', 'CONFIRMED')->count()) {
            return response()->json(["message" => "The capacity must be greater than number of confirmed registrations"], 409);
        }
        $event->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'location' => $data['location'],
            'event_date' => $data['event_date'],
            'capacity' => $data['capacity'],
        ]);
        return response()->json(['message'=> 'update success', 'data' => $event], 200);
    }

    public function delete($id){
        $event = Event::query()->find($id);
        if(!$event){
            return response()->json(["message" => "Not found"], 404);
        }
        $event->delete();
        return response()->json(['message'=> 'delete success'], 200);
    }

    public function status($id)
    {
        $event = Event::query()->find($id);
        if (!$event) {
            return response()->json(["message" => "Not found"], 404);
        }

        $isRegistered = Registration::query()->where('event_id', $id)->where('participant_id', function ($query) {
                $query->select('id')->from('participants')->where('user_id', auth()->id())->first();
        })->exists();

        if (!$isRegistered) {
            return response()->json(["data" => null], 200);
        }

        return response()->json([
            'data' => [
                'id' => $event->id,
                'status' => Registration::query()->where('event_id', $id)->first()->status,
            ]
        ], 200);
    }
}
