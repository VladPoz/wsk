<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInCommunityRequest;
use App\Http\Requests\StoreCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;
use App\Models\Community;
use App\Models\CommunityUsers;

class CommunityController extends Controller
{
    public function store(StoreCommunityRequest $request){
        $data = $request->validated();
        Community::query()->create([
            'slug' => $data['slug'],
            'user_id' => auth()->id(),
        ]);
        return response()->json('Community created!', 200);
    }

    public function signIn(SignInCommunityRequest $request){
        $data = $request->validated();
        $community = Community::query()->where('slug', $data['slug'])->first();
        if(!$community){
            return response()->json(['errors'=>'Community not found!'], 404);
        }
        CommunityUsers::query()->create([
            'community_id' => $community->id,
            'created_id' => auth()->id(),
        ]);
        return response()->json('Community signed!', 200);
    }
}
