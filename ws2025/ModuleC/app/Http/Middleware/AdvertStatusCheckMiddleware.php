<?php

namespace App\Http\Middleware;

use App\Models\Adverts;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdvertStatusCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = request('id');
        $advert = Adverts::query()->find($id);
        $user = auth()->user();
        if(!$advert){
            return response()->json(['description' => "The requested advert doesn't exist"], 404);
        }
        if(!($advert->user_id === $user->id || $user->role === 'moderator')){
            return response()->json(['description' => "Only advert's author or moderator can execute this request. Simple user caen edit only in draft status"], 403);
        }
        return $next($request);
    }
}
