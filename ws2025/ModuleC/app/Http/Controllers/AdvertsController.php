<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertCreateRequest;
use App\Http\Requests\AdvertUpdateRequest;
use App\Http\Requests\AdvertUpdateStatusRequest;
use App\Models\Adverts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertsController extends Controller
{
    // ===== Adverts =====
    public function getAdverts(Request $request){
        $data = Adverts::query()->where('status', 'published');

        if ($request->category_id) {
            $data->where('category_id', $request->category_id);
        }

        if ($request->price_from) {
            $data->where('price', '>=', $request->price_from);
        }

        if ($request->price_to) {
            $data->where('price', '<=', $request->price_to);
        }

        return response()->json($data->get());
    }
    public function createAdvert(AdvertCreateRequest $request)
    {
        $data = $request->validated();
        $paths = [];
        foreach ($data['photos'] as $image) {
            $paths[] = Storage::disk('public')->put('images', $image);
        }
        $advert = Adverts::query()->create([
            'title' => $data['title'],
            'text' => $data['text'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'user_id' => auth()->id(),
            'photos' => json_encode($paths),
        ]);
        return response()->json(['description'=> 'Created advert (in draft status)', 'advert' => $advert], 200);
    }
    public function getAdvert($id){
        $advert = Adverts::query()->find($id);
        if(!$advert){
            return response()->json(['description' => "The requested advert doesn't exist"], 404);
        }
        return response()->json(['description' => "Advert", 'advert' => $advert], 200);
    }
    public function updateAdvert(AdvertUpdateRequest $request, $id){
        $data = $request->validated();
        $advert = Adverts::query()->find($id);
        $advert->update($data);
        return response()->json(['description' => "Updated advert (automatically moved to moderation status if edited by a non-moderator user)", 'advert' => $advert], 200);
    }

    public function deleteAdvert($id){
        $advert = Adverts::query()->find($id);
        $advert->delete();
        return response()->json(['description'=>'Deleted advert successfully'], 204);
    }
    public function updateAdvertStatus(AdvertUpdateStatusRequest $request ,$id){
        $data = $request->validated();
        $advert = Adverts::query()->find($id);
        $advert->update([
            'status' => $data['status'],
        ]);
        return response()->json(['description'=>'Updated advert', 'advert'=>$advert],200);
    }
}
