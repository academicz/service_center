<?php

namespace App\Http\Resources;

use App\Http\Resources\FormResource\ParticularResource;
use App\Http\Resources\FormResource\ParticularTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CashBookResource extends JsonResource
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
            'amount' => $this->amount,
            'balance' => $this->balance,
            'date' => $this->created_at,
            'particular' => ParticularResource::make($this->particular),
            'particularType' => ParticularTypeResource::make($this->particular->particular_category->particular_type),
        ];
    }
}
