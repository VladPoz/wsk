<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registrations\RegistrationsFormRequest;
use App\Http\Resources\Registrations\MyRegistrationsResource;
use App\Http\Resources\Registrations\RegistrationsResource;
use App\Models\Registration;

class RegistrationController extends Controller
{
    //
    public function store(RegistrationsFormRequest $request){
        if(!isset(auth()->user()->myParticipant)){
            return response()->json(['message' => 'Create a participant profile'], 422);
        }
        if(Registration::query()->where('event_id', $request->validated()['event_id'])->where('participant_id', auth()->user()->myParticipant->id)->where(function ($q) use($request){
            $q->where('status', 'CONFIRMED')->orWhere('status', 'PENDING');
        })->exists()){
            return response()->json(['message' => 'Conflict'], 409);
        }
        $registration = Registration::query()->create([
            'event_id' => $request->validated()['event_id'],
            'participant_id' => auth()->user()->myParticipant->id,
            'status' => "PENDING",
        ]);
        return response()->json(['message' => 'create success', 'data' => new RegistrationsResource($registration)], 201);
    }

    public function confirm(Registration $registration){
        if ($registration->status != 'PENDING'){
            return response()->json(['message' => 'Conflict'], 409);
        }
        $registration->update(['status' => 'CONFIRMED']);
        return response()->json(['message' => 'confirm success', 'data' => new RegistrationsResource($registration)], 200);
    }

    public function cancel(Registration $registration){
        if ($registration->status === 'CANCELLED'){
            return response()->json(['message' => 'Conflict'], 409);
        }
        if (auth()->user()->role !== 'ADMIN' || $registration->participant_id !== auth()->user()->myParticipant()->id){
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $registration->update(['status' => 'CANCELLED']);
        return response()->json(['message' => 'cancel success', 'data' => new RegistrationsResource($registration)], 200);
    }

    public function myRegistrations(){
        $registrations = Registration::query()->where('participant_id', auth()->user()->myParticipant->id)->get();
        return response()->json(['data' => MyRegistrationsResource::collection($registrations)], 200);
    }
}
