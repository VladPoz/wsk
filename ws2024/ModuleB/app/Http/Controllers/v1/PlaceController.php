<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Place\CreatePlaceController;
use App\Http\Requests\Place\StorePlaceRequest;
use App\Models\Place;
use App\Services\Poi;

class PlaceController extends Controller
{
    //
    public function index(){
        $places = Place::all();
        if($places->isEmpty()){
            return response()->json('Places empty', 200);
        }
        return response()->json($places, 200);
    }
    public function show($id){
        $place = Place::query()->find($id);
        if (!$place){
            return response()->json('Place not found', 404);
        }
        return response()->json($place, 200);
    }

    public function store(StorePlaceRequest $request){
        $data = $request->validated();
        $path = $data['image']->store('image', 'public');
        require_once app_path('Services/Poi.php');
        $test = new \App\Services\PoiFactory();;

        $calc = $test->calculate([
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);
        $placeId = Place::query()->latest('id')->first()->id;
        $place = Place::query()->create([
            'id' => $placeId + 1,
            'name' => $data['name'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'type' => $data['type'],
            'open_time' => $data['open_time'],
            'close_time' => $data['close_time'],
            'x' => $calc['x'],
            'y' => $calc['y'],
            'image_path' => $path,
            'description' => $data['description'],
        ]);
        return response()->json('create success', 200);
    }
}
