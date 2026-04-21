<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommunityUsersRequest;
use App\Http\Requests\UpdateCommunityUsersRequest;
use App\Models\Community;
use App\Models\CommunityUsers;

class CommunityUsersController extends Controller
{
    public function UserJoinedCommunity($slug){
        $community = Community::query()->where('slug',$slug)->first(['id', 'user_id']);
        if(!$community){
            return response()->json(['errors'=>'Community not found'],404);
        }
        if($community->user_id === auth()->id() || CommunityUsers::query()->where('community_id',$community->id)->where('user_id',auth()->id())->exists()){
            return response()->json(['errors'=>'Community already joined!'], 409);
        }
        CommunityUsers::query()->create([
            'community_id' => $community->id,
            'user_id' => auth()->id()
        ]);
        return response()->json(['message' => 'Community joined'], 200);
    }

    public function UserCommunityList(){
        $communityIds = CommunityUsers::query()->where('user_id', auth()->id())->pluck('community_id')->toArray();
        $community = Community::query()->where('id', $communityIds)->get();
        $myCommunity = Community::query()->where('user_id', auth()->id())->get();
        if($community->isEmpty() && $myCommunity->isEmpty()){
            return response()->json(['errors' => 'Community not found'], 404);
        }
        return response()->json([$myCommunity,$community], 200);
    }
}
