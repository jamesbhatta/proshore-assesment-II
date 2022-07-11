<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'start_date' => $this->start_date,
            'start_date_hr' => $this->start_date->diffForHumans(),
            'end_date' => $this->end_date,
            'end_date_hr' => $this->end_date->diffForHumans(),
            'description' => $this->description,
        ];
    }
}
