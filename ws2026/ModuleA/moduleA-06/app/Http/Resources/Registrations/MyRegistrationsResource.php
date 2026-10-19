<?php

namespace App\Http\Resources\Registrations;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MyRegistrationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $event = $this->event->makeHidden(['description', 'location' , 'capacity', 'created_at', 'updated_at']);
        $event->event_date = Carbon::parse($event->event_date)->format('Y-m-d');
        return [
            'id' => $this->id,
            'event' => $event,
            'status' => $this->status,
        ];
    }
}
