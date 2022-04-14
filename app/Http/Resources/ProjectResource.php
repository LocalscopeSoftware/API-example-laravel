<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'startDate' => $this->startDate,
            'deadLineDate' => $this->deadLineDate,
            'budget' => $this->budget,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
