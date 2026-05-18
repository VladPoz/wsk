<?php

namespace App\Http\Controllers;

use App\Http\Requests\Events\EventsFormRequest;
use App\Http\Requests\Events\EventsListRequest;
use App\Http\Resources\Events\EventDetailsResource;
use App\Http\Resources\Events\EventsListResource;
use App\Http\Resources\Events\EventsStoreResource;
use App\Http\Resources\Events\EventsUpdateResource;
use App\Http\Resources\Events\MyStatusResource;
use App\Models\Event;

class EventController extends Controller
{
    //
    public function eventsList(EventsListRequest $request){
        $events = Event::query();
        if(isset($request->validated()['search'])){
            $events->where(function ($query) use ($request) {
                $query->where('title', 'LIKE', '%'.$request->validated()['search'].'%')
                    ->orWhere('location', 'LIKE', '%'.$request->validated()['search'].'%');
            });
        };
        if(isset($request->validated()['date'])){
            $events->where('event_date', $request->validated()['date']);
        };
        $events = $events->paginate(10);
        return response()->json(['data'=> EventsListResource::collection($events),'meta' => [
            "current_page" => $events->currentPage(),
            "last_page" => $events->lastPage(),
            "per_page" => $events->perPage(),
            "total" => $events->total(),
        ]], 200);
    }

    public function eventDetails(Event $event){
        return response()->json(['data' => new EventDetailsResource($event)], 200);
    }

    public function store(EventsFormRequest $request){
        $event = Event::query()->create($request->validated());
        return response()->json(['message' => 'create success','data' => new EventsStoreResource($event)], 201);
    }

    public function update(Event $event, EventsFormRequest $request){
        if($request->validated()['capacity'] < $event->confirmed_registrations->count()){
            return response()->json(['message' => 'The capacity must be greater than number of confirmed registrations'], 409);
        }
        $event->update($request->validated());
        return response()->json(['message' => 'update success','data' => new EventsUpdateResource($event)], 200);
    }

    public function delete(Event $event){
        $event->delete();
        return response()->json(['message' => 'delete success'], 200);
    }

    public function myStatus(Event $event){
        $registration = $event->myRegistratons()->latest('id')->first();
        if(!$registration){
            return response()->json(['data' => null], 200);
        }
        return response()->json(['data' => new MyStatusResource($registration)], 200);
    }
}
