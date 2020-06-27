<?php

namespace App\Http\Resources;

use App\Http\Resources\FormResource\ParticularResource;
use App\Http\Resources\FormResource\ParticularTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ParticularCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->category_name,
            'type' => ParticularTypeResource::make($this->particular_type),
            'particulars' => ParticularResource::collection($this->particulars)
        ];
    }
}
