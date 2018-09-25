<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
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
            'type' => 'students',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'roll_no' => $this->roll_no,
                'created_at' =>$this->created_at->toAtomString(),
                'updated_at' =>$this->updated_at->toAtomString()
            ],
        );
    }
}
