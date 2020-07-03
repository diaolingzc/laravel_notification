<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoserCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $this->resource->addHidden(['is_r18']);

        return parent::toArray($request);
    }
}
