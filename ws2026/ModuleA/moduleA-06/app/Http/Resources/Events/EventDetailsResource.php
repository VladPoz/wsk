<?php

namespace App\Http\Resources\Events;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $registrations_count = $this->confirmed_registrations->count();
        $participants = $this->confirmed_registrations->map->participant->makeHidden(['user_id', 'created_at', 'updated_at']);
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "location" => $this->location,
            "event_date" => Carbon::parse($this->event_date)->format('Y-m-d'),
            "capacity" => $this->capacity,
            "registrations_count" => $registrations_count,
            'participants' => $participants,
        ];
    }
}
