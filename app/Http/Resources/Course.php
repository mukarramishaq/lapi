<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Course extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array(
            'type' => 'courses',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'credit_hours' => $this->credit_hours,
                'created_at' =>$this->created_at->toAtomString(),
                'updated_at' =>$this->updated_at->toAtomString()
            ],
        );
    }
}
