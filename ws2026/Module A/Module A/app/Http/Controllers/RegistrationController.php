<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    //
    public function create(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|integer|exists:events,id',
        ]);
        $participant_id = Participant::query()->where('user_id', auth()->id())->first();
        if (!$participant_id) {
            return response()->json(['message' => 'Conflict'], 409);
        }
        if (Registration::query()->where('event_id', $data['event_id'])->where('participant_id', $participant_id->id)->exists()) {
            return response()->json(['message' => 'Conflict'], 409);
        }
        $registration = Registration::query()->create([
            'event_id' => $data['event_id'],
            'participant_id' => $participant_id->id,
            'status' => 'PENDING',
        ]);
        return response()->json(['message' => 'create success', 'data' => $registration->only(['id', 'status'])], 201);
    }

    public function updateConfirm($id)
    {
        $registration = Registration::query()->find($id);
        if (!$registration) {
            return response()->json(['message' => 'Not found'], 404);
        }
        if ($registration->status !== 'PENDING') {
            return response()->json(['message' => 'Conflict'], 409);
        }
        $registrations_count = Registration::query()->where('event_id', $registration->event_id)->count();
        $event = Event::query()->find($registration->event_id);
        if ($event->capacity <= $registrations_count) {
            return response()->json(['message' => 'Conflict'], 409);
        }
        $registration->update([
            'status' => 'CONFIRMED',
        ]);
        return response()->json(['message' => 'confirm success', 'data' => $registration->only(['id', 'status'])]);
    }

    public function updateCancel($id)
    {
        $registration = Registration::query()->find($id);
        if (!$registration) {
            return response()->json(['message' => 'Not found'], 404);
        }
        if ($registration->status == 'CANCELLED') {
            return response()->json(['message' => 'Conflict'], 409);
        }
        if (!Participant::query()->where('user_id', auth()->id())->where('id', $registration->participant_id)->exists()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $registration->update([
            'status' => 'CANCELLED',
        ]);
        return response()->json(['message' => 'confirm success', 'data' => $registration->only(['id', 'status'])]);
    }

    public function myRegistrations(){
        $participants_id = Participant::query()->where('user_id', auth()->id())->first()->id;
        $registrations = Registration::query()->with('event')->where('participant_id', $participants_id)->get()->map(function ($registration) {
            return ['id' => $registration->id, 'event' => [
                'id' => $registration->event->id,
                'title' => $registration->event->title,
                'event_date' => $registration->event->event_date,
            ], 'status' => $registration->status];
        });
        return response()->json(['data' => $registrations]);
    }
}
