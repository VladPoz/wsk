<?php

namespace App\Http\Controllers;

use App\Http\Requests\Participants\ParticipantsFormRequest;
use App\Http\Resources\Participants\ParticipantsResource;
use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    //
    public function myParticipant(){
        $participant = auth()->user()->myParticipant;
        if(!$participant){
            return response()->json(["message" => "Not found"], 404);
        }
        return response()->json(new ParticipantsResource($participant), 200);
    }
    public function store(ParticipantsFormRequest $request){
        if (auth()->user()->myParticipant){
            return response()->json(["message" => "Conflict"], 409);
        };
        $participant = Participant::query()->create([
            'user_id' => auth()->id(),
            'name' => $request->validated()['name'],
            'phone' => $request->validated()['phone'],
        ]);
        return response()->json(["message" => "create success","data" => new ParticipantsResource($participant)], 201);
    }

    public function update(Participant $participant, ParticipantsFormRequest $request){
        if ($participant->user_id !== auth()->id()){
            return response()->json(["message" => "Forbidden"], 403);
        }
        $participant->update(
            $request->validated()
        );
        return response()->json(["message" => "update success","data" => new ParticipantsResource($participant)], 200);
    }

    public function delete(Participant $participant){
        if ($participant->user_id !== auth()->id()){
            return response()->json(["message" => "Forbidden"], 403);
        }
        if(isset($participant->notCancelledRegistrations)){
            return response()->json(["message" => "Conflict"], 409);
        }
        $participant->delete();
        return response()->json(['message' => 'delete success'], 200);
    }
}
