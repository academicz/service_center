<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\CashBookResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CashBookCollection extends ResourceCollection
{
    private $status;

    /**
     * To set status field in json response
     * @param $status
     * @return $this
     */
    public function status($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => CashBookResource::collection($this->collection),
            'status' => $this->status
        ];
    }
}
