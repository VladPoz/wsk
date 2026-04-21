<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\CommunityTask;
use App\Models\CommunityDefaultTask;

class CommunityTaskController extends Controller
{
    public function GetCommunityTasks($slug){
        $communityId = Community::query()->where('slug', $slug)->firstOrFail('id');
        $communityTasks = CommunityTask::query()->where('community_id', $communityId)->get();
        $defaultCommunityTasks = CommunityDefaultTask::all();
        if($communityTasks->isEmpty() && $defaultCommunityTasks->isEmpty()){
            return response()->json(['errors' => 'Tasks is none'], 404);
        }
        return response()->json([$communityTasks,$defaultCommunityTasks], 200);
    }
}
