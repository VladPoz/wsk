<?php

namespace App\Http\Controllers;

use App\Http\Requests\Participants\ParticipantsRequest;
use App\Models\Participant;
use App\Models\Registration;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    //
    public function myParticipant(){
        $participants = Participant::query()->where('user_id', auth()->id())->first();
        if(!$participants){
            return response()->json(['message'=>'Not found'], 404);
        }
        return response()->json($participants->only(['name', 'phone']),200);
    }

    public function create(ParticipantsRequest $request){
        $data = $request->validated();
        if(Participant::query()->where('user_id', auth()->id())->exists()){
            return response()->json(['message'=>'Conflict'], 409);
        }
        $participants = Participant::query()->create([
            'user_id' => auth()->id(),
            'name' => $data['name'],
            'phone' => $data['phone'],
        ]);
        return response()->json(['message' => 'create success' ,'data'=>$participants->only(['id', 'name', 'phone'])],201);
    }

    public function update(ParticipantsRequest $request, $id){
        $data = $request->validated();
        $participant = Participant::query()->find($id);
        if(!$participant){
            return response()->json(['message'=>'Not found'], 404);
        }
        if($participant->user_id !== auth()->id()){
            return response()->json(['message'=>'Forbidden'], 403);
        }
        $participant->update($data);
        return response()->json(['message' => 'update success' ,'data'=>$participant->only(['id', 'name', 'phone'])],200);
    }

    public function delete($id){
        $participant = Participant::query()->find($id);
        if(!$participant){
            return response()->json(['message'=>'Not found'], 404);
        }
        if($participant->user_id !== auth()->id()){
            return response()->json(['message'=>'Forbidden'], 403);
        }
        if(Registration::query()->where('participant_id', $participant->id)->exists()){
            return response()->json(['message'=>'Conflict'], 409);
        }
        $participant->delete();
        return response()->json(['message' => 'delete success'],200);
    }
}
